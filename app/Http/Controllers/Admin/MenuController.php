<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\ImageManager;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\Drivers\Gd\Driver;

class MenuController extends Controller
{
    /**
     * Display a listing of the menus.
     */
    public function index(Request $request)
    {
        $query = Menu::with('category');

        // Filter by search text
        if ($search = $request->query('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($categoryId = $request->query('category')) {
            $query->where('menu_category_id', $categoryId);
        }

        // Sorting
        if ($sort = $request->query('sort')) {
            switch ($sort) {
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                default:
                    // Default fallback sort
                    $query->orderBy('name');
                    break;
            }
        } else {
            $query->orderBy('name');
        }

        $menus = $query->paginate(10)->withQueryString();

        $categories = MenuCategory::where('status', true)->get();

        return view('pages.admin.menu.index', compact('menus', 'categories'));
    }

    /**
     * Show the form for creating a new menu.
     */
    public function create()
    {
        $categories = MenuCategory::where('status', true)->get();
        return view('pages.admin.menu.create', compact('categories'));
    }

    /**
     * Store a newly created menu in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'menu_category_id' => 'required|exists:menu_categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_best_seller' => 'boolean',
            'is_featured' => 'boolean',
            'status' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        try {
            // Handle image upload and convert to WebP
            if ($request->hasFile('image')) {
                $imagePath = $this->storeImageAsWebp($request->file('image'));
                $validated['image'] = $imagePath;
            }

            // Generate slug from name
            $validated['slug'] = Str::slug($validated['name']);

            Menu::create($validated);

            return redirect()->route('admin.menu.index')
                ->with('success', 'Menu berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified menu.
     */
    public function show(Menu $menu)
    {
        return view('pages.admin.menu.show', compact('menu'));
    }

    /**
     * Show the form for editing the specified menu.
     */
    public function edit(Menu $menu)
    {
        $categories = MenuCategory::where('status', true)->get();
        return view('pages.admin.menu.edit', compact('menu', 'categories'));
    }

    /**
     * Update the specified menu in storage.
     */
    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'menu_category_id' => 'required|exists:menu_categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_best_seller' => 'boolean',
            'is_featured' => 'boolean',
            'status' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        try {
            // Handle image upload and convert to WebP
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($menu->image) {
                    Storage::disk('public')->delete($menu->image);
                }
                $imagePath = $this->storeImageAsWebp($request->file('image'));
                $validated['image'] = $imagePath;
            }

            // Generate slug from name
            $validated['slug'] = Str::slug($validated['name']);

            $menu->update($validated);

            return redirect()->route('admin.menu.index')
                ->with('success', 'Menu berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified menu from storage.
     */
    public function destroy(Menu $menu)
    {
        // Delete image if exists
        if ($menu->image) {
            Storage::disk('public')->delete($menu->image);
        }

        $menu->delete();

        return redirect()->route('admin.menu.index')
            ->with('success', 'Menu berhasil dihapus');
    }

    /**
     * Store image as WebP format.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @return string Path to the stored WebP image
     */
    private function storeImageAsWebp($file): string
    {
        $filename = time() . '_' . Str::random(10) . '.webp';
        $path = 'menus/' . $filename;

        $manager = ImageManager::usingDriver(Driver::class);

        $encoded = $manager->decodePath($file->getRealPath())
            ->scale(width: 1200)
            ->encode(new WebpEncoder(quality: 80));

        Storage::disk('public')->put($path, (string) $encoded);

        return $path;
    }
}

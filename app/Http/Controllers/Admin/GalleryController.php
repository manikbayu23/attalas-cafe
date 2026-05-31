<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\ImageManager;

class GalleryController extends Controller
{
    /**
     * Display a listing of the gallery items.
     */
    public function index()
    {
        $galleries = Gallery::orderBy('sort_order')
            ->orderByDesc('id')
            ->paginate(12);

        return view('pages.admin.gallery.index', compact('galleries'));
    }

    /**
     * Store a newly created gallery item (Dropzone upload or normal form).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:4096',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
            'status' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $path = $this->storeImageAsWebp($request->file('image'));

        $gallery = Gallery::create([
            'title' => $validated['title'] ?? pathinfo($request->file('image')->getClientOriginalName(), PATHINFO_FILENAME),
            'description' => $validated['description'] ?? null,
            'image' => $path,
            'is_featured' => $validated['is_featured'] ?? false,
            'status' => $validated['status'] ?? true,
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'id' => $gallery->id,
                'image_url' => Storage::disk('public')->url($gallery->image),
            ]);
        }

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Gambar berhasil ditambahkan ke gallery.');
    }

    /**
     * Show the form for editing the specified gallery item.
     */
    public function edit(Gallery $gallery)
    {
        return view('pages.admin.gallery.edit', compact('gallery'));
    }

    /**
     * Update the specified gallery item in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
            'is_featured' => 'nullable|boolean',
            'status' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            if ($gallery->image) {
                Storage::disk('public')->delete($gallery->image);
            }

            $validated['image'] = $this->storeImageAsWebp($request->file('image'));
        }

        $gallery->update([
            'title' => $validated['title'] ?? $gallery->title,
            'description' => $validated['description'] ?? $gallery->description,
            'image' => $validated['image'] ?? $gallery->image,
            'is_featured' => $request->boolean('is_featured'),
            'status' => $request->boolean('status'),
            'sort_order' => $validated['sort_order'] ?? $gallery->sort_order,
        ]);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Gallery berhasil diperbarui.');
    }

    /**
     * Remove the specified gallery item from storage.
     */
    public function destroy(Gallery $gallery)
    {
        if ($gallery->image) {
            Storage::disk('public')->delete($gallery->image);
        }

        $gallery->delete();

        if (request()->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Gallery berhasil dihapus.');
    }

    /**
     * Store image as WebP format under public/galleries.
     */
    private function storeImageAsWebp($file): string
    {
        $filename = time() . '_' . Str::random(10) . '.webp';
        $path = 'galleries/' . $filename;

        $manager = ImageManager::usingDriver(Driver::class);

        $encoded = $manager->decodePath($file->getRealPath())
            ->scale(width: 1600)
            ->encode(new WebpEncoder(quality: 80));

        Storage::disk('public')->put($path, (string) $encoded);

        return $path;
    }
}

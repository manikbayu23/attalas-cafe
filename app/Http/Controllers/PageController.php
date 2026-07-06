<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\Review;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $featuredMenus = Menu::with('category')
            ->where('status', true)
            ->where(function ($query) {
                $query->where('is_featured', true)
                    ->orWhere('is_best_seller', true);
            })
            ->orderBy('sort_order')
            ->latest()
            ->take(6)
            ->get();

        $galleryItems = Gallery::where('status', true)
            ->orderByDesc('is_featured')
            ->latest()
            ->take(6)
            ->get();

        $reviews = Review::where('status', true)
            ->orderByDesc('is_featured')
            ->latest()
            ->take(3)
            ->get();

        return view('pages.public.home', compact('featuredMenus', 'galleryItems', 'reviews'));
    }

    public function about()
    {
        $heroImage = $this->heroImage('image-hero-about.png');

        return view('pages.public.about', compact('heroImage'));
    }

    public function reservation()
    {
        return view('pages.public.reservation');
    }

    public function gallery()
    {
        $galleries = Gallery::where('status', true)
            ->orderByDesc('is_featured')
            ->latest()
            ->get();

        $heroImage = $this->heroImage('image-hero-gallery.png');

        return view('pages.public.gallery', compact('galleries', 'heroImage'));
    }

    public function contact()
    {
        $heroImage = $this->heroImage('image-hero-contact.png');

        return view('pages.public.contact', compact('heroImage'));
    }

    public function menu()
    {
        $menus = Menu::with('category')
            ->where('status', true)
            ->orderByDesc('is_best_seller')
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->latest()
            ->get();

        $categories = MenuCategory::where('status', true)
            ->orderBy('sort_order')
            ->get()
            ->map(function ($category) {
                $category->icon = $this->categoryIcon($category->name);

                return $category;
            });

        $heroImage = $this->heroImage('image-hero-menu.png');

        return view('pages.public.menu', compact('menus', 'categories', 'heroImage'));
    }

    public function menuData(Request $request)
    {
        $query = Menu::with('category')
            ->where('status', true)
            ->when($request->filled('category') && $request->get('category') !== 'all', function ($query) use ($request) {
                $query->where('menu_category_id', $request->integer('category'));
            });

        $total = (clone $query)->count();
        $offset = $request->integer('offset', 0);
        $limit = $request->integer('limit', 12);

        $items = (clone $query)
            ->orderByDesc('is_best_seller')
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->latest()
            ->skip($offset)
            ->take($limit)
            ->get();

        return response()->json([
            'items' => $items->map(function ($menu) {
                return [
                    'id' => $menu->id,
                    'name' => $menu->name,
                    'description' => $menu->description,
                    'price' => $menu->formatted_price,
                    'image' => $menu->image ? asset('storage/' . $menu->image) : null,
                    'category' => $menu->category?->name ?? 'Menu',
                    'badge' => $menu->is_best_seller ? 'Best Seller' : ($menu->is_featured ? 'Featured' : null),
                ];
            }),
            'total' => $total,
            'hasMore' => $total > $offset + $items->count(),
        ]);
    }

    private function categoryIcon(string $name): string
    {
        $name = strtolower($name);

        if (str_contains($name, 'coffee') || str_contains($name, 'kopi')) {
            return 'ph-coffee';
        }

        if (str_contains($name, 'tea') || str_contains($name, 'teh')) {
            return 'ph-cup';
        }

        if (str_contains($name, 'food') || str_contains($name, 'makanan') || str_contains($name, 'snack')) {
            return 'ph-pizza';
        }

        if (str_contains($name, 'dessert') || str_contains($name, 'cake') || str_contains($name, 'puding')) {
            return 'ph-cake';
        }

        return 'ph-squares-four';
    }

    private function heroImage($image): ?string
    {
        return asset('assets/images/' . $image);
    }
}

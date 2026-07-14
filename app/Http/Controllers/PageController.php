<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\Review;
use App\Services\MenuCategoryService;
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
            ->select('menus.*')
            ->join('menu_categories', 'menus.menu_category_id', '=', 'menu_categories.id')
            ->where('menus.status', true)
            ->orderByRaw("CASE menu_categories.type WHEN 'food' THEN 1 WHEN 'drink' THEN 2 ELSE 3 END")
            ->orderBy('menu_categories.sort_order')
            ->orderByDesc('menus.is_best_seller')
            ->orderByDesc('menus.is_featured')
            ->orderBy('menus.sort_order')
            ->latest('menus.created_at')
            ->get();

        $categories = MenuCategory::where('status', true)
            ->orderBy('sort_order')
            ->get()
            ->map(function ($category) {
                $category->icon = MenuCategoryService::iconForName($category->name);

                return $category;
            });

        // Pass full type definitions to view so Blade can render labels & icons dynamically
        $categoryTypes = MenuCategoryService::types();

        $heroImage = $this->heroImage('image-hero-menu.png');

        return view('pages.public.menu', compact('menus', 'categories', 'categoryTypes', 'heroImage'));
    }

    public function menuData(Request $request)
    {
        $categoryInput  = $request->get('category', 'all');
        $validGroupKeys = MenuCategoryService::keys(); // ['food', 'drink', 'others', …]

        $query = Menu::with('category')
            ->select('menus.*')
            ->join('menu_categories', 'menus.menu_category_id', '=', 'menu_categories.id')
            ->where('menus.status', true)
            ->when(!empty($categoryInput) && $categoryInput !== 'all', function ($query) use ($categoryInput) {
                $categories = array_filter(explode(',', $categoryInput));
                if (!empty($categories)) {
                    $query->whereIn('menus.menu_category_id', $categories);
                }
            });

        $total  = (clone $query)->count();
        $offset = $request->integer('offset', 0);
        $limit  = $request->integer('limit', 12);

        $items = (clone $query)
            ->orderByRaw("CASE menu_categories.type WHEN 'food' THEN 1 WHEN 'drink' THEN 2 ELSE 3 END")
            ->orderBy('menu_categories.sort_order')
            ->orderByDesc('menus.is_best_seller')
            ->orderByDesc('menus.is_featured')
            ->orderBy('menus.sort_order')
            ->latest('menus.created_at')
            ->skip($offset)
            ->take($limit)
            ->get();

        return response()->json([
            'items' => $items->map(function ($menu) {
                return [
                    'id'          => $menu->id,
                    'name'        => $menu->name,
                    'description' => $menu->description,
                    'price'       => $menu->formatted_price,
                    'image'       => $menu->image ? asset('storage/' . $menu->image) : null,
                    'category'    => $menu->category?->name ?? 'Menu',
                    'badge'       => $menu->is_best_seller ? 'Best Seller' : ($menu->is_featured ? 'Featured' : null),
                ];
            }),
            'total'   => $total,
            'hasMore' => $total > $offset + $items->count(),
        ]);
    }

    private function heroImage($image): ?string
    {
        return asset('assets/images/' . $image);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Menu;
use App\Models\Review;

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
        return view('pages.public.about');
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
            ->paginate(12);

        return view('pages.public.gallery', compact('galleries'));
    }

    public function contact()
    {
        return view('pages.public.contact');
    }

    public function menu()
    {
        $menus = Menu::with('category')
            ->where('status', true)
            ->orderByDesc('is_best_seller')
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->paginate(12);

        return view('pages.public.menu', compact('menus'));
    }
}

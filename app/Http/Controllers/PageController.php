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
        $heroImage = $this->heroImage();

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
            ->paginate(12);

        $heroImage = $this->heroImage();

        return view('pages.public.gallery', compact('galleries', 'heroImage'));
    }

    public function contact()
    {
        $heroImage = $this->heroImage();

        return view('pages.public.contact', compact('heroImage'));
    }

    public function menu()
    {
        $menus = Menu::with('category')
            ->where('status', true)
            ->orderByDesc('is_best_seller')
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->paginate(12);

        $heroImage = $this->heroImage();

        return view('pages.public.menu', compact('menus', 'heroImage'));
    }

    private function heroImage(): ?string
    {
        $gallery = Gallery::where('status', true)
            ->orderByDesc('is_featured')
            ->latest()
            ->first();

        return $gallery?->image ? asset('storage/' . $gallery->image) : null;
    }
}

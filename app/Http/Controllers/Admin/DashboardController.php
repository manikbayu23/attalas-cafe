<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\Review;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'menus' => Menu::count(),
            'categories' => MenuCategory::count(),
            'galleries' => Gallery::count(),
            'reviews' => Review::count(),
            'users' => User::count(),
        ];

        $menuStatus = [
            'active' => Menu::where('status', true)->count(),
            'inactive' => Menu::where('status', false)->count(),
            'best_seller' => Menu::where('is_best_seller', true)->count(),
            'featured' => Menu::where('is_featured', true)->count(),
        ];

        $reviewInsight = [
            'average_rating' => round((float) Review::avg('rating'), 1),
            'active' => Review::where('status', true)->count(),
            'featured' => Review::where('is_featured', true)->count(),
        ];

        $galleryInsight = [
            'featured' => Gallery::where('is_featured', true)->count(),
            'active' => Gallery::where('status', true)->count(),
        ];

        $latestMenus = Menu::with('category')
            ->latest()
            ->take(5)
            ->get();

        $latestReviews = Review::latest()
            ->take(5)
            ->get();

        $latestGalleries = Gallery::latest()
            ->take(6)
            ->get();

        return view('pages.admin.dashboard', compact(
            'stats',
            'menuStatus',
            'reviewInsight',
            'galleryInsight',
            'latestMenus',
            'latestReviews',
            'latestGalleries'
        ));
    }
}

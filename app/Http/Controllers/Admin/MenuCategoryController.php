<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuCategoryController extends Controller
{
    /**
     * Display a listing of the menu categories.
     */
    public function index()
    {
        $categories = MenuCategory::all();
        return view('pages.admin.menu-category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new menu category.
     */
    public function create()
    {
        return view('pages.admin.menu-category.create');
    }

    /**
     * Store a newly created menu category in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);

        MenuCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'sort_order' => MenuCategory::max('sort_order') + 1,
        ]);

        return redirect()->route('admin.menu-category.index')->with('success', 'Menu Category created successfully.');
    }

    /**
     * Display the specified menu category.
     */
    public function show(MenuCategory $menuCategory)
    {
        return view('pages.admin.menu-category.show', compact('menuCategory'));
    }

    /**
     * Show the form for editing the specified menu category.
     */
    public function edit(MenuCategory $menuCategory)
    {
        return view('pages.admin.menu-category.edit', compact('menuCategory'));
    }

    /**
     * Update the specified menu category in storage.
     */
    public function update(Request $request, MenuCategory $menuCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);

        $menuCategory->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'sort_order' => $request->sort_order,
        ]);

        return redirect()->route('admin.menu-category.index')->with('success', 'Menu Category updated successfully.');
    }

    /**
     * Remove the specified menu category from storage.
     */
    public function destroy(MenuCategory $menuCategory)
    {
        $menuCategory->delete();

        return redirect()->route('admin.menu-category.index')->with('success', 'Menu Category deleted successfully.');
    }
}

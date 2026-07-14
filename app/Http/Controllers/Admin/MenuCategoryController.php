<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuCategory;
use App\Services\MenuCategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuCategoryController extends Controller
{
    /**
     * Display a listing of the menu categories.
     */
    public function index()
    {
        $categories    = MenuCategory::all();
        $categoryTypes = MenuCategoryService::types();

        return view('pages.admin.menu-category.index', compact('categories', 'categoryTypes'));
    }

    /**
     * Show the form for creating a new menu category.
     */
    public function create()
    {
        $typeOptions = MenuCategoryService::selectOptions();

        return view('pages.admin.menu-category.create', compact('typeOptions'));
    }

    /**
     * Store a newly created menu category in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'type'       => 'required|string|in:' . implode(',', MenuCategoryService::keys()),
            'sort_order' => 'nullable|integer',
        ]);

        try {
            MenuCategory::create([
                'name'       => $request->name,
                'slug'       => Str::slug($request->name),
                'type'       => $request->type,
                'sort_order' => MenuCategory::max('sort_order') + 1,
            ]);

            return redirect()->route('admin.menu-category.index')->with('success', 'Kategori Menu berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
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
        $typeOptions = MenuCategoryService::selectOptions();

        return view('pages.admin.menu-category.edit', compact('menuCategory', 'typeOptions'));
    }

    /**
     * Update the specified menu category in storage.
     */
    public function update(Request $request, MenuCategory $menuCategory)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'type'       => 'required|string|in:' . implode(',', MenuCategoryService::keys()),
            'sort_order' => 'nullable|integer',
        ]);

        try {
            $menuCategory->update([
                'name'       => $request->name,
                'slug'       => Str::slug($request->name),
                'type'       => $request->type,
                'sort_order' => $request->sort_order,
            ]);

            return redirect()->route('admin.menu-category.index')->with('success', 'Kategori Menu berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
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

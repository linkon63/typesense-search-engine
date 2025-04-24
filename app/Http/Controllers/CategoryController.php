<?php

namespace App\Http\Controllers;
use App\Models\Category;

use Illuminate\Http\Request;


use App\Models\Product;
use Inertia\Inertia;


class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('parent')
            ->latest()
            ->paginate(10);

        return Inertia::render('Categories/Index', [
            'categories' =>  $categories
        ]);
    }

    public function create()
    {
        $parentCategories = Category::whereNull('parent_id')->get();
        return Inertia::render('Categories/Create', [
            'parentCategories' => $parentCategories
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'boolean',
            'parent_id' => 'nullable|exists:categories,id'
        ]);

        Category::create($validated);

        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully!');
    }

    public function edit(Category $category)
    {
        $parentCategories = Category::whereNull('parent_id')
            ->where('id', '!=', $category->id)
            ->get();

        return Inertia::render('Categories/Edit', [
            'category' => $category,
            'parentCategories' => $parentCategories
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'boolean',
            'parent_id' => 'nullable|exists:categories,id'
        ]);

        $category->update($validated);

        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully!');
    }

    public function destroy(Category $category)
    {
        // Prevent deletion if category has products
        if ($category->products()->exists()) {
            return back()->with('error', 'Cannot delete category with associated products!');
        }

        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully!');
    }
}

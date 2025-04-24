<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index()
    {
        return Inertia::render('Products/Index', [
            'products' => Product::all(),
            'categories' => Category::all(),
        ]);
    }
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255', // Match migration (non-nullable)
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0', // Match migration (non-nullable)
            'quantity' => 'required|integer|min:0', // Match migration (non-nullable)
            'sku' => 'required|string|unique:products,sku', // Match migration (non-nullable + unique)
            'is_active' => 'boolean', // Remove 'string' type
            'category_id' => 'nullable|exists:categories,id',
            'image_path' => 'nullable|string' // Add to migration if needed
        ]);
        
        // dd('product create', $request->all());
    
        Product::create($request->all());
        // dd('product create', $validated);
        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }
    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
    {
        return Inertia::render('Products/Edit', [
            'product' => $product,
        ]);
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            // Add more fields if needed
        ]);

        $product->update($validated);

        return redirect()->route('products.index')
                         ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
                         ->with('success', 'Product deleted successfully.');
    }
}

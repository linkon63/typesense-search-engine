<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Product;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

// Product Routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

// Category Routes
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/search', function () {
    $results = \App\Models\Product::search('coffee')->get();
    return response()->json($results);
});

// Route::get('/search', function () {
//     // dd('search', request()->all());
//     $results = Product::search('Denim Jeans')->get();
//     return $results;
// });

// Route::get('/search', [ProductController::class, 'search']);

// Route::get('/products/search', function (Request $request) {
//     // Retrieve the search query from the request
//     $query = $request->input('q');

//     // Check if the query is empty
//     if (empty($query)) {
//     // dd('aa-search', $request->all());

//     // Products/Index'
//         return Inertia::render('Products/Search', [
//             'product' => [],
//         ]);
//         // return Inertia::render('Products/Search', [
//         //     'products' => [],
//         // ]);
//     }

//     // Perform search using Typesense and Laravel Scout
//     $products = Product::search($query)->get();

//     // Return the search results to the Inertia component
//     return Inertia::render('Products/Search', [
//         'products' => $products,
//     ]);
// })->name('products.search');


require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

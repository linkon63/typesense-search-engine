<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create parent categories
        $electronics = Category::create([
            'name' => 'Electronics',
            'is_active' => true,
        ]);

        $clothing = Category::create([
            'name' => 'Clothing',
            'is_active' => true,
        ]);

        $home = Category::create([
            'name' => 'Home & Kitchen',
            'is_active' => true,
        ]);

        // Create subcategories
        $subCategories = [
            // Electronics subcategories
            ['parent_id' => $electronics->id, 'name' => 'Smartphones', 'is_active' => true],
            ['parent_id' => $electronics->id, 'name' => 'Laptops', 'is_active' => true],
            ['parent_id' => $electronics->id, 'name' => 'Headphones', 'is_active' => true],
            
            // Clothing subcategories
            ['parent_id' => $clothing->id, 'name' => 'Men\'s Clothing', 'is_active' => true],
            ['parent_id' => $clothing->id, 'name' => 'Women\'s Clothing', 'is_active' => true],
            
            // Home subcategories
            ['parent_id' => $home->id, 'name' => 'Cookware', 'is_active' => true],
            ['parent_id' => $home->id, 'name' => 'Furniture', 'is_active' => true],
        ];

        foreach ($subCategories as $subCategory) {
            Category::create($subCategory);
        }

        // Get all active category IDs (including subcategories)
        $categoryIds = Category::active()->pluck('id');

        // Sample product data
        $products = [
            // Electronics
            ['Smartphone X', 'Latest smartphone with 128GB storage', 799.99],
            ['Gaming Laptop', 'High-performance laptop with RTX 3080', 1999.99],
            ['Wireless Earbuds', 'Noise cancelling Bluetooth earbuds', 149.99],
            
            // Clothing
            ['Cotton T-Shirt', '100% cotton unisex t-shirt', 19.99],
            ['Denim Jeans', 'Slim fit blue jeans', 59.99],
            
            // Home
            ['Non-Stick Pan', '10-inch ceramic non-stick pan', 29.99],
            ['Coffee Table', 'Modern wooden coffee table', 199.99],
        ];

        // Create 50 products
        for ($i = 0; $i < 50; $i++) {
            $productData = $products[array_rand($products)];
            
            Product::create([
                'name' => $i < count($products) ? $productData[0] : $productData[0] . ' ' . ($i + 1),
                'description' => $productData[1],
                'price' => $productData[2] * (0.9 + (mt_rand(0, 20) / 100)), // Randomize price ±10%
                'quantity' => mt_rand(0, 100),
                'sku' => 'SKU-' . Str::upper(Str::random(6)) . '-' . $i,
                'is_active' => true,
                'category_id' => $categoryIds->random(),
                'image_path' => 'products/' . ($i % 10 + 1) . '.jpg', // Assuming you have product1.jpg to product10.jpg
            ]);
        }

        $this->command->info('Successfully created categories and 50 products!');
    }
}

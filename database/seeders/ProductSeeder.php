<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = Category::whereJsonContains('name->en', 'Printed T-Shirt')->first();

        Product::create([
            'name' => ['en' => 'Round neck t-shirt'],
            'description' => ['en' => 'No description needed.'],
            'is_active' => true,
            'status' => 'published',
            'category_id' => $category->id,
        ]);
    }
}

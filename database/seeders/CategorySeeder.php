<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tshirt = Category::create([
            'name' => ['en' => 'T-Shirt'],
            'is_active' => true,
        ]);

        $tshirt->children()->createMany([
            [
                'name' => ['en' => 'Printed T-Shirt'],
                'is_active' => true,
            ],
            [
                'name' => ['en' => 'Polo T-Shirt'],
                'is_active' => true,
            ],
            [
                'name' => ['en' => 'Designed T-Shirt'],
                'is_active' => true,
            ],
        ]);
    }
}

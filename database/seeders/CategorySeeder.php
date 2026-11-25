<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Snack', 'slug' => 'snack'],
            ['name' => 'Minuman', 'slug' => 'minuman'],
            ['name' => 'Makanan Berat', 'slug' => 'makanan-berat'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(['slug' => $category['slug']], $category);
        }
    }
}
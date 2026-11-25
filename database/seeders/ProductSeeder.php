<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['snack', 'Keripik Tempe Original', 15000, 50, 'Keripik tempe renyah dengan bumbu gurih khas.'],
            ['snack', 'Kerupuk Udang Pedas', 18000, 40, 'Kerupuk udang dengan taburan bumbu pedas.'],
            ['snack', 'Pisang Cokelat Crispy', 20000, 30, 'Pisang goreng tipis berlapis cokelat.'],
            ['minuman', 'Es Teh Lemon', 8000, 100, 'Teh dingin segar dengan perasan lemon.'],
            ['minuman', 'Kopi Susu Gula Aren', 16000, 80, 'Kopi susu dengan manis gula aren alami.'],
            ['minuman', 'Wedang Jahe Instan', 12000, 60, 'Minuman jahe hangat, praktis diseduh.'],
            ['makanan-berat', 'Nasi Goreng Kampung', 25000, 25, 'Nasi goreng dengan telur dan ayam suwir.'],
            ['makanan-berat', 'Soto Ayam Lamongan', 22000, 20, 'Soto ayam kuah kuning dengan koya gurih.'],
            ['makanan-berat', 'Rawon Daging', 30000, 15, 'Rawon khas Jawa Timur dengan kuah kluwek.'],
        ];

        foreach ($products as [$categorySlug, $name, $price, $stock, $description]) {
            $category = Category::where('slug', $categorySlug)->firstOrFail();

            Product::updateOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'category_id' => $category->id,
                    'name' => $name,
                    'description' => $description,
                    'price' => $price,
                    'stock' => $stock,
                    'is_available' => true,
                ]
            );
        }
    }
}
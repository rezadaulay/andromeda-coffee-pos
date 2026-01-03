<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $makanan = ProductCategory::firstOrCreate(['name' => 'Makanan']);
        $minuman = ProductCategory::firstOrCreate(['name' => 'Minuman']);

        Product::create([
            'product_category_id' => $makanan->id,
            'name' => 'Nasi Goreng',
            'price' => 20000,
        ]);

        Product::create([
            'product_category_id' => $makanan->id,
            'name' => 'Mie Goreng',
            'price' => 18000,
        ]);

        Product::create([
            'product_category_id' => $minuman->id,
            'name' => 'Es Teh Manis',
            'price' => 8000,
        ]);

        Product::create([
            'product_category_id' => $minuman->id,
            'name' => 'Kopi Tubruk',
            'price' => 12000,
        ]);
    }
}

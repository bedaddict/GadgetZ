<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // 1. Membuat Data Kategori
        $headset = Category::create(['name' => 'Headset']);
        $kabelData = Category::create(['name' => 'Kabel Data']);
        $powerBank = Category::create(['name' => 'Power Bank']);
        $charger = Category::create(['name' => 'Charger']);

        // 2. Membuat Data Barang (Product) tanpa price
        Product::create([
            'category_id' => $headset->id,
            'code' => 'ACC-001',
            'name' => 'Headset Bluetooth Sony',
            'unit' => 'Pcs',
            'stock' => 16,
            'minimum_stock' => 5,
        ]);

        Product::create([
            'category_id' => $headset->id,
            'code' => 'ACC-002',
            'name' => 'Headset Gaming Fantech',
            'unit' => 'Pcs',
            'stock' => 12,
            'minimum_stock' => 5,
        ]);

        Product::create([
            'category_id' => $kabelData->id,
            'code' => 'ACC-003',
            'name' => 'Kabel Lightning Apple',
            'unit' => 'Pcs',
            'stock' => 10,
            'minimum_stock' => 5,
        ]);

        Product::create([
            'category_id' => $kabelData->id,
            'code' => 'ACC-004',
            'name' => 'Kabel Data Type C Vivan',
            'unit' => 'Pcs',
            'stock' => 40,
            'minimum_stock' => 10,
        ]);

        Product::create([
            'category_id' => $powerBank->id,
            'code' => 'ACC-005',
            'name' => 'Power Bank Anker 20000mAh',
            'unit' => 'Pcs',
            'stock' => 8,
            'minimum_stock' => 5,
        ]);

        Product::create([
            'category_id' => $powerBank->id,
            'code' => 'ACC-006',
            'name' => 'Power Bank Xiaomi 10000mAh',
            'unit' => 'Pcs',
            'stock' => 12,
            'minimum_stock' => 5,
        ]);
    }
}
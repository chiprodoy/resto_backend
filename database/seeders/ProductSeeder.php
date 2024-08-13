<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'product_name'=>'Mie Goreng',
            'satuan'=>'pcs',
            'price'=>'15000',
            'merchant_id'=>1,
            'uuid'=>'-'

        ]);

        Product::create([
            'product_name'=>'Nasi Goreng',
            'satuan'=>'pcs',
            'price'=>'15000',
            'merchant_id'=>1,
            'uuid'=>'-'

        ]);

        Product::create([
            'product_name'=>'Mie Ayam',
            'satuan'=>'pcs',
            'price'=>'15000',
            'merchant_id'=>1,
            'uuid'=>'-'

        ]);
    }
}

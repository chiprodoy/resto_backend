<?php

namespace Database\Seeders;

use App\Models\Merchant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MerchantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Merchant::create(
            [
                'merchant_name'=>'Eleu Resto & Cafe',
                'uuid'=>'-',
                'slug'=>'-',
                'merchant_owner_id'=>1
            ]
        );
    }
}

<?php

namespace Database\Seeders;

use App\Models\Meja;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MejaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=1;$i<=20;$i++){
            Meja::create([
                'uuid'=>'-',
                'nmr_meja'=>$i,
                'merchant_id'=>1,
            ]);
        }

    }
}

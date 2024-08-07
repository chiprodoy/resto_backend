<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
             'name' => 'Test User',
             'email' => 'test@example.com',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Waiter',
            'email' => 'waiters@example.com',
       ]);

        \App\Models\User::factory()->create([
            'name' => 'Kasir',
            'email' => 'kasir@example.com',
       ]);

       \App\Models\User::factory()->create([
        'name' => 'Dapur',
        'email' => 'dapur@example.com',
   ]);
    }
}

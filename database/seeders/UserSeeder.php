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
        $user = \App\Models\User::factory()->create([
             'name' => 'Test User',
             'email' => 'test@example.com',
        ]);

        $user->roles()->attach(1);
        $user->merchants()->attach(1);


       $user = \App\Models\User::factory()->create([
            'name' => 'Waiter',
            'email' => 'waiters@example.com',
       ]);

        $user->roles()->attach(2);
        $user->merchants()->attach(1);


        $user = \App\Models\User::factory()->create([
            'name' => 'Kasir',
            'email' => 'kasir@example.com',
       ]);

       $user->roles()->attach(3);
       $user->merchants()->attach(1);

       $user = \App\Models\User::factory()->create([
        'name' => 'Dapur',
        'email' => 'dapur@example.com',
       ]);

       $user->roles()->attach(4);
       $user->merchants()->attach(1);

    }
}

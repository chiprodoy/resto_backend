<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'role_name' => 'owner'
        ]);

        Role::create([
            'role_name' => 'waiter'
        ]);

        Role::create([
            'role_name' => 'kasir'
        ]);

        Role::create([
            'role_name' => 'dapur'
        ]);
    }
}

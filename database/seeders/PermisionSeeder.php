<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'create user','guard_name' => 'web']);
        Permission::create(['name' => 'read user','guard_name' => 'web']);
        Permission::create(['name' => 'edit user','guard_name' => 'web']);
        Permission::create(['name' => 'delete user','guard_name' => 'web']);
    }
}

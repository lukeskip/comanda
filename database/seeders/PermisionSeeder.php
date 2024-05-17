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
        
        Permission::create(['name' => 'create table','guard_name' => 'web']);
        Permission::create(['name' => 'read table','guard_name' => 'web']);
        Permission::create(['name' => 'edit table','guard_name' => 'web']);
        Permission::create(['name' => 'delete table','guard_name' => 'web']);
        
        Permission::create(['name' => 'create order','guard_name' => 'web']);
        Permission::create(['name' => 'read order','guard_name' => 'web']);
        Permission::create(['name' => 'edit order','guard_name' => 'web']);
        Permission::create(['name' => 'delete order','guard_name' => 'web']);
        
        Permission::create(['name' => 'create dish','guard_name' => 'web']);
        Permission::create(['name' => 'read dish','guard_name' => 'web']);
        Permission::create(['name' => 'edit dish','guard_name' => 'web']);
        Permission::create(['name' => 'delete dish','guard_name' => 'web']);
        
        Permission::create(['name' => 'create restaurant','guard_name' => 'web']);
        Permission::create(['name' => 'read restaurant','guard_name' => 'web']);
        Permission::create(['name' => 'edit restaurant','guard_name' => 'web']);
        Permission::create(['name' => 'delete restaurant','guard_name' => 'web']);
        
    }
}

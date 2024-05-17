<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Sergio García',
            'email' => 'contacto@chekogarcia.com.mx',
            'password' => bcrypt('willy188'),
        ]);
        $user->assignRole('superadmin'); 

        $user = User::create([
            'name' => 'Mesero',
            'email' => 'mesero@correo.com',
            'password' => bcrypt('willy188'),
        ]);
        $user->assignRole('waiter'); 
        $user->restaurants()->attach(1);

        
        $user = User::create([
            'name' => 'Restaurante',
            'email' => 'restaurant@correo.com',
            'password' => bcrypt('willy188'),
        ]);
        $user->assignRole('restaurant'); 
        $user->restaurants()->attach(1);

        
        
    }
}

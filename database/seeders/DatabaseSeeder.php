<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RestaurantSeeder;
use Database\Seeders\UsertSeeder;
use Database\Seeders\MenutSeeder;
use Database\Seeders\DishSeeder;
use Database\Seeders\DishCategorySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RestaurantSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(DishCategorySeeder::class);
        $this->call(DishSeeder::class);
    }
}

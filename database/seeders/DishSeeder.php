<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dish;
use App\Models\Menu;
use Faker\Factory as Faker;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Obtener todos los menús
        $menus = Menu::all();

        // Iterar sobre cada menú
        foreach ($menus as $menu) {
            // Crear 30 platillos por cada menú
            for ($i = 0; $i < 30; $i++) {
                Dish::create([
                    'name' => $faker->word,
                    'description' => $faker->sentence,
                    'price' => $faker->randomFloat(2, 5, 50),
                    'available' => $faker->boolean(90), 
                    'image' => 'https://via.placeholder.com/300x200', 
                    'menu_id' => $menu->id,
                ]);
            }
        }
    }
}

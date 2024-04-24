<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Restaurant;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener todos los restaurantes
        $restaurants = Restaurant::all();

        // Iterar sobre cada restaurante
        foreach ($restaurants as $restaurant) {
            // Crear dos menús para cada restaurante
            for ($i = 0; $i < 2; $i++) {
                Menu::create([
                    'name' => 'Menú ' . ($i + 1),
                    'active' => $i == 0, 
                    'description' => 'Descripción del menú ' . ($i + 1),
                    'restaurant_id' => $restaurant->id,
                ]);
            }
        }
    }
}

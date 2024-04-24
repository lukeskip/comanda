<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Utils\Utils;
use App\Models\Restaurant;
use App\Models\DishCategory;

class DishCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Ensalada','Plato Fuerte','Postre','Cortes','Comida Mexicana','Comida Italiana'];
        $restaurants = Restaurant::all();
        $restaurants->each(function($restaurant) use($categories) {
            foreach ($categories as $category) {
                $slug = Utils::getSlug($category);
                DishCategory::create([
                    'label' => $category,
                    'slug' => $slug,
                    'restaurant_id'=>$restaurant->id,
                ]);
            }
        
        });
    }
}

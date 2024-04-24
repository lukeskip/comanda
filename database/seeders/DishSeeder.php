<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dish;
use App\Models\Menu;
use App\Models\DishCategory;
use Faker\Factory as Faker;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $menus = Menu::all();

        foreach ($menus as $menu) {

            for ($i = 0; $i < 30; $i++) {
                $dish = Dish::create([
                    'name' => $faker->word,
                    'description' => $faker->sentence,
                    'price' => $faker->randomFloat(2, 5, 50),
                    'available' => $faker->boolean(90), 
                    'image' => 'https://via.placeholder.com/300x200', 
                    'menu_id' => $menu->id,
                ]);

                $categories = DishCategory::where('restaurant_id',$menu->restaurant->id)->get();
                $numCategories = rand(2, 3);
                $randomCategories = collect($categories)->random($numCategories);
                
                foreach ($randomCategories as $randomCategory) {
                    $category = DishCategory::where('label', $randomCategory->label)->first();
                    $dish->categories()->attach($category);

                }
            }
        }
    }
}

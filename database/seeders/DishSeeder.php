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
                    'name' => $faker->sentence(3,true),
                    'description' => $faker->sentence(10,true),
                    'price' => $faker->numberBetween(100,200),
                    'available' => $faker->boolean(90), 
                    'image' => $faker->randomElement(['https://images.immediate.co.uk/production/volatile/sites/30/2022/08/Corndogs-7832ef6.jpg?quality=90&resize=556,505','https://a.cdn-hotels.com/gdcs/production0/d1513/35c1c89e-408c-4449-9abe-f109068f40c0.jpg?impolicy=fcrop&w=1600&h=1066&q=medium','https://www.eatthis.com/wp-content/uploads/sites/4/2019/06/deep-dish-pizza-chicago.jpg?quality=82&strip=1&w=640',null]), 
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

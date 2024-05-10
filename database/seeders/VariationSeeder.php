<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dish;
use App\Models\Variation;
use App\Models\OptionVariation;
use Faker\Factory as Faker;

class VariationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $dishes = Dish::all();
        foreach($dishes as $dish){
            $randomVariation = rand(1,3);
            for ($i=0; $i <= $randomVariation; $i++) { 
                $min = $faker->numberBetween(0, 5);

                $variation = Variation::create([
                    'name' => $faker->randomElement(['size','sidedish','topping']),
                    'min' => $min,
                    'max' => $faker->numberBetween($min, 5),
                    'dish_id' => $dish->id,
                ]);
    
                $randomOptions = rand(1,5);
                for ($i=0; $i <= $randomOptions; $i++) { 
                    $label = $faker->words(2, true);
                    $name = str_replace(' ','-',$label);
                    $option = OptionVariation::create([
                        'name' => $name,
                        'label' => $label,
                        'price' => $faker->numberBetween(0,100),
                        'variation_id' => $variation->id
                    ]);
                }
            }


        }
    }
}

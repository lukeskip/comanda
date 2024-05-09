<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dish;
use App\Models\Variation;
use App\Models\OptionVariation;

class VariationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dishes = Dish::all();
        foreach($dishes as $dish){
            $min = $faker->numberBetween(0, 5);
            $variation = Variation::create([
                'name' => $faker->randomElement(['size','sidedish','topping']),
                'min' => $min,
                'max' => $faker->numberBetween($min, 5),
            ]);

            $randomOptions = rand(1,5);
            for ($i=0; $i <= $randomOptions; $i++) { 
                $name = $faker->word;
                $option = OptionVariation::create([
                    'name' => $name,
                    'label' => $name,
                    'price' => $faker->randomFloat(2, 0, 100),
                    'variation_id' => $variation->id
                ]);
            }


        }
    }
}

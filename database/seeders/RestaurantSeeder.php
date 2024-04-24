<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Restaurant;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Generar restaurantes de ejemplo
        for ($i = 0; $i < 50; $i++) {
            Restaurant::create([
                'name' => $faker->company,
                'description' => $faker->paragraph,
                'street' => $faker->streetName,
                'number' => $faker->buildingNumber,
                'city' => $faker->city  ,
                'postal_code' => $faker->postcode,
                'state' => $faker->state,
                'country' => $faker->country,
                'phone' => $faker->phoneNumber,
                'opening_time' => $faker->time(),
                'closing_time' => $faker->time(),
            ]);
        }
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Table;
use App\Models\Restaurant;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $restaurants = Restaurant::all();

        foreach($restaurants as $restaurant){
            for ($i=1; $i < rand(1,10); $i++) { 
                Table::create([
                    'restaurant_id' => $restaurant->id,
                    'table_number' => $i,
                ]);
            }
        }
    }
}

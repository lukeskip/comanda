<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Menu;
use App\Models\DishCatgory;

class Dish extends Model
{
    use HasFactory;

    public function menu()
    {
        return $this->belongsTo(Menu::class,"menu_id");
    }

    public function categories()
    {
        return $this->belongsToMany(DishCategory::class,'dish_dish_category');
    }
}

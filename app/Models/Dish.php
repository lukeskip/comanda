<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Menu;
use App\Models\DishCatgory;
use App\Models\Order;

class Dish extends Model
{
    use HasFactory;

    public function menu()
    {
        return $this->belongsTo(Menu::class,"menu_id");
    }

    public function orders(){
        return $this->belongsToMany(Order::class)->withTimestamps();;
    }
    public function variations(){
        return $this->hasMany(Variation::class);
    }

    public function categories()
    {
        return $this->belongsToMany(DishCategory::class,'dish_dish_category');
    }
}

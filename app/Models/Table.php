<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Restaurant;
use App\Models\Order;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Table extends Model
{
    use HasUuids,HasFactory;

    protected $fillable = [
        'restaurant_id', 'table_number', 'position'
    ];

    protected $appends = ['menu','activeOrder','categories'];

    public function restaurant(){
        return $this->belongsTo(Restaurant::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }


    public function getMenuAttribute()
    {

        $menu = $this->restaurant->menus()
            ->where('active', true)
            ->first();

        $menu->setRelation('dishes', $menu->dishes()->with('categories','variations.options')->get());
        
        return $menu;
    }
    public function getCategoriesAttribute()
    {
        $dishes = $this->menu->dishes;
        $categories = $dishes->flatMap(function ($dish) {
            return $dish->categories;
        })->unique('id');

        return $categories;
    }


    public function getActiveOrderAttribute()
    {
        $activeOrder = $this->orders()->where('status','active')->with('orderedDishes')->first();
        

        if(!$activeOrder){
            $activeOrder = Order::create(['status' =>'active','table_id'=>$this->id]);
        }

        return $activeOrder;
        
    }


}

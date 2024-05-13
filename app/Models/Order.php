<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Dish;
use App\Models\OrderedDish;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'status', 'table_id'
    ];

    protected $appends = ['total','users'];

    public function orderedDishes(){
        return $this->hasMany(OrderedDish::class,'order_id');
    }

    
    public function getTotalAttribute(){
        return $this->orderedDishes->sum('price');
    }
    public function getUsersAttribute(){
        $users = $this->orderedDishes->groupBy('group');
        $count = 0;

        foreach ($users as $user => $orders) {
            $count += 1;
            $users[$user] = [
                'index' => $count,
                'orders' => $orders,
                'total' => $orders->sum('price')
            ];
 
        }

        return $users;
    }
}

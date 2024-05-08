<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Dish;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'status', 'table_id'
    ];

    public function dishes(){
        return $this->belongsToMany(Dish::class,'order_dish_user')->withTimestamps();
    }
}

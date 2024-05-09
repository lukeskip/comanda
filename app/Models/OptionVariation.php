<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderDishUser;

class OptionVariation extends Model
{
    use HasFactory;

    public function orderDishUsers()
    {
        return $this->belongsToMany(OrderDishUser::class);
    }
}

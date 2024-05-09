<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OptionVariation;

class OrderDishUser extends Model
{
    use HasFactory;

    public function options()
    {
        return $this->belongsToMany(OptionVariation::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Restaurant;

class Menu extends Model
{
    use HasFactory;

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class,"restaurant_id");
    }
}

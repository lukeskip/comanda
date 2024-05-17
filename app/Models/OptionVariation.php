<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderedDish;

class OptionVariation extends Model
{
    use HasFactory;

    public function orderedDishes()
    {
        return $this->belongsToMany(OrderedDish::class);
    }

    public function variation()
    {
        return $this->belongsTo(Variation::class,'variation_id');
    }
}

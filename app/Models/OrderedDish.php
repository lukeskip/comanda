<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OptionVariation;

class OrderedDish extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'dish_id','user_id','token'];
    protected $appends = ['price'];

    public function options()
    {
        return $this->belongsToMany(OptionVariation::class,'option_variation_ordered_dishes');
    }

    public function dish()
    {
        return $this->belongsTo(Dish::class);
    }

    public function getPriceAttribute(){
        $dishPrice = $this->dish->price;
        $options = $this->options->sum('price');
        return $options + $dishPrice;
    }
}

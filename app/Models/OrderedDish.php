<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class OrderedDish extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'dish_id','user_id','token','message'];
    protected $appends = ['price','group'];

    public function options()
    {
        return $this->belongsToMany(OptionVariation::class,'option_variation_ordered_dishes')->with('variation');
    }

    public function dish()
    {
        return $this->belongsTo(Dish::class,'dish_id');
    }

    public function getPriceAttribute(){
       
        $dishPrice = $this->dish->price;
        $options = $this->options->sum('price');
        return $options + $dishPrice;
        
    }

    public function getGroupAttribute(){
       if($this->user_id){
        return $this->user_id;
       }else{
        return $this->token;
       }
    }
}

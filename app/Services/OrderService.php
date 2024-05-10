<?php

namespace App\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Dish;
use App\Models\OrderedDish;
use App\Models\OptionVariation;
use App\Events\OrderUpdated;

class OrderService {

    public function addItem ( Order $order,Request $request){
     

        if (Auth::check()) {
            $userId = $request->user()->id;
        } else {
            $userId = null;
        }

        
        $newOrderedDish = $order->orderedDishes()->create([
            'dish_id' => $request->dish_id,
            'token' => $request->token,
            'user_id' => $userId,
            'message'=>$request->message
        ]);

        foreach ($request->variations as $key => $options) {
            foreach ($options as $option) {
                $optionInstance =  OptionVariation::find($option['id']);
                $newOrderedDish->options()->attach($optionInstance);
            }
        }
        
        event(new OrderUpdated($order->id));

        return $order;

    }

}
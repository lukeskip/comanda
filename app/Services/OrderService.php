<?php

namespace App\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Dish;
use App\Events\OrderUpdated;

class OrderService {

    public function addItem ( Order $order,Request $request){
        $dish = Dish::find($request->dish_id);

        if (Auth::check()) {
            $userId = $request->user()->id;
        } else {
            $userId = null;
        }
        
        $order->dishes()->attach($dish->id, ['token' => $request->token,'user_id'=>$userId]);
        
        $orderDishUser = $order->dishes()->wherePivot('dish_id', $dish->id)->first()->pivot;

        return dump($orderDishUser->options()->attach());

        event(new OrderUpdated($order->id));

    }

}
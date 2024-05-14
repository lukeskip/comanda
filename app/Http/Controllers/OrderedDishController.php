<?php

namespace App\Http\Controllers;
use App\Events\OrderUpdated;

use Illuminate\Http\Request;
use App\Models\OrderedDish;

class OrderedDishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderedDish $orderedDish)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrderedDish $orderedDish)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrderedDish $orderedDish)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderedDish $orderedDish)
    {   
        $orderId =  $orderedDish->order_id;
        $orderedDish->delete();
        return event(new OrderUpdated($orderId));
    }
}
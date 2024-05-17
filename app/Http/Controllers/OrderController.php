<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Services\OrderService;
use Inertia\Inertia;

class OrderController extends Controller
{
    function __construct(OrderService $orderService){

        $this->service = $orderService;
        $this->rules = [
            'order_id' => 'required',
            'dish_id' => 'required',
        ];
    }

    public function addItemToOrder(Order $order, Request $request)
    {
        $validatedData = $request->validate([
            'dish_id' => 'required',
        ]);

        return $this->service->addItem($order,$request);
    }
    
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
    public function show(Order $order)
    {
        return Inertia::render('Order/Order.show', [
            'order' => $order,            
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}

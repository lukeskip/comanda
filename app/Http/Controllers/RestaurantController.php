<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRestaurantRequest;
use App\Http\Requests\UpdateRestaurantRequest;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Services\RestaurantService;
use Inertia\Inertia;

class RestaurantController extends Controller
{
    public function __construct(RestaurantService $restaurantService)
    {
        $this->service = $restaurantService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $restaurants =  $this->service->getAll($request); 
        return Inertia::render('Restaurant/Restaurant.index', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'restaurants' => $restaurants,            
        ]);
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
    public function store(StoreRestaurantRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $restaurant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRestaurantRequest $request, Restaurant $restaurant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant)
    {
        return $this->service->delete($restaurant);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDishCategoryRequest;
use App\Http\Requests\UpdateDishCategoryRequest;
use App\Models\DishCategory;

class DishCategoryController extends Controller
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
    public function store(StoreDishCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DishCategory $dishCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DishCategory $dishCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDishCategoryRequest $request, DishCategory $dishCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DishCategory $dishCategory)
    {
        //
    }
}

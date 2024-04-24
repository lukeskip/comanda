<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Services\MenuService;
use Inertia\Inertia;

class MenuController extends Controller
{
    public function __construct(MenuService $menuService)
    {
        $this->service = $menuService;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $menus =  $this->service->getAll($request); 
        return Inertia::render('Menu/Menu.index', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'menus' => $menus,            
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
    public function store(StoreMenuRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        return $this->service->delete($menu);
    }
}

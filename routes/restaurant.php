<?php
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\RestaurantController;

    Route::get('restaurantes', [RestaurantController::class, 'index'])->name('restaurants.index');
    Route::get('restaurantes/crear', [RestaurantController::class, 'create'])->name('restaurants.create');
    Route::post('restaurantes', [RestaurantController::class, 'store'])->name('restaurants.store');
    Route::get('restaurantes/{restaurant:id}', [RestaurantController::class, 'show'])->name('restaurants.show');
    Route::get('restaurantes/{restaurant:id}/editar', [RestaurantController::class, 'edit'])->name('restaurants.edit');
    Route::put('restaurantes/{restaurant:id}', [RestaurantController::class, 'update'])->name('restaurants.update');
    Route::delete('restaurantes/{restaurant:id}', [RestaurantController::class, 'destroy'])->name('restaurants.destroy');
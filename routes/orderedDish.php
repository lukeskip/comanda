<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderedDishController;


Route::delete('platillos-ordenados/{orderedDish:id}', [OrderedDishController::class, 'destroy'])->name('orderedDish.destroy');
Route::put('platillos-ordenados/{orderedDish:id}', [OrderedDishController::class, 'update'])->name('orderedDish.update');

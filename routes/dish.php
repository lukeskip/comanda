<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DishController;

Route::get('platillos', [DishController::class, 'index'])->name('dishes.index');
Route::get('platillos/create', [DishController::class, 'create'])->name('dishes.create');
Route::post('platillos', [DishController::class, 'store'])->name('dishes.store');
Route::get('platillos/{dish:id}', [DishController::class, 'show'])->name('dishes.show');
Route::get('platillos/{dish:id}/editar', [DishController::class, 'edit'])->name('dishes.edit');
Route::put('platillos/{dish:id}', [DishController::class, 'update'])->name('dishes.update');
Route::delete('platillos/{dish:id}', [DishController::class, 'destroy'])->name('dishes.destroy');

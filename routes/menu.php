<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;

Route::get('menus', [MenuController::class, 'index'])->name('menus.index');
Route::get('menus/create', [MenuController::class, 'create'])->name('menus.create');
Route::post('menus', [MenuController::class, 'store'])->name('menus.store');
Route::get('menus/{menu:id}', [MenuController::class, 'show'])->name('menus.show');
Route::get('menus/{menu:id}/editar', [MenuController::class, 'edit'])->name('menus.edit');
Route::put('menus/{menu:id}', [MenuController::class, 'update'])->name('menus.update');
Route::delete('menus/{menu:id}', [MenuController::class, 'destroy'])->name('menus.destroy');

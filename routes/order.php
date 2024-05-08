<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

Route::get('ordenes', [OrderController::class, 'index'])->name('orders.index');
Route::post('ordenes/addItem/{order:id}', [OrderController::class, 'addItemToOrder'])->name('orders.add');
Route::get('ordenes/create', [OrderController::class, 'create'])->name('orders.create');
Route::post('ordenes', [OrderController::class, 'store'])->name('orders.store');
Route::get('ordenes/{order:id}', [OrderController::class, 'show'])->name('orders.show');
Route::get('ordenes/{order:id}/editar', [OrderController::class, 'edit'])->name('orders.edit');
Route::put('ordenes/{order:id}', [OrderController::class, 'update'])->name('orders.update');
Route::delete('ordenes/{order:id}', [OrderController::class, 'destroy'])->name('orders.destroy');

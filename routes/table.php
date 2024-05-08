<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TableController;

Route::get('mesas', [TableController::class, 'index'])->name('tables.index');
Route::get('mesas/create', [TableController::class, 'create'])->name('tables.create');
Route::post('mesas', [TableController::class, 'store'])->name('tables.store');
Route::get('mesas/{table:id}', [TableController::class, 'show'])->name('tables.show');
Route::get('mesas/{table:id}/editar', [TableController::class, 'edit'])->name('tables.edit');
Route::put('mesas/{table:id}', [TableController::class, 'update'])->name('tables.update');
Route::delete('mesas/{table:id}', [TableController::class, 'destroy'])->name('tables.destroy');


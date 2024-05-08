<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Events\CartItemAdded;

class SocketController extends Controller
{

    public function handleCartItemAdded()
    {
        event(new CartItemAdded(['message' => 'hola']));
        \Log::info('Evento CartItemAdded emitido correctamente.');

        return response()->json(['message' => 'Elemento agregado al carrito exitosamente']);
    }
}
<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePedidoRequest;
use App\Models\Pedido;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::with('cliente')->get();

        return response()->json([
            'sucesso'  => true,
            'total'    => $pedidos->count(),
            'pedidos' => $pedidos,
        ]);
    }

    public function store(StorePedidoRequest $request)
    {
        $pedido = Pedido::create(
            $request->validated()
        );

        $pedido->load('cliente');

        return response()->json([
            'sucesso'  => true,
            'mensagem' => 'Pedido cadastrado!',
            'dados' => $pedido,
        ], 201);
    }

    public function show(Pedido $pedido)
    {
        $pedido->load('cliente');

        return response()->json([
            'sucesso'  => true,
            'pedido' => $pedido,
        ]);
    }
}

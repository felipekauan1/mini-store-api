<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClienteRequest;
use App\Models\Cliente;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();

        return response()->json([
            'sucesso'  => true,
            'total'    => $clientes->count(),
            'clientes' => $clientes,
        ]);
    }

    public function store(StoreClienteRequest $request)
    {
        $cliente = Cliente::create(
            $request->validated()
        );

        return response()->json([
            'sucesso'  => true,
            'mensagem' => 'Cliente cadastrado!',
            'dados' => $cliente,
        ]);
    }

    public function show(Cliente $cliente)
    {
        $cliente->load('pedidos');

        return response()->json([
            'sucesso'  => true,
            'cliente' => $cliente,
        ]);
    }
}

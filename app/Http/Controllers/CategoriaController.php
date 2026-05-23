<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoriaRequest;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();

        return response()->json([
            'sucesso'  => true,
            'total'    => $categorias->count(),
            'categorias' => $categorias,
        ]);
    }
    
    public function store(StoreCategoriaRequest $request)
    {
        $categoria = Categoria::create(
            $request->validated()
        );

        return response()->json([
            'sucesso'  => true,
            'mensagem' => 'Categoria cadastrada!',
            'dados' => $categoria,
        ]);
    }
}

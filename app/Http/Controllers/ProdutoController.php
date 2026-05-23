<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProdutoRequest;
use App\Http\Requests\UpdateProdutoRequest;
use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index(Request $request)
    {
        $produtos = Produto::with('categoria')
            ->when($request->categoria_id, function ($query) use ($request) {
                $query->where('categoria_id', $request->categoria_id);
            })
            ->when($request->nome, function ($query) use ($request) {
                $query->where('nome', 'like', '%' . $request->nome . '%');
            })
            ->get();

        return response()->json([
            'sucesso'  => true,
            'total'    => $produtos->count(),
            'produtos' => $produtos,
        ]);
    }

    public function store(StoreProdutoRequest $request)
    {
        $produto = Produto::create(
            $request->validated()
        );

        // Carrega o relacionamento antes de retornar
        $produto->load('categoria');

        return response()->json([
            'sucesso'  => true,
            'mensagem' => 'Produto cadastrado!',
            'dados'    => $produto,
        ], 201);
    }

    public function update(UpdateProdutoRequest $request, Produto $produto)
    {
        $produto->update(
            $request->validated()
        );

        $produto->refresh();

        // Carrega o relacionamento antes de retornar
        $produto->load('categoria');

        return response()->json([
            'sucesso'  => true,
            'mensagem' => 'Produto atualizado!',
            'dados'    => $produto,
        ]);
    }

    public function destroy(Produto $produto)
    {
        $produto->delete();

        return response()->json([
            'sucesso'  => true,
            'mensagem' => 'Produto removido!',
        ]);
    }
}

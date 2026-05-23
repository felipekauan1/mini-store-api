<?php

namespace App\Http\Controllers;

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
}

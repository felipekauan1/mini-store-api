<?php

namespace Database\Seeders;

use App\Models\Produto;
use Illuminate\Database\Seeder;

class ProdutoSeeder extends Seeder
{
    public function run(): void
    {
        $produtos = [
            ['nome' => 'Notebook Gamer',  'preco' => 3500.00, 'estoque' => 10, 'categoria_id' => 1],
            ['nome' => 'Mouse Gamer',     'preco' =>  150.00, 'estoque' => 25, 'categoria_id' => 2],
            ['nome' => 'Teclado Mecânico','preco' =>  300.00, 'estoque' => 15, 'categoria_id' => 2],
            ['nome' => 'Headset',         'preco' =>  200.00, 'estoque' => 20, 'categoria_id' => 2],
            ['nome' => 'Mousepad XL',     'preco' =>   50.00, 'estoque' => 50, 'categoria_id' => 3],
        ];

        foreach ($produtos as $produto) {
            Produto::create($produto);
        }
    }
}

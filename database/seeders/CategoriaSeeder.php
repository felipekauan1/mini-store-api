<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = ['Informática', 'Periféricos', 'Acessórios'];

        foreach ($categorias as $nome) {
            Categoria::create(['nome' => $nome]);
        }
    }
}

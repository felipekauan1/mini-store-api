<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = [
        'nome',
        'preco',
        'estoque',
        'categoria_id',
    ];

    protected $casts = [
        'preco'   => 'decimal:2',
        'estoque' => 'integer',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}

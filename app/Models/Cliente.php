<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'ativo',
    ];

    protected $casts = [
        'ativo' => 'boolean',
    ];

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
}

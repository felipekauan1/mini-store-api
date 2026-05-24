<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = [
        'cliente_id',
        'total',
        'status',  
    ];

    protected $casts = [
        'total'   => 'decimal:2',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}

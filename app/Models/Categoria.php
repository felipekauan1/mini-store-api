<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = [
        'nome',
    ];

    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'users_produtos';

    protected $fillable = [
        'nome',
        'marca',
        'modelo',
        'preco',
        'is_promocao',
        'descricao',
        'status',
        'id_inventario',
        'id_detalhes',
        'id_categoria',
    ];

    public function inventario(): HasOne
    {
        return $this->hasOne(inventario::class);
    }

    public function detalhes(): HasOne
    {
        return $this->hasOne(DetalhesProduto::class);
    }

    public function categoria(): HasOne
    {
        return $this->hasOne(Categoria::class);
    }
}

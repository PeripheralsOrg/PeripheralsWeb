<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class VendaTemporary extends Model
{
    use HasFactory;

    protected $table = 'temporary_venda';
    protected $primaryKey = 'id_temporary_venda';

    protected $fillable = [
        'valor_total',
        'frete',
        'prazo',
        'quantidade_items',
        'id_users',
        'id_carrinho',
        'id_endereco'
    ];

    use HasFactory;

    public function usuario(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function carrinho(): HasOne
    {
        return $this->hasOne(carrinho::class);
    }

    public function endereco(): HasOne
    {
        return $this->hasOne(Endereco::class);
    }
}

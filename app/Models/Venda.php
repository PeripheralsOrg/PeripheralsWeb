<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Venda extends Model
{
    use HasFactory;

    protected $table = 'users_venda';
    protected $primaryKey = 'id_venda';

    protected $fillable = [
        'valor_total',
        'frete',
        'valor_desconto_total',
        'quantidade_items',
        'id_users',
        'id_carrinho',
        'id_endereco',
        'id_venda_status'
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

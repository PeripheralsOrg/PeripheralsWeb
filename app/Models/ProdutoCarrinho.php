<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProdutoCarrinho extends Model
{
    use HasFactory;

    protected $table = 'users_produto_carrinho';

    protected $primaryKey = 'id_produto_carrinho';

    protected $fillable = [
        'quantidade',
        'valor_total',
        'valor_desconto',
        'id_produto',
        'id_carrinho'
    ];

    public function produto(): hasMany
    {
        return $this->hasMany(Produto::class, 'id_produtos', 'id_produto');
    }

    public function carrinho(): HasMany
    {
        return $this->hasMany(CarrinhoCompras::class);
    }
}

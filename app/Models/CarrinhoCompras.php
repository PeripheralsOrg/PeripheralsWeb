<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CarrinhoCompras extends Model
{
    use HasFactory;

    protected $table = 'users_carrinho';

    protected $primaryKey = 'id_carrinho';

    protected $fillable = [
        'valor_total',
        'quant_items',
        'status',
        'id_users'
    ];

    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function produtoCarrinho(): BelongsTo
    {
        return $this->belongsTo(CarrinhoCompras::class);
    }

    public function usersVenda(): BelongsTo
    {
        return $this->belongsTo(Venda::class);
    }
}

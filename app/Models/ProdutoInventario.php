<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class ProdutoInventario extends Model
{
    use HasFactory;

    protected $table = 'users_produto_inventario';

    protected $fillable = [
        'quantidade',
        'status'
    ];

    public function produto(): BelongsTo
    {
        return $this->belongsTo(Produto::class);
    }
}

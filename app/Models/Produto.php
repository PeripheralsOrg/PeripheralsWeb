<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'users_produtos';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_produtos';

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
        'id_marca',
    ];

    public function inventario(): HasOne
    {
        return $this->hasOne(inventario::class);
    }

    public function detalhes(): HasOne
    {
        return $this->hasOne(DetalhesProduto::class);
    }

    public function categoria(): HasMany
    {
        return $this->hasMany(Categoria::class);
    }

    public function marcas(): HasOne
    {
        return $this->hasOne(Marcas::class);
    }

    public function produto_carrinho(): BelongsTo
    {
        return $this->belongsTo(ProdutoCarrinho::class);
    }

    public function favoritos(): BelongsTo
    {
        return $this->belongsTo(Favoritos::class);
    }
}

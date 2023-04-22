<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class DetalhesProduto extends Model
{
    use HasFactory;

    protected $table = 'users_detalhes_produto';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_detalhes';

    protected $fillable = [
        'fonte_energia',
        'codigo',
        'tipo_tela',
        'tipo_audio',
        'tamanho',
        'resolucao',
        'tecnologia',
        'conexao',
        'microfone',
        'frequencia',
        'dpi',
        'cor',
        'material',
        'peso',
        'tipo_teclado',
        'garantia',
        'info_adicional',
        'status',
    ];

    public function produto(): BelongsTo
    {
        return $this->belongsTo(Produto::class);
    }
}

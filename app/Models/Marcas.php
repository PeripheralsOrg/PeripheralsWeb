<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Marcas extends Model
{
    use HasFactory;

    protected $table = 'adm_marcas';

    protected $primaryKey = 'id_marca';

    protected $fillable = [
        'nome',
        'descricao_atividades',
        'status',
    ];

    public function produto(): BelongsTo
    {
        return $this->belongsTo(Produto::class);
    }
}

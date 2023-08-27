<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cupom extends Model
{

    protected $table = 'users_cupom';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nome',
        'codigo',
        'tipo',
        'visibilidade',
        'data_expiracao',
        'porcentagem',
        'id_categoria',
        'id_marca',
        'status'
    ];

    use HasFactory;

    public function categoria(): HasOne
    {
        return $this->hasOne(Categoria::class);
    }
}

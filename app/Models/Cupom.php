<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cupom extends Model
{

    protected $table = 'users_cupom';

    protected $fillable = [
        'nome',
        'codigo',
        'data_expiracao',
        'porcentagem',
        'status'
    ];

    use HasFactory;

    public function categoria(): HasOne
    {
        return $this->hasOne(Categoria::class);
    }
}

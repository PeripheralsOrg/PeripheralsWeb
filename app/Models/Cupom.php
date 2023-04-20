<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}

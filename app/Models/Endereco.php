<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Endereco extends Model
{
    protected $table = 'users_endereco';
    protected $primaryKey = 'id_endereco';

    protected $fillable = [
        'tipo_logradouro',
        'logradouro',
        'bairro',
        'numero',
        'complemento',
        'cep',
        'ponto_ref',
        'estado',
        'cidade',
        'status',
        'id_users'
    ];

    use HasFactory;

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}

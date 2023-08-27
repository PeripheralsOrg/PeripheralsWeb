<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Avaliacao extends Model
{
    use HasFactory;

    protected $table = 'users_comentario';
    protected $primaryKey = 'id_comentario';

    protected $fillable = [
        'id_produto',
        'id_users',
        'titulo',
        'comentario',
        'avaliacao'
    ];

    use HasFactory;

    public function produto(): HasMany
    {
        return $this->hasMany(Produto::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Favoritos extends Model
{
    use HasFactory;

    protected $table = 'users_favoritos';

    protected $fillable = [
        'id_produto',
        'id_users'
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

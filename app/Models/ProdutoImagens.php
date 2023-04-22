<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProdutoImagens extends Model
{
    use HasFactory;

    protected $table = 'users_produto_imgs';

    protected $fillable = [
        'nome_img',
        'link_img',
        'id_produto'
    ];

    public function produto(): HasOne
    {
        return $this->hasOne(Produto::class);
    }
}

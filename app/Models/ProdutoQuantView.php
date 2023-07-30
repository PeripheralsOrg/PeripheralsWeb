<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdutoQuantView extends Model
{
    use HasFactory;

    protected $table = 'view_produto_quant';
    protected $primaryKey = 'id_produtos';
}

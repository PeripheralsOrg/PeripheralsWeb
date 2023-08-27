<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdutoView extends Model
{
    use HasFactory;

    protected $table = 'view_produto';
    protected $primaryKey = 'id_produtos';

}

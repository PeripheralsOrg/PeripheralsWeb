<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;

class AdmBanner extends \Illuminate\Foundation\Auth\User
{
    use HasFactory;
    use Authenticatable;
    use Authorizable;

    protected $table = 'adm_carrossel';

    protected $fillable = [
        'nome_banner',
        'link_carrossel',
        'link_carrosselMedium',
        'link_carrosselTiny',
        'link_route',
        'status',
        'peso'
    ];
}

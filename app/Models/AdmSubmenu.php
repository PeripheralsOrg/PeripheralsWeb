<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;

class AdmSubmenu extends \Illuminate\Foundation\Auth\User
{
    use HasFactory;
    use Authenticatable;
    use Authorizable;

    protected $table = 'adm_submenu';

    protected $fillable = [
        'titulo_submenu',
        'link_submenu',
        'status'
    ];
}

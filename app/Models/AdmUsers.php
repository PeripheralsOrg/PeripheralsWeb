<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;

class AdmUsers extends \Illuminate\Foundation\Auth\User
{
    use HasFactory;
    use Authenticatable;
    use Authorizable;

    protected $table = 'adm_users';

    public function getAuthPassword()
    {
        return $this->password;
    }
 
}

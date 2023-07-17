<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendaStatus extends Model
{
    use HasFactory;

    protected $table = 'users_venda_status';
    protected $primaryKey = 'id_status';

    protected $fillable = [
        'status_venda',
    ];



}

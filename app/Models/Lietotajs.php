<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Lietotajs extends Authenticatable
{
    use HasFactory;

    protected $table = 'lietotajs'; // Set the table name

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'username',
        'password',
    ];
}


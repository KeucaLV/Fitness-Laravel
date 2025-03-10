<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Lietotajs extends Authenticatable
{
    use Notifiable, HasApiTokens;

    protected $table = 'lietotajs'; // Specify your custom table

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'username',
        'password',
        'img',
        'goal_weight',
        'weight_now',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
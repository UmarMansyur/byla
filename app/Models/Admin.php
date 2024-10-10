<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends Authenticatable
{
    use HasFactory;

    protected $table = 'admin';
    protected $fillable = [
        'name',
        'username',
        'password',
        'email',
        'phone',
        'thumbnail',
        'birthday',
        'gender',
        'address',
        'gender',
        'address',
    ];
}

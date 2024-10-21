<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

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

    public function notifications()
    {
        return $this->hasMany(AdminNotification::class, 'admin_id', 'id');
    }
}

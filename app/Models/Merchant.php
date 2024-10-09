<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    use HasFactory;

    protected $table = 'merchants';
    protected $fillable = [
        'user_id',
        'merchant_code',
        'address',
        'is_verified',
        'verified_at',
    ];
}

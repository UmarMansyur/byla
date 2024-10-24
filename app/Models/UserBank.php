<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBank extends Model
{
    use HasFactory;
    protected $table = 'user_bank';
    protected $fillable = [
        'user_id',
        'bank_name',
        'bank_code',
        'rekening',
    ];
}

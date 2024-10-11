<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saldo extends Model
{
    use HasFactory;
    protected $table = 'saldo';
    protected $fillable = [
        'user_id',
        'pin',
        'saldo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

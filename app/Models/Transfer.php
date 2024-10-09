<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;
    protected $table = 'transfers';
    protected $fillable = ['saldo_id', 'kode_transfer', 'merchant_id', 'rekening', 'status'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAdmin extends Model
{
    use HasFactory;

    protected $table = 'bank_admin';
    protected $fillable = [
        'admin_id',
        'bank_name',
        'rekening',
        'bank_account_number',
        'bank_account_name',
    ];
}

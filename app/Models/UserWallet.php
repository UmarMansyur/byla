<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWallet extends Model
{
    use HasFactory;
    protected $table = 'user_wallet';
    protected $fillable = [
        'user_id',
        'kredit',
        'type',
        'debit',
        'saldo',
        'kode_transaksi',
        'kode_bank',
        'rekening',
        'rekening_pengirim',
        'nama',
        'bukti_pembayaran',
        'status',
        'keterangan',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}

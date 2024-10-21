<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaction extends Model
{
    use HasFactory;
    protected $table = 'detail_transactions';
    protected $fillable = ['transaction_id', 'kode_produk', 'title', 'description', 'nominal', 'quantity'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'kode_produk', 'kode_produk');
    }
}

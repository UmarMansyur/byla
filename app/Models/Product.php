<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = ['merchant_id', 'kode_produk', 'title', 'price', 'sale_price', 'thumbnail', 'description', 'stock'];

    public function merchant()
    {
        return $this->belongsTo(Merchant::class, 'merchant_id', 'id');
    }

    public function detail_transaction()
    {
        return $this->hasMany(DetailTransaction::class, 'kode_produk', 'kode_produk');
    }
}

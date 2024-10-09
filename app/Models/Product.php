<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = ['merchant_id', 'kode_produk', 'title', 'price', 'sale_price', 'thumbnail', 'description'];
}

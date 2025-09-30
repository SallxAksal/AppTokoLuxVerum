<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'nama',
        'tipe',
        'ukuran',
        'harga',
        'gambar',
        'deskripsi',
        'link_shopee',
        'link_tiktok_shop',
    ];
}

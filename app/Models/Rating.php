<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'product_id',
        'rating',
        'visitor_ip',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

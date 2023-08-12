<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'product_id', 'product_name', 'price', 'quantity', 'image'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
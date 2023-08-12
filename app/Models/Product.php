<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'price', 'description', 'image', 'brand_id', 'category_id'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function getBrandCategoryAttribute()
    {
        return [
            'brand' => $this->brand ? $this->brand->name : null,
            'category' => $this->category ? $this->category->name : null,
        ];
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image',
        'store_price',
        'original_price',
        'category',
        'brand',
        'product_code',
        'quantity',
        'size',
        'color',
        'status',
        'trending',
        'featured',
        'slug'
    ];

    // Define any relationships or additional methods here
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'product_id',
        'quantity',
        'user_id',
        'custom_image'
    ];

    // A cart item belongs to a product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // A cart item may belong to a user (nullable)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

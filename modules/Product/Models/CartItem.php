<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Product\Database\Factories\CartItemFactory;

class CartItem extends Model
{
    /** @use HasFactory<CartItemFactory> */
    use HasFactory;


    protected $fillable = [
        'quantity',
        'user_id',
        'product_id',
    ];

    protected $casts = [
        'user_id'       => 'integer',
        'product_id'    => 'integer',
        'quantity'      => 'integer',
    ];

    protected static function newFactory(): CartItemFactory
    {
        return new CartItemFactory();
    }
}

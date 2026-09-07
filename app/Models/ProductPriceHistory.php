<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPriceHistory extends Model
{
    protected $table = 'product_price_histories';

    protected $fillable = [
        'product_id',
        'price',
        'currency',
        'effective_at',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'effective_at' => 'datetime',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
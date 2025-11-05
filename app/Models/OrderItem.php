<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    // Relationship to Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    protected $fillable = [
        'order_id',
        'product_id',
        'name',
        'quantity',
        'unit_price',
        'line_total',
        'specifications',
    ];

    // Relationship to Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'number',
        'status',
        'total',
        'subtotal',
        'vat',
        'notes', // Added 'notes' field
        'use_manual_totals',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'vat' => 'decimal:2',
        'total' => 'decimal:2',
        'use_manual_totals' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(QuoteItem::class);
    }

    public function order()
    {
        return $this->hasOne(Order::class);
    }
}

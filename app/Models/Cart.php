<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];

    protected $casts = [
        'quantity' => 'integer',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Helper methods
    public function getSubtotalAttribute()
    {
        return $this->product->price * $this->quantity;
    }

    public function increaseQuantity($amount = 1)
    {
        $this->quantity += $amount;
        $this->save();
    }

    public function decreaseQuantity($amount = 1)
    {
        $this->quantity = max(1, $this->quantity - $amount);
        $this->save();
    }

    public function isInStock()
    {
        return $this->product && $this->product->stock >= $this->quantity;
    }
}
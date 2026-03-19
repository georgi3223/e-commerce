<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    // Relationships
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // Helper methods
    public function getActiveProductsCount()
    {
        return $this->products()->where('is_active', true)->count();
    }

    public function getInStockProductsCount()
    {
        return $this->products()
            ->where('is_active', true)
            ->where('stock', '>', 0)
            ->count();
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'category',
        'image',
        'stock',
        'weight' // Add this new field
    ];

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Product;

class Order extends Model
{
    use HasFactory;

   protected $fillable = [
    'user_id', 
    'name',
    'email',
    'address',
    'province',
    'city',
    'shipping_courier',
    'shipping_service',
    'shipping_cost',
    'subtotal',  // tambahkan ini
    'tax',       // tambahkan ini
    'total',
    'status'
];
public function user()
{
    return $this->belongsTo(User::class);
}

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_items')
            ->withPivot('quantity', 'price');
    }
    public function getUserAttribute()
{
    return $this->belongsTo(User::class)->first() ?? (object) ['name' => 'Unknown', 'email' => 'Unknown'];
}
public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    
}
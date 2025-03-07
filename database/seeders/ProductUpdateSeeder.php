<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductUpdateSeeder extends Seeder
{
    
    public function run()
    {
        $products = [
            // Coffee Based Drinks
            [
                'name' => 'Ice Americanooo',
                'description' => 'Classic cold brew coffee',
                'price' => 1.00, // 10K
                'stock' => 100,
                'category' => 'Coffee',
                'image' => 'img/kopi8.png',
            ]
    
        ];
            
       
    }
}

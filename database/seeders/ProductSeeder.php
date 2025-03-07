<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            // Coffee Based Drinks
            [
                'name' => 'Beras 5KG',
                'description' => 'Classic cold brew coffee',
                'price' => 1.00, // 10K
                'weight' => 5000, // 500 grams
                'stock' => 100,
                'category' => 'Coffee',
                 'image' => 'ice-americano.jpg',
            ],
            // [
            //     'name' => 'Coffee Latte',
            //     'description' => 'Espresso with steamed milk',
            //     'price' => 1.50, // 15K
            //     'stock' => 100,
            //     'category' => 'Coffee',
            //     'image' => 'coffee-latte.jpg',
            // ],
            // [
            //     'name' => 'Lemon Americano',
            //     'description' => 'Refreshing americano with lemon',
            //     'price' => 1.50, // 15K
            //     'stock' => 100,
            //     'category' => 'Coffee',
            //     'image' => 'lemon-americano.jpg',
            // ],
            // [
            //     'name' => 'Es Kopi Susu',
            //     'description' => 'Indonesian style milk coffee',
            //     'price' => 1.50, // 15K
            //     'stock' => 100,
            //     'category' => 'Coffee',
            //     'image' => 'es-kopi-susu.jpg',
            // ],
            // [
            //     'name' => 'Es Kopi Aren',
            //     'description' => 'Indonesian coffee with palm sugar',
            //     'price' => 1.70, // 17K
            //     'stock' => 100,
            //     'category' => 'Coffee',
            //     'image' => 'es-kopi-aren.jpg',
            // ],
            // [
            //     'name' => 'Caramel Macchiato',
            //     'description' => 'Espresso with caramel and steamed milk',
            //     'price' => 2.10, // 21K
            //     'stock' => 100,
            //     'category' => 'Coffee',
            //     'image' => 'caramel-macchiato.jpg',
            // ],
            // [
            //     'name' => 'Hazelnut Lattee',
            //     'description' => 'Coffee with hazelnut syrup and milk',
            //     'price' => 2.00, // 20K
            //     'stock' => 100,
            //     'category' => 'Coffee',
            //     'image' => 'hazelnut-lattee.jpg',
            // ],
            // [
            //     'name' => 'Salted Caramel Lattee',
            //     'description' => 'Coffee with salted caramel and milk',
            //     'price' => 2.00, // 20K
            //     'stock' => 100,
            //     'category' => 'Coffee',
            //     'image' => 'salted-caramel-lattee.jpg',
            // ],
            // [
            //     'name' => 'Vanilla Lattee',
            //     'description' => 'Coffee with vanilla syrup and milk',
            //     'price' => 2.00, // 20K
            //     'stock' => 100,
            //     'category' => 'Coffee',
            //     'image' => 'vanilla-lattee.jpg',
            // ],

            // // Tea Based Drinks
            // [
            //     'name' => 'Ice Tea',
            //     'description' => 'Classic ice tea',
            //     'price' => 0.70, // 7K
            //     'stock' => 100,
            //     'category' => 'Tea',
            //     'image' => 'ice-tea.jpg',
            // ],
            // [
            //     'name' => 'Lemon Tea',
            //     'description' => 'Ice tea with lemon',
            //     'price' => 1.00, // 10K
            //     'stock' => 100,
            //     'category' => 'Tea',
            //     'image' => 'lemon-tea.jpg',
            // ],
            // [
            //     'name' => 'Peach Tea',
            //     'description' => 'Ice tea with peach',
            //     'price' => 1.00, // 10K
            //     'stock' => 100,
            //     'category' => 'Tea',
            //     'image' => 'peach-tea.jpg',
            // ],
            // [
            //     'name' => 'Milk Tea',
            //     'description' => 'Classic milk tea',
            //     'price' => 1.20, // 12K
            //     'stock' => 100,
            //     'category' => 'Tea',
            //     'image' => 'milk-tea.jpg',
            // ],
            // [
            //     'name' => 'Vanilla Milk Tea',
            //     'description' => 'Milk tea with vanilla',
            //     'price' => 1.50, // 15K
            //     'stock' => 100,
            //     'category' => 'Tea',
            //     'image' => 'vanilla-milk-tea.jpg',
            // ],
            // [
            //     'name' => 'Caramel Milk Tea',
            //     'description' => 'Milk tea with caramel',
            //     'price' => 1.50, // 15K
            //     'stock' => 100,
            //     'category' => 'Tea',
            //     'image' => 'caramel-milk-tea.jpg',
            // ],

            // // Refreshing Beverages
            // [
            //     'name' => 'Lime Squash',
            //     'description' => 'Refreshing lime-based drink',
            //     'price' => 1.20, // 12K
            //     'stock' => 100,
            //     'category' => 'Refresh',
            //     'image' => 'lime-squash.jpg',
            // ],
            // [
            //     'name' => 'Mango Squash',
            //     'description' => 'Refreshing mango-based drink',
            //     'price' => 1.20, // 12K
            //     'stock' => 100,
            //     'category' => 'Refresh',
            //     'image' => 'mango-squash.jpg',
            // ],
            // [
            //     'name' => 'Orange Squash',
            //     'description' => 'Refreshing orange-based drink',
            //     'price' => 1.20, // 12K
            //     'stock' => 100,
            //     'category' => 'Refresh',
            //     'image' => 'orange-squash.jpg',
            // ],
            // [
            //     'name' => 'Blue Ocean',
            //     'description' => 'Refreshing blue ocean themed drink',
            //     'price' => 1.50, // 15K
            //     'stock' => 100,
            //     'category' => 'Refresh',
            //     'image' => 'blue-ocean.jpg',
            // ],
            // [
            //     'name' => 'Mango',
            //     'description' => 'Fresh mango drink',
            //     'price' => 1.70, // 17K
            //     'stock' => 100,
            //     'category' => 'Refresh',
            //     'image' => 'mango.jpg',
            // ],
            // [
            //     'name' => 'Peach',
            //     'description' => 'Fresh peach drink',
            //     'price' => 1.70, // 17K
            //     'stock' => 100,
            //     'category' => 'Refresh',
            //     'image' => 'peach.jpg',
            // ],
            // [
            //     'name' => 'Caramel Mango',
            //     'description' => 'Mango drink with caramel',
            //     'price' => 2.00, // 20K
            //     'stock' => 100,
            //     'category' => 'Refresh',
            //     'image' => 'caramel-mango.jpg',
            // ],
            // [
            //     'name' => 'Choco Hazelnut',
            //     'description' => 'Rich chocolate drink with hazelnut',
            //     'price' => 1.70, // 17K
            //     'stock' => 100,
            //     'category' => 'Refresh',
            //     'image' => 'choco-hazelnut.jpg',
            // ],
            // [
            //     'name' => 'Dark Chocolate',
            //     'description' => 'Rich dark chocolate drink',
            //     'price' => 1.70, // 17K
            //     'stock' => 100,
            //     'category' => 'Refresh',
            //     'image' => 'dark-chocolate.jpg',
            // ],
            // [
            //     'name' => 'Matcha Latte',
            //     'description' => 'Japanese green tea latte',
            //     'price' => 1.70, // 17K
            //     'stock' => 100,
            //     'category' => 'Refresh',
            //     'image' => 'matcha-latte.jpg',
            // ],
            // [
            //     'name' => 'Red Velvet',
            //     'description' => 'Creamy red velvet drink',
            //     'price' => 1.70, // 17K
            //     'stock' => 100,
            //     'category' => 'Refresh',
            //     'image' => 'red-velvet.jpg',
            // ],
            // [
            //     'name' => 'Creamy Banana',
            //     'description' => 'Smooth banana milk drink',
            //     'price' => 1.70, // 17K
            //     'stock' => 100,
            //     'category' => 'Refresh',
            //     'image' => 'creamy-banana.jpg',
            // ],
            // [
            //     'name' => 'Strawberry Cheese',
            //     'description' => 'Strawberry drink with cheese foam',
            //     'price' => 1.70, // 17K
            //     'stock' => 100,
            //     'category' => 'Refresh',
            //     'image' => 'strawberry-cheese.jpg',
            // ],
            // [
            //     'name' => 'Taro Basic',
            //     'description' => 'Classic taro milk drink',
            //     'price' => 1.70, // 17K
            //     'stock' => 100,
            //     'category' => 'Refresh',
            //     'image' => 'taro-basic.jpg',
            // ],
            // [
            //     'name' => 'Choco Mint',
            //     'description' => 'Chocolate drink with mint',
            //     'price' => 1.80, // 18K
            //     'stock' => 100,
            //     'category' => 'Refresh',
            //     'image' => 'choco-mint.jpg',
            // ],
            // [
            //     'name' => 'Taro Fusion',
            //     'description' => 'Special taro milk drink blend',
            //     'price' => 2.00, // 20K
            //     'stock' => 100,
            //     'category' => 'Refresh',
            //     'image' => 'taro-fusion.jpg',
            // ],
        ];
            
        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
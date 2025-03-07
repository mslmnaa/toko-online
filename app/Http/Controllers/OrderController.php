<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\CartItem;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Services\RajaOngkirService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Database\Seeders\ProductSeeder;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;


class OrderController extends Controller
{
    protected $rajaOngkir;

    public function __construct(RajaOngkirService $rajaOngkir)
    {
        $this->rajaOngkir = $rajaOngkir;
    }

    public function checkout()
    {
        $cartItems = session()->get('cart', []);
        $provinces = $this->rajaOngkir->getProvinces();
        return view('orders.checkout', compact('cartItems', 'provinces'));
    }
    public function getProvinces()
    {
        $provinces = $this->rajaOngkir->getProvinces();
        Log::info('Provinces: ' . json_encode($provinces));
        return response()->json($provinces);
    }

    public function getCities($provinceId = null)
    {
        $cities = $this->rajaOngkir->getCities($provinceId);
        Log::info('Cities for province ' . $provinceId . ': ' . json_encode($cities));
        return response()->json($cities);
    }

    public function calculateShipping(Request $request)
    {
        $weight = $this->calculateTotalWeight();
        $shippingCosts = $this->rajaOngkir->calculateShipping(
            $request->city_id,
            $weight,
            $request->courier
        );
        return response()->json($shippingCosts);
    }
    
    private function calculateTotalWeight()
    {
        $cartItems = session()->get('cart', []);
        $weight = 0;
        foreach ($cartItems as $productId => $item) {
            // Fetch the actual product to get its weight
            $product = Product::findOrFail($productId);
            
            // Use the product's weight, defaulting to 1000 grams if not set
            $productWeight = $product->weight ?? 1000;
            
            // Calculate total weight for this product
            $weight += $productWeight * $item['quantity'];
        }
        return $weight;
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'address' => 'required',
                'province' => 'required',
                'city' => 'required',
                'shipping_courier' => 'required',
                'shipping_service' => 'required',
                'shipping_cost' => 'required|numeric',
                'tax' => 'numeric'
            ]);
    
            $cartItems = session()->get('cart', []);
            
            // Hitung subtotal
            $subtotal = array_sum(array_map(function($item) {
                return $item['price'] * $item['quantity'];
            }, $cartItems));
    
            $tax = $subtotal * 0.12; // 12% tax
            $shippingCost = $request->shipping_cost;
            
            // Hitung total
            $total = $subtotal + $tax + $shippingCost;
    
            // Buat order
            $order = Order::create([
                'user_id' => auth()->id(),
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'address' => $validatedData['address'],
                'province' => $validatedData['province'],
                'city' => $validatedData['city'],
                'shipping_courier' => $validatedData['shipping_courier'],
                'shipping_service' => $validatedData['shipping_service'],
                'shipping_cost' => $shippingCost,
                'subtotal' => $subtotal,  // tambahkan ini
                'tax' => $tax,           // tambahkan ini
                'total' => $total,
                'status' => 'pending',
            ]);
            Log::info('Order created: ' . $order->id);
    
            // Buat order items
            foreach ($cartItems as $productId => $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }
    
            Log::info('Order items created');
            if (Auth::check()) {
                // Hapus cart items dari database
                CartItem::where('user_id', auth()->id())->delete();
            }
            
            // Hapus session cart
            session()->forget('cart');
            
            return redirect()->route('orders.confirmation', $order);
    
            // Kosongkan cart
          
        } catch (\Exception $e) {
            Log::error('Order creation failed: ' . $e->getMessage());
            Log::error('Request data: ' . json_encode($request->all()));
            
            return back()
                ->withInput()
                ->with('error', 'Error processing order: ' . $e->getMessage());
        }
    }
   
    public function confirmation(Order $order)
{
    $order->load('items.product'); // Memastikan items dan product ter-load
    return view('orders.confirmation', compact('order'));
}

public function history()
{
    $orders = Order::where('user_id', auth()->id())
                  ->orderBy('created_at', 'desc')
                  ->with(['items.product'])
                  ->paginate(10);
                  
    return view('orders.history', compact('orders'));
}

public function show(Order $order)
{
    // Memastikan user hanya bisa melihat ordernya sendiri
    if ($order->user_id !== auth()->id()) {
        abort(403);
    }

    return view('orders.show', compact('order'));
}

}
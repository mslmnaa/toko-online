<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;

class CartController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth')->only(['update', 'remove']);
    }
    public function index()
    {
        if (Auth::check()) {
            // Jika user login, ambil cart dari database
            $cartItems = [];
            $dbCartItems = CartItem::where('user_id', Auth::id())
                ->with('product')
                ->get();
                
            foreach ($dbCartItems as $item) {
                $cartItems[$item->product_id] = [
                    "name" => $item->product->name,
                    "quantity" => $item->quantity,
                    "price" => $item->product->price,
                    "image" => $item->product->image
                ];
            }
            
            // Update session cart dengan data dari database
            session()->put('cart', $cartItems);
        } else {
            // Jika guest, ambil dari session
            $cartItems = session()->get('cart', []);
        }
        
        return view('cart.index', compact('cartItems'));
    }
public function add(Request $request, Product $product)
{
    // Jika user sudah login
    if (Auth::check()) {
        $cartItem = CartItem::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();
            
        if ($cartItem) {
            $cartItem->quantity++;
            $cartItem->save();
        } else {
            CartItem::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => 1
            ]);
        }
    }
    
    // Update session cart
    $cart = session()->get('cart', []);
    
    if (isset($cart[$product->id])) {
        $cart[$product->id]['quantity']++;
    } else {
        $cart[$product->id] = [
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
            "image" => $product->image
        ];
    }
    
    session()->put('cart', $cart);
    return redirect()->back()->with('success', 'Product added to cart successfully!');
}

    public function mergeSessionCartWithDatabase()
    {
        if (Auth::check()) {
            $sessionCart = session()->get('cart', []);
            
            foreach ($sessionCart as $productId => $details) {
                $cartItem = CartItem::where('user_id', Auth::id())
                    ->where('product_id', $productId)
                    ->first();
                
                if ($cartItem) {
                    $cartItem->quantity += $details['quantity'];
                    $cartItem->save();
                } else {
                    CartItem::create([
                        'user_id' => Auth::id(),
                        'product_id' => $productId,
                        'quantity' => $details['quantity']
                    ]);
                }
            }
            
            session()->forget('cart');
            
            // Tambahkan kode ini untuk memulihkan cart dari database
            $dbCartItems = CartItem::where('user_id', Auth::id())
                ->with('product')
                ->get();
                
            $cart = [];
            foreach ($dbCartItems as $item) {
                $cart[$item->product_id] = [
                    "name" => $item->product->name,
                    "quantity" => $item->quantity,
                    "price" => $item->product->price,
                    "image" => $item->product->image
                ];
            }
            
            session()->put('cart', $cart);
        }
    }

    public function update(Request $request, $id)
    {
        if (Auth::check()) {
            $cartItem = CartItem::where('user_id', Auth::id())
                ->where('product_id', $id)
                ->first();
                
            if ($cartItem) {
                $cartItem->quantity = $request->quantity;
                $cartItem->save();
            }
        }
        
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }
    
        return redirect()->route('cart.index')->with('success', 'Cart updated successfully!');
    }
    
    public function remove($id)
    {
        if (Auth::check()) {
            CartItem::where('user_id', Auth::id())
                ->where('product_id', $id)
                ->delete();
        }
        
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
    
        return redirect()->route('cart.index')->with('success', 'Product removed successfully!');
    }

    // private function updateCartCount()
    // {
    //     if (Auth::check()) {
    //         $cartCount = Auth::user()->cartItems()->sum('quantity');
    //     } else {
    //         $cart = session()->get('cart', []);
    //         $cartCount = array_sum(array_column($cart, 'quantity'));
    //     }
    //     session()->put('cartCount', $cartCount);
    // }
}


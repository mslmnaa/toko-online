<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    { 
        $coffeeProducts = Product::where('category', 'Coffee')->orWhereNull('category')->get();
        $teaProducts = Product::where('category', 'Tea')->get();
        $refreshProducts = Product::where('category', 'Refresh')->get();

        return view('menu', compact('coffeeProducts', 'teaProducts', 'refreshProducts'));
    }
}


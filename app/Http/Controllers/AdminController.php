<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function loginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function dashboard()
    {
        
        return view(view: 'admin.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
    public function index()
{
    // Get statistics
    $totalRevenue = Order::sum('total');
    $totalOrders = Order::count();
    $totalProducts = Product::count();
    $totalUsers = User::count();

    // Get data for sales chart (last 6 months)
    $salesData = Order::selectRaw('DATE_FORMAT(created_at, "%M") as month, SUM(total) as total')
        ->whereYear('created_at', now()->year)
        ->groupBy('month')
        ->orderBy('created_at')
        ->get();

    $salesChart = [
        'labels' => $salesData->pluck('month'),
        'data' => $salesData->pluck('total'),
    ];

    // Get data for orders by category chart
    $ordersData = Product::select('category', DB::raw('count(*) as total'))
        ->join('order_items', 'products.id', '=', 'order_items.product_id')
        ->groupBy('category')
        ->get();

    $ordersChart = [
        'labels' => $ordersData->pluck('category'),
        'data' => $ordersData->pluck('total'),
    ];

    // Get recent orders
    $recentOrders = Order::with('user')
        ->latest()
        ->take(5)
        ->get();

    // Calculate growth percentages (month over month)
    $currentMonthRevenue = Order::whereMonth('created_at', now()->month)->sum('total');
    $lastMonthRevenue = Order::whereMonth('created_at', now()->subMonth()->month)->sum('total');
    $revenueGrowth = $lastMonthRevenue != 0 ? 
        (($currentMonthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100 : 0;

    return view('admin.dashboard', compact(
        'totalRevenue',
        'totalOrders',
        'totalProducts',
        'totalUsers',
        'salesChart',
        'ordersChart',
        'recentOrders',
        'revenueGrowth'
    ));
}
}


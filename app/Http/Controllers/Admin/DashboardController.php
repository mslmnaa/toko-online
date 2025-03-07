<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class DashboardController extends Controller
{
    public function index()
    {
        
        // Time periods
        $today = Carbon::today();
        $startOfWeek = Carbon::now()->startOfWeek();
        $startOfMonth = Carbon::now()->startOfMonth();
        $last30Days = Carbon::now()->subDays(30);

        // Basic Statistics
        $totalRevenue = Order::sum('total');
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalUsers = User::count();

        // Sales Statistics
        $salesStats = [
            'daily' => Order::whereDate('created_at', $today)->sum('total'),
            'weekly' => Order::whereBetween('created_at', [$startOfWeek, now()])->sum('total'),
            'monthly' => Order::whereBetween('created_at', [$startOfMonth, now()])->sum('total')
        ];

        // Calculate Growth
        $previousMonth = Order::whereBetween('created_at', [
            Carbon::now()->subMonths(2)->startOfMonth(),
            Carbon::now()->subMonths(1)->endOfMonth()
        ])->sum('total');
        
        $currentMonth = Order::whereBetween('created_at', [
            Carbon::now()->subMonth()->startOfMonth(),
            Carbon::now()->subMonth()->endOfMonth()
        ])->sum('total');

        $salesGrowth = $previousMonth != 0 ? 
            (($currentMonth - $previousMonth) / $previousMonth) * 100 : 0;

        // Order Statistics
        $orderStats = [
            'total' => $totalOrders,
            'pending' => Order::where('status', 'pending')->count(),
            'processing' => Order::where('status', 'processing')->count(),
            'completed' => Order::where('status', 'completed')->count()
        ];

        // Customer Statistics
        $newCustomers = [
            'today' => User::whereDate('created_at', $today)->count(),
            'weekly' => User::whereBetween('created_at', [$startOfWeek, now()])->count(),
            'monthly' => User::whereBetween('created_at', [$startOfMonth, now()])->count()
        ];

        // Chart Data - Daily Sales (Last 7 days)
        $dailySales = Order::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(total) as total_sales'),
            DB::raw('COUNT(*) as order_count')
        )
            ->whereBetween('created_at', [Carbon::now()->subDays(6), now()])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Prepare Chart Data
        $chartData = [
            'labels' => $dailySales->pluck('date')->map(function($date) {
                return Carbon::parse($date)->format('M d');
            })->toArray(),
            'sales' => $dailySales->pluck('total_sales')->toArray(),
            'orders' => $dailySales->pluck('order_count')->toArray()
        ];

        // Top Products
        $topProducts = DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->select(
                'products.name',
                DB::raw('SUM(order_items.quantity) as total_quantity'),
                DB::raw('SUM(order_items.quantity * order_items.price) as total_revenue')
            )
            ->groupBy('products.id', 'products.name')
            ->orderBy('total_quantity', 'desc')
            ->limit(5)
            ->get();

        // Financial Summary
        $financialSummary = [
            'revenue' => $salesStats['monthly'],
            'refunds' => Order::whereBetween('created_at', [$startOfMonth, now()])
                ->where('status', 'refunded')
                ->sum('total'),
            'expenses' => 0
        ];

        $sales_chart_options = [
            'chart_title' => 'Sales by Day',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Order',
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'aggregate_function' => 'sum',
            'aggregate_field' => 'total',
            'chart_type' => 'line',
            'filter_field' => 'created_at',
            'filter_days' => 7,
            'continuous_time' => true,
            'show_blank_data' => true,
            'chart_color' => '66, 133, 244',
        ];
        $orders_chart_options = [
            'chart_title' => 'Orders by Day',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Order',
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'aggregate_function' => 'count',
            'chart_type' => 'line',
            'filter_field' => 'created_at',
            'filter_days' => 7,
            'continuous_time' => true,
            'show_blank_data' => true,
            'chart_color' => '66, 186, 150',
        ];

        $salesChart = new LaravelChart($sales_chart_options);
        $ordersChart = new LaravelChart($orders_chart_options);


        // Low Stock Products
        $lowStockProducts = Product::where('stock', '<=', 10)
            ->select('name', 'stock')
            ->get();

            return view('admin.dashboard', compact(
                'totalRevenue',
                'totalOrders',
                'totalProducts',
                'totalUsers',
                'salesStats',
                'salesGrowth',
                'orderStats',
                'newCustomers',
                'chartData',
                'topProducts',
                'lowStockProducts',
                'financialSummary',
                'salesChart',
                'ordersChart'
        ));
    }
}
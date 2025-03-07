<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }
    
    public function show(Order $order)
    {
        $order->load(['items.product', 'user']);
        return view('admin.orders.show', compact('order'));
    }
    
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
        ]);
        
        $order->status = $request->status;
        $order->save();
        
        return redirect()->route('admin.orders.index')->with('success', 'Order status updated successfully');
    }
    public function history(Request $request)
{
    $query = Order::query();

    if ($request->has('status') && $request->status != '') {
        $query->where('status', $request->status);
    }

    if ($request->has('date_from') && $request->date_from != '') {
        $query->whereDate('created_at', '>=', $request->date_from);
    }

    if ($request->has('date_to') && $request->date_to != '') {
        $query->whereDate('created_at', '<=', $request->date_to);
    }

    $orders = $query->paginate(10);
    return view('orders.history', compact('orders'));
}

}
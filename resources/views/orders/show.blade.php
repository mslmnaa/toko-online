@extends('layouts.main')

@section('content')
<div class="min-h-screen bg-gray-50 pt-20">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Order Details</h1>
                    <p class="mt-2 text-gray-600">Order #{{ $order->id }}</p>
                </div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                    {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : 
                       ($order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                    {{ ucfirst($order->status) }}
                </span>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <!-- Customer Details -->
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Customer Details</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600">Name</p>
                        <p class="font-medium">{{ $order->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Email</p>
                        <p class="font-medium">{{ $order->email }}</p>
                    </div>
                    <div class="col-span-2">
                        <p class="text-sm text-gray-600">Delivery Address</p>
                        <p class="font-medium">{{ $order->address }}</p>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Order Items</h2>
                <div class="space-y-4">
                    @foreach($order->items as $item)
                        <div class="flex justify-between items-center py-4 border-b border-gray-200 last:border-0">
                            <div class="flex items-center">
                                @if($item->product->image)
                                    <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" 
                                         class="w-16 h-16 object-cover rounded-lg mr-4">
                                @endif
                                <div>
                                    <h3 class="font-medium text-gray-900">{{ $item->product->name }}</h3>
                                    <p class="text-sm text-gray-500">Quantity: {{ $item->quantity }}</p>
                                </div>
                            </div>
                            <span class="font-medium text-gray-900">
                                ${{ number_format($item->price * $item->quantity, 2) }}
                            </span>
                        </div>
                    @endforeach

                    <!-- Order Summary -->
                    <div class="mt-6 space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="font-medium">${{ number_format($order->subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Tax</span>
                            <span class="font-medium">${{ number_format($order->tax, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Shipping</span>
                            <span class="font-medium">${{ number_format($order->shipping_cost, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-lg font-semibold pt-4 border-t border-gray-200">
                            <span>Total</span>
                            <span class="text-primary-600">${{ number_format($order->total, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 flex justify-center">
            <a href="{{ route('orders.history') }}" 
               class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                </svg>
                Back to Order History
            </a>
        </div>
    </div>
</div>
@endsection
@extends('layouts.main')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-bold text-primary-800 mb-8">Your Cart</h1>
    @if(count($cartItems) > 0)
        <div class="bg-white rounded-lg shadow-md p-6 mb-4">
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="text-left font-semibold">Product</th>
                        <th class="text-left font-semibold">Price</th>
                        <th class="text-left font-semibold">Quantity</th>
                        <th class="text-left font-semibold">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $id => $details)
                        <tr>
                            <td class="py-4">
                                <div class="flex items-center">
                                    <img class="h-16 w-16 mr-4" src="{{ $details['image'] }}" alt="{{ $details['name'] }}">
                                    <span class="font-medium">{{ $details['name'] }}</span>
                                </div>
                            </td>
                            <td class="py-4">${{ number_format($details['price'], 2) }}</td>
                            <td class="py-4">{{ $details['quantity'] }}</td>
                            <td class="py-4">${{ number_format($details['price'] * $details['quantity'], 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="flex justify-between items-center">
            <a href="{{ route('menu') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-full hover:bg-gray-300 transition-colors duration-200">
                Continue Shopping
            </a>
            <div class="text-right">
                @php
                    $total = array_reduce($cartItems, function ($carry, $item) {
                        return $carry + ($item['price'] * $item['quantity']);
                    }, 0);
                @endphp
                <p class="text-lg mb-2">Subtotal: <span class="font-bold">${{ number_format($total, 2) }}</span></p>
                <p class="text-lg mb-2">Tax: <span class="font-bold">${{ number_format($total * 0.1, 2) }}</span></p>
                <p class="text-xl font-bold mb-4">Total: <span class="text-primary-600">${{ number_format($total * 1.1, 2) }}</span></p>
                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4" role="alert">
                    <p class="font-bold">Please log in to proceed with your purchase.</p>
                    <p>You need to be logged in to update your cart or checkout.</p>
                </div>
                <a href="{{ route('login') }}" class="bg-primary-600 text-white px-6 py-3 rounded-full hover:bg-primary-700 transition-colors duration-200">
                    Log In to Checkout
                </a>
            </div>
        </div>
    @else
        <p class="text-lg text-gray-600">Your cart is empty. <a href="{{ route('menu') }}" class="text-primary-600 hover:text-primary-800">Start shopping</a></p>
    @endif
</div>
@endsection


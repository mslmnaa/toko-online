@extends('layouts.main')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Cart Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8 mt-10">
        <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900">Your Shopping Cart</h1>
        <a href="{{ route('menu') }}" 
           class="inline-flex items-center text-primary-600 hover:text-primary-700 font-medium transition-colors duration-200">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
            </svg>
            <span>Continue Shopping</span>
        </a>
    </div>

    @if(count($cartItems) > 0)
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-8 border border-gray-200">
            <!-- Cart Items -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Product</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Price</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Quantity</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Total</th>
                            @auth
                                <th class="px-6 py-4"></th>
                            @endauth
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($cartItems as $id => $details)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-6">
                                    <div class="flex items-center">
                                        <img class="h-20 w-20 rounded-xl object-cover mr-4 border border-gray-200" 
                                             src="{{ $details['image'] }}" 
                                             alt="{{ $details['name'] }}">
                                        <div>
                                            <h3 class="text-lg font-medium text-gray-900">{{ $details['name'] }}</h3>
                                            @if(isset($details['description']))
                                                <p class="text-sm text-gray-600 mt-1">{{ $details['description'] }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-6">
                                    <span class="text-gray-900 font-medium">${{ number_format($details['price'], 2) }}</span>
                                </td>
                                <td class="px-6 py-6">
                                    @auth
                                        <form action="{{ route('cart.update', $id) }}" method="POST" 
                                              class="flex items-center space-x-3">
                                            @csrf
                                            @method('PATCH')
                                            <div class="flex items-center border border-gray-300 rounded-lg shadow-sm">
                                                <button type="button" 
                                                        onclick="this.parentNode.querySelector('input[type=number]').stepDown()"
                                                        class="px-3 py-2 border-r border-gray-300 hover:bg-gray-100 text-gray-600 font-medium transition-colors duration-200">
                                                    -
                                                </button>
                                                <input type="number" 
                                                       name="quantity" 
                                                       value="{{ $details['quantity'] }}" 
                                                       min="1" 
                                                       max="10" 
                                                       class="w-16 text-center border-none focus:ring-0 text-gray-900">
                                                <button type="button" 
                                                        onclick="this.parentNode.querySelector('input[type=number]').stepUp()"
                                                        class="px-3 py-2 border-l border-gray-300 hover:bg-gray-100 text-gray-600 font-medium transition-colors duration-200">
                                                    +
                                                </button>
                                            </div>
                                            <button type="submit" 
                                                    class="text-sm text-primary-600 hover:text-primary-800 font-medium transition-colors duration-200">
                                                Update
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-gray-900 font-medium">{{ $details['quantity'] }}</span>
                                    @endauth
                                </td>
                                <td class="px-6 py-6">
                                    <span class="font-semibold text-gray-900">
                                        ${{ number_format($details['price'] * $details['quantity'], 2) }}
                                    </span>
                                </td>
                                @auth
                                    <td class="px-6 py-6 text-right">
                                        <form action="{{ route('cart.remove', $id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="text-red-500 hover:text-red-700 transition-colors duration-200 p-2 rounded-lg hover:bg-red-50">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                @endauth
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="lg:grid lg:grid-cols-12 lg:gap-8">
            <div class="lg:col-span-7">
                <!-- Additional space for future content -->
            </div>
            <div class="lg:col-span-5">
                <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-200">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Order Summary</h2>
                    @php
                        $subtotal = array_reduce($cartItems, function ($carry, $item) {
                            return $carry + ($item['price'] * $item['quantity']);
                        }, 0);
                        $tax = $subtotal * 0.12;
                        $total = $subtotal + $tax;
                    @endphp
                    <div class="space-y-4">
                        <div class="flex justify-between text-base text-gray-600">
                            <span>Subtotal</span>
                            <span class="font-medium">${{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-base text-gray-600">
                            <span>Tax (12%)</span>
                            <span class="font-medium">${{ number_format($tax, 2) }}</span>
                        </div>
                        <div class="border-t border-gray-200 pt-4 mt-4">
                            <div class="flex justify-between text-xl font-bold text-gray-900">
                                <span>Total</span>
                                <span>${{ number_format($total, 2) }}</span>
                            </div>
                        </div>
                        
                        @auth
                            <a href="{{ route('checkout') }}" 
                               class="mt-8 block w-full bg-primary-600 text-white text-center px-6 py-4 rounded-xl
                                      hover:bg-primary-700 transition-colors duration-200 font-semibold text-lg shadow-sm">
                                Proceed to Checkout
                            </a>
                        @else
                            <div class="mt-6 bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-lg">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-yellow-800">Authentication Required</h3>
                                        <p class="text-sm text-yellow-700 mt-1">
                                            Please log in to proceed with your purchase and manage your cart.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('login') }}" 
                               class="mt-4 block w-full bg-primary-600 text-white text-center px-6 py-4 rounded-xl
                                      hover:bg-primary-700 transition-colors duration-200 font-semibold text-lg shadow-sm">
                                Log In to Checkout
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Empty Cart State -->
        <div class="text-center py-20 bg-white rounded-2xl shadow-lg border border-gray-200">
            <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <h3 class="mt-6 text-2xl font-bold text-gray-900">Your cart is empty</h3>
            <p class="mt-2 text-lg text-gray-600">Start adding some items to your cart!</p>
            <a href="{{ route('menu') }}" 
               class="mt-8 inline-flex items-center bg-primary-600 text-white px-8 py-4 rounded-xl
                      hover:bg-primary-700 transition-colors duration-200 font-semibold text-lg shadow-sm">
                Browse Menu
            </a>
        </div>
    @endif
</div>

<script>
    // Prevent negative numbers in quantity input
    document.querySelectorAll('input[type=number]').forEach(function(input) {
        input.addEventListener('input', function() {
            if (this.value < 1) this.value = 1;
            if (this.value > 10) this.value = 10;
        });
    });
</script>
@endsection
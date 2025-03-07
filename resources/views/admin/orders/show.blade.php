<x-admin-layout>
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Order #{{ $order->id }}</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Placed on {{ $order->created_at->format('M d, Y H:i') }}</p>
            </div>
            <div>
                <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600 dark:hover:bg-gray-700">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to Orders
                </a>
            </div>
        </div>
        
        <!-- Order Status -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Order Status</h2>
            <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="flex items-center space-x-4">
                    <select name="status" class="rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                        <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                        Update Status
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Customer Information -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Customer Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-md font-medium text-gray-700 dark:text-gray-300">Contact Details</h3>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                        <span class="block font-medium">Name:</span> {{ $order->name }}
                    </p>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        <span class="block font-medium">Email:</span> {{ $order->email }}
                    </p>
                </div>
                <div>
                    <h3 class="text-md font-medium text-gray-700 dark:text-gray-300">Shipping Address</h3>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                        {{ $order->address }}<br>
                        {{ $order->city }}, {{ $order->province }}
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Order Items -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Order Items</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700/50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Product</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Price</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Quantity</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Total</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($order->items as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        @if($item->product && $item->product->image)
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-md object-cover" src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}">
                                            </div>
                                        @endif
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $item->product ? $item->product->name : 'Product Removed' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-white">$ {{ number_format($item->price, 2, '.', ',') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-white">{{ $item->quantity }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-white">$ {{ number_format($item->price * $item->quantity, 2, '.', ',') }}</div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Order Summary -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Order Summary</h2>
            <div class="space-y-2">
                <div class="flex justify-between">
                    <span class="text-sm text-gray-600 dark:text-gray-400">Subtotal:</span>
                    <span class="text-sm font-medium text-gray-900 dark:text-white">$ {{ number_format($order->subtotal, 2, '.', ',') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-sm text-gray-600 dark:text-gray-400">Shipping:</span>
                    <span class="text-sm font-medium text-gray-900 dark:text-white">$ {{ number_format($order->shipping_cost, 2, '.', ',') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-sm text-gray-600 dark:text-gray-400">Tax:</span>
                    <span class="text-sm font-medium text-gray-900 dark:text-white">$ {{ number_format($order->tax, 2, '.', ',') }}</span>
                </div>
                <div class="pt-2 border-t border-gray-200 dark:border-gray-700 flex justify-between">
                    <span class="text-base font-bold text-gray-900 dark:text-white">Total:</span>
                    <span class="text-base font-bold text-gray-900 dark:text-white">$ {{ number_format($order->total, 2, '.', ',') }}</span>
                </div>
            </div>
        </div>
        
        <!-- Shipping Information -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Shipping Information</h2>
            <div class="space-y-2">
                <div class="flex justify-between">
                    <span class="text-sm text-gray-600 dark:text-gray-400">Courier:</span>
                    <span class="text-sm font-medium text-gray-900 dark:text-white">{{ strtoupper($order->shipping_courier) }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-sm text-gray-600 dark:text-gray-400">Service:</span>
                    <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $order->shipping_service }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-sm text-gray-600 dark:text-gray-400">Cost:</span>
                    <span class="text-sm font-medium text-gray-900 dark:text-white">$ {{ number_format($order->shipping_cost, 2, '.', ',') }}</span>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
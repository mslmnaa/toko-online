@extends('layouts.main')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-gray-50 to-gray-100 pt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="space-y-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Order History</h1>
                    <p class="mt-2 text-gray-600">View and track all your orders</p>
                </div>
                <div>
                    <a href="{{ route('menu') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                        </svg>
                        Browse Menu
                    </a>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-100">
                <form action="{{ route('orders.history') }}" method="GET" class="space-y-4">
                    <h2 class="text-lg font-medium text-gray-900">Filter Orders</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select id="status" name="status" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm rounded-md">
                                <option value="">All Statuses</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="date_from" class="block text-sm font-medium text-gray-700">From Date</label>
                            <input type="date" id="date_from" name="date_from" value="{{ request('date_from') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                        </div>
                        
                        <div>
                            <label for="date_to" class="block text-sm font-medium text-gray-700">To Date</label>
                            <input type="date" id="date_to" name="date_to" value="{{ request('date_to') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                        </div>
                    </div>
                    
                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('orders.history') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            Reset
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            Filter
                        </button>
                    </div>
                </form>
            </div>

            <!-- Status Pills -->
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('orders.history') }}" class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium {{ !request('status') ? 'bg-primary-100 text-primary-800 border-2 border-primary-300' : 'bg-gray-100 text-gray-800 hover:bg-gray-200' }}">
                    All
                </a>
                <a href="{{ route('orders.history', ['status' => 'pending'] + request()->except('status', 'page')) }}" class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium {{ request('status') == 'pending' ? 'bg-yellow-100 text-yellow-800 border-2 border-yellow-300' : 'bg-gray-100 text-gray-800 hover:bg-gray-200' }}">
                    Pending
                </a>
                <a href="{{ route('orders.history', ['status' => 'processing'] + request()->except('status', 'page')) }}" class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium {{ request('status') == 'processing' ? 'bg-blue-100 text-blue-800 border-2 border-blue-300' : 'bg-gray-100 text-gray-800 hover:bg-gray-200' }}">
                    Processing
                </a>
                <a href="{{ route('orders.history', ['status' => 'completed'] + request()->except('status', 'page')) }}" class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium {{ request('status') == 'completed' ? 'bg-green-100 text-green-800 border-2 border-green-300' : 'bg-gray-100 text-gray-800 hover:bg-gray-200' }}">
                    Completed
                </a>
                <a href="{{ route('orders.history', ['status' => 'cancelled'] + request()->except('status', 'page')) }}" class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium {{ request('status') == 'cancelled' ? 'bg-red-100 text-red-800 border-2 border-red-300' : 'bg-gray-100 text-gray-800 hover:bg-gray-200' }}">
                    Cancelled
                </a>
            </div>

            @if($orders->isEmpty())
                <div class="bg-white rounded-xl shadow-sm p-8 text-center border border-gray-100">
                    <div class="bg-gray-50 inline-flex items-center justify-center h-24 w-24 rounded-full mb-4">
                        <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900">No orders found</h3>
                    @if(request('status') || request('date_from') || request('date_to'))
                        <p class="mt-1 text-sm text-gray-500">Try changing your filter criteria or reset filters.</p>
                        <div class="mt-6">
                            <a href="{{ route('orders.history') }}" class="inline-flex items-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 transition-all hover:-translate-y-1">
                                Reset Filters
                            </a>
                        </div>
                    @else
                        <p class="mt-1 text-sm text-gray-500">Start your culinary journey with us today!</p>
                        <div class="mt-6">
                            <a href="{{ route('menu') }}" class="inline-flex items-center px-6 py-3 border border-transparent shadow-sm text-base font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 transform transition hover:-translate-y-1">
                                Explore Our Menu
                                <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </a>
                        </div>
                    @endif
                </div>
            @else
                <div class="flex items-center justify-between">
                    <p class="text-sm text-gray-600">Showing {{ $orders->firstItem() }} to {{ $orders->lastItem() }} of {{ $orders->total() }} orders</p>
                    <div class="flex items-center">
                        <label for="sort" class="mr-2 text-sm font-medium text-gray-700">Sort by:</label>
                        <select id="sort" name="sort" onchange="window.location.href=this.options[this.selectedIndex].value" class="text-sm border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500">
                            <option value="{{ route('orders.history', ['sort' => 'newest'] + request()->except('sort', 'page')) }}" 
                                {{ request('sort', 'newest') == 'newest' ? 'selected' : '' }}>Newest First</option>
                            <option value="{{ route('orders.history', ['sort' => 'oldest'] + request()->except('sort', 'page')) }}" 
                                {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                            <option value="{{ route('orders.history', ['sort' => 'highest'] + request()->except('sort', 'page')) }}" 
                                {{ request('sort') == 'highest' ? 'selected' : '' }}>Highest Amount</option>
                            <option value="{{ route('orders.history', ['sort' => 'lowest'] + request()->except('sort', 'page')) }}" 
                                {{ request('sort') == 'lowest' ? 'selected' : '' }}>Lowest Amount</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-2">
                    @foreach($orders as $order)
                        <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition-all duration-300 transform hover:-translate-y-1 border border-gray-100">
                            <div class="p-6">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">
                                            Order #{{ $order->id }}
                                        </h3>
                                        <p class="mt-1 text-sm text-gray-500">
                                            Placed on {{ $order->created_at->format('M d, Y at h:i A') }}
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-lg font-medium text-gray-900">${{ number_format($order->total, 2) }}</p>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium 
                                            {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : 
                                               ($order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                               ($order->status === 'processing' ? 'bg-blue-100 text-blue-800' : 
                                               ($order->status === 'cancelled' ? 'bg-red-100 text-red-800' :
                                               'bg-gray-100 text-gray-800'))) }}">
                                            {{ ucfirst($order->status) }}
                                            @if($order->status === 'completed')
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                            @elseif($order->status === 'processing')
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 animate-spin" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                                </svg>
                                            @elseif($order->status === 'cancelled')
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <div class="mt-4 border-t border-gray-200 pt-4">
                                    <div class="flex items-center space-x-2 text-sm text-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        <div>{{ $order->items->count() }} {{ Str::plural('item', $order->items->count()) }}</div>
                                    </div>
                                    
                                    @if($order->items->count() > 0)
                                        <div class="mt-3 flex flex-wrap gap-2">
                                            @foreach($order->items->take(3) as $item)
                                                <span class="inline-flex items-center px-2 py-1 rounded text-xs bg-gray-100 text-gray-800">
                                                    {{ $item->product->name }}
                                                </span>
                                            @endforeach
                                            @if($order->items->count() > 3)
                                                <span class="inline-flex items-center px-2 py-1 rounded text-xs bg-gray-100 text-gray-800">
                                                    +{{ $order->items->count() - 3 }} more
                                                </span>
                                            @endif
                                        </div>
                                    @endif
                                    
                                    <div class="mt-4 flex justify-between items-center">
                                        <div>
                                            @if($order->status === 'completed')
                                                <button class="text-sm text-primary-600 hover:text-primary-700 font-medium">
                                                    Order Again
                                                </button>
                                            @endif
                                        </div>
                                        <a href="{{ route('orders.show', $order) }}" 
                                           class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                                            View Details
                                            <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $orders->appends(request()->except('page'))->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection                                                    
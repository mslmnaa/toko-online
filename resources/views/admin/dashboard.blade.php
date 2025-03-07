<x-admin-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">
                        Dashboard Overview
                    </h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Welcome back, {{ Auth::user()->name }}
                    </p>
                </div>
                <div class="flex space-x-3">
                    <button onclick="window.print()" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600 dark:hover:bg-gray-700">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        Download Report
                    </button>
                </div>
            </div>

            <!-- Sales Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <!-- Daily Sales Card -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Daily Sales</h3>
                        <span class="text-green-500 text-sm font-medium">+4.5%</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">
                                ${{ number_format($salesStats['daily'], 2) }}
                            </p>
                            <p class="text-sm text-gray-500">Today's Revenue</p>
                        </div>
                        <div class="p-3 bg-green-50 dark:bg-green-900/20 rounded-full">
                            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Orders Card -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Orders</h3>
                        <span class="text-blue-500 text-sm font-medium">
                            {{ $orderStats['pending'] }} pending
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">
                                {{ $orderStats['total'] }}
                            </p>
                            <p class="text-sm text-gray-500">All Time Orders</p>
                        </div>
                        <div class="p-3 bg-blue-50 dark:bg-blue-900/20 rounded-full">
                            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- New Customers Card -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">New Customers</h3>
                        <span class="text-purple-500 text-sm font-medium">This Month</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">
                                {{ $newCustomers['monthly'] }}
                            </p>
                            <p class="text-sm text-gray-500">New Users</p>
                        </div>
                        <div class="p-3 bg-purple-50 dark:bg-purple-900/20 rounded-full">
                            <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Monthly Revenue Card -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Monthly Revenue</h3>
                        <span class="text-yellow-500 text-sm font-medium">
                            {{ number_format($salesGrowth, 1) }}% growth
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">
                                ${{ number_format($salesStats['monthly'], 2) }}
                            </p>
                            <p class="text-sm text-gray-500">This Month</p>
                        </div>
                        <div class="p-3 bg-yellow-50 dark:bg-yellow-900/20 rounded-full">
                            <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sales Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Sales Chart -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Sales Overview</h3>
                    <div class="h-80">
                        {!! $salesChart->renderHtml() !!}
                    </div>
                </div>

                <!-- Orders Chart -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Orders Overview</h3>
                    <div class="h-80">
                        {!! $ordersChart->renderHtml() !!}
                    </div>
                </div>
            </div>

            <!-- Two Column Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Top Products -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Top Products</h3>
                    <div class="space-y-4">
                        @foreach($topProducts as $product)
                        <div class="flex items-center justify-between border-b border-gray-200 dark:border-gray-700 pb-4">
                            <div>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $product->name }}</p>
                                <p class="text-sm text-gray-500">{{ $product->total_quantity }} units sold</p>
                            </div>
                            <div class="text-right">
                                <p class="font-medium text-gray-900 dark:text-white">
                                    ${{ number_format($product->total_revenue, 2) }}
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Alerts & Notifications -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Important Notifications</h3>
                    <div class="space-y-4">
                        @if($lowStockProducts->isNotEmpty())
                            @foreach($lowStockProducts as $product)
                            <div class="flex items-center p-4 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg">
                                <svg class="w-6 h-6 text-yellow-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-yellow-800 dark:text-yellow-200">
                                        Low Stock Alert: {{ $product->name }}
                                    </p>
                                    <p class="text-sm text-yellow-700 dark:text-yellow-300">
                                        Only {{ $product->stock }} units remaining
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        @endif

                        @if($orderStats['pending'] > 0)
                        <div class="flex items-center p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                            <svg class="w-6 h-6 text-blue-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-blue-800 dark:text-blue-200">
                                    Pending Orders
                                </p>
                                <p class="text-sm text-blue-700 dark:text-blue-300">
                                    {{ $orderStats['pending'] }} orders need processing
                                </p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Financial Summary -->
            <div class="mt-6 bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Financial Summary</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Total Revenue -->
                    <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Revenue</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white mt-2">
                            ${{ number_format($financialSummary['revenue'], 2) }}
                        </p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">This Month</p>
                    </div>

                    <!-- Refunds -->
                    <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Refunds</p>
                        <p class="text-2xl font-bold text-red-600 dark:text-red-400 mt-2">
                            ${{ number_format($financialSummary['refunds'], 2) }}
                        </p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">This Month</p>
                    </div>

                    <!-- Net Revenue -->
                    <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Net Revenue</p>
                        <p class="text-2xl font-bold text-green-600 dark:text-green-400 mt-2">
                            ${{ number_format($financialSummary['revenue'] - $financialSummary['refunds'], 2) }}
                        </p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">This Month</p>
                    </div>

                    <!-- Average Order Value -->
                    <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Avg Order Value</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white mt-2">
                            ${{ number_format($orderStats['total'] > 0 ? $financialSummary['revenue'] / $orderStats['total'] : 0, 2) }}
                        </p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">This Month</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    {!! $salesChart->renderChartJsLibrary() !!}
    {!! $salesChart->renderJs() !!}
    {!! $ordersChart->renderJs() !!}
@endpush
</x-admin-layout>
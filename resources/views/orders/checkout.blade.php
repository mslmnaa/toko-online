@extends('layouts.main')

@section('title', 'Checkout - Geraimu Coffee Shop')

@section('content')
<div class="bg-gray-50 min-h-screen pt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="space-y-4 mb-8">
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Checkout</h1>
            <p class="text-lg text-gray-600">Complete your order with secure checkout</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Billing Details Form -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-8">Billing Details</h2>
                
                <form action="{{ route('orders.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <!-- Hidden fields -->
                    <input type="hidden" name="shipping_cost" id="shipping_cost_input">
                    <input type="hidden" name="shipping_courier" id="shipping_courier_input">
                    <input type="hidden" name="shipping_service" id="shipping_service_input">
                    
                    <!-- Error messages -->
                    @if($errors->any())
                        <div class="bg-red-50 text-red-600 p-4 rounded-lg mb-6 border border-red-200">
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                
                    @if(session('error'))
                        <div class="bg-red-50 text-red-600 p-4 rounded-lg mb-6 border border-red-200">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="space-y-6">
                        <!-- Personal Information -->
                        <div class="space-y-4">
                            <h3 class="font-semibold text-gray-800 border-b pb-2">Personal Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                    <input type="text" name="name" id="name" 
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors duration-200 shadow-sm"
                                        placeholder="Enter your full name" required>
                                </div>
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                                    <input type="tel" name="phone" id="phone" 
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors duration-200 shadow-sm"
                                        placeholder="Enter your phone number" required>
                                </div>
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                                <input type="email" name="email" id="email" 
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors duration-200 shadow-sm"
                                    placeholder="your@email.com" required>
                            </div>
                        </div>

                        <!-- Shipping Information -->
                        <div class="space-y-4">
                            <h3 class="font-semibold text-gray-800 border-b pb-2">Shipping Information</h3>
                            <div>
                                <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Delivery Address</label>
                                <textarea name="address" id="address" rows="3" 
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors duration-200 shadow-sm"
                                    placeholder="Enter your complete address" required></textarea>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="province" class="block text-sm font-medium text-gray-700 mb-1">Province</label>
                                    <select name="province" id="province" 
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 shadow-sm" required>
                                        <option value="">Select Province</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="city" class="block text-sm font-medium text-gray-700 mb-1">City</label>
                                    <select name="city" id="city" 
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 shadow-sm" required>
                                        <option value="">Select City</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Shipping Method -->
                        <div class="space-y-4">
                            <h3 class="font-semibold text-gray-800 border-b pb-2">Shipping Method</h3>
                            <div>
                                <label for="courier" class="block text-sm font-medium text-gray-700 mb-1">Courier Service</label>
                                <select name="courier" id="courier" 
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 shadow-sm" required>
                                    <option value="">Select Courier</option>
                                    <option value="jne">JNE</option>
                                    <option value="pos">POS Indonesia</option>
                                    <option value="tiki">TIKI</option>
                                </select>
                            </div>

                            <div id="shipping-services">
                                <label class="block text-sm font-medium text-gray-700 mb-3">Shipping Service</label>
                                <div id="shipping-options" class="space-y-3 bg-gray-50 p-4 rounded-lg">
                                    <!-- Shipping options will be populated here -->
                                </div>
                            </div>
                        </div>

                        <!-- Additional Notes -->
                        <div>
                            <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Order Notes (Optional)</label>
                            <textarea name="notes" id="notes" rows="2" 
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors duration-200 shadow-sm"
                                placeholder="Any special instructions for your order?"></textarea>
                        </div>
                    </div>

                    <div class="pt-6">
                        <button type="submit" 
                            class="w-full bg-primary-600 text-white px-8 py-4 rounded-lg hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-200 font-semibold text-lg shadow-md">
                            Place Order
                        </button>
                    </div>
                </form>
            </div>

            <!-- Order Summary -->
            <div class="space-y-6">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Order Summary</h2>
                    <div class="space-y-4">
                        @php
                            // Calculate subtotal from cart items
                            $subtotal = array_sum(array_map(function($item) {
                                return $item['price'] * $item['quantity'];
                            }, $cartItems));
                            
                            // Calculate tax
                            $tax = $subtotal * 0.12;
                        @endphp
                        @foreach($cartItems as $id => $details)
                            <div class="flex justify-between items-center py-4 border-b border-gray-100">
                                <div class="flex items-center space-x-4">
                                    <div>
                                        <h3 class="font-medium text-gray-900">{{ $details['name'] }}</h3>
                                        <p class="text-sm text-gray-500">Quantity: {{ $details['quantity'] }}</p>
                                    </div>
                                </div>
                                <span class="font-medium text-gray-900">${{ number_format($details['price'] * $details['quantity'], 2) }}</span>
                            </div>
                        @endforeach

                        <div class="pt-4 space-y-3">
                            <div class="flex justify-between items-center py-2">
                                <span class="text-gray-600">Subtotal</span>
                                <span class="font-medium text-gray-900" id="subtotal">${{ number_format($subtotal, 2) }}</span>
                            </div>
                            
                            <div class="flex justify-between items-center py-2">
                                <span class="text-gray-600">Tax (12%)</span>
                                <span class="font-medium text-gray-900 tax-amount">${{ number_format($tax, 2) }}</span>
                            </div>

                            <div class="flex justify-between items-center py-2">
                                <span class="text-gray-600">Delivery Fee</span>
                                <span class="font-medium text-gray-900 shipping-cost">$0.00</span>
                            </div>

                            <div class="flex justify-between items-center py-3 text-lg font-bold border-t border-gray-200 mt-2">
                                <span>Total</span>
                                <span class="text-primary-600 total">${{ number_format($subtotal + $tax, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Secure Payment Notice -->
                <div class="bg-green-50 rounded-xl p-6 border border-green-200">
                    <div class="flex items-center space-x-4">
                        <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        <div>
                            <h3 class="font-semibold text-gray-900">Secure Checkout</h3>
                            <p class="text-sm text-gray-600">Your payment information is protected with industry-standard encryption</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const selectedService = document.querySelector('input[name="shipping_service"]:checked');
            if (!selectedService) {
                alert('Please select a shipping service');
                return;
            }

            document.getElementById('shipping_cost_input').value = selectedService.dataset.cost;
            document.getElementById('shipping_courier_input').value = document.getElementById('courier').value;
            document.getElementById('shipping_service_input').value = selectedService.value;

            form.submit();
        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Fungsi untuk konversi Rupiah ke USD
    function convertToUSD(rupiahAmount) {
        const rate = 15500;
        return (rupiahAmount / rate).toFixed(2);
    }

    // Fungsi untuk update ringkasan pesanan
    function updateOrderSummary() {
        let selectedService = $('input[name="shipping_service"]:checked');
        if (selectedService.length) {
            let shippingCost = parseFloat(selectedService.data('cost'));
            let subtotal = parseFloat($('#subtotal').text().replace('$', ''));
            let tax = subtotal * 0.12; // 10% tax
            let total = subtotal + tax + shippingCost;
            
            // Update tampilan
            $('.shipping-cost').text('$' + shippingCost.toFixed(2));
            $('.tax-amount').text('$' + tax.toFixed(2));
            $('.total').text('$' + total.toFixed(2));

            // Update hidden input untuk tax
            $('#tax_input').val(tax.toFixed(2));
        }
    }

    // 1. Mengambil data provinsi
    $.get('/provinces', function(data) {
        let provinceSelect = $('#province');
        provinceSelect.empty();
        provinceSelect.append('<option value="">Select Province</option>');
        $.each(data, function(key, value) {
            provinceSelect.append(`<option value="${value.province_id}">${value.province}</option>`);
        });
    });

    // 2. Mengambil data kota ketika provinsi dipilih
    $('#province').change(function() {
        let provinceId = $(this).val();
        let citySelect = $('#city');
        
        citySelect.empty();
        citySelect.append('<option value="">Select City</option>');
        
        if (provinceId) {
            $.get(`/cities/${provinceId}`, function(data) {
                $.each(data, function(key, value) {
                    citySelect.append(`<option value="${value.city_id}">${value.city_name}</option>`);
                });
            });
        }
    });

    // 3. Menghitung ongkos kirim ketika kurir dipilih
    $('#courier').change(function() {
        let cityId = $('#city').val();
        let courier = $(this).val();
        
        if (!cityId) {
            alert('Please select city first');
            $(this).val('');
            return;
        }
        
        if (cityId && courier) {
            $.post('/shipping-cost', {
                city_id: cityId,
                courier: courier,
                _token: $('meta[name="csrf-token"]').attr('content')
            }, function(data) {
                let shippingOptions = $('#shipping-options');
                shippingOptions.empty();
                
                data.forEach(function(service) {
                    let costInRupiah = service.cost[0].value;
                    let costInUSD = convertToUSD(costInRupiah);
                    let serviceCode = service.service;
                    let description = `${service.service} - $${costInUSD}`;
                    
                    shippingOptions.append(`
                        <div class="flex items-center space-x-3 p-2 border rounded">
                            <input type="radio" 
                                name="shipping_service" 
                                id="service_${serviceCode}"
                                value="${serviceCode}"
                                data-cost="${costInUSD}"
                                class="shipping-service-radio">
                            <label for="service_${serviceCode}">${description}</label>
                        </div>
                    `);
                });
                
                $('#shipping-services').removeClass('hidden');
            });
        }
    });

    // 4. Update total ketika layanan pengiriman dipilih
    $(document).on('change', '.shipping-service-radio', function() {
    updateOrderSummary();
});
    // 5. Handle form submission
    $('form').on('submit', function(e) {
        e.preventDefault();
        
        // Validasi input
        if (!$('#city').val()) {
            alert('Please select a city');
            return;
        }
        
        if (!$('#courier').val()) {
            alert('Please select a courier');
            return;
        }
        
        let selectedService = $('input[name="shipping_service"]:checked');
        if (!selectedService.length) {
            alert('Please select a shipping service');
            return;
        }
        
        // Set nilai untuk hidden inputs
        $('#shipping_cost_input').val(selectedService.data('cost'));
        $('#shipping_courier_input').val($('#courier').val());
        $('#shipping_service_input').val(selectedService.val());
        
        // Submit form
        this.submit();
    });
});
</script>
@endsection
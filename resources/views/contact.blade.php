@extends('layouts.main')

@section('content')
<div class="relative bg-gradient-to-br from-primary-50 via-primary-100 to-primary-200 py-32 overflow-hidden">
    {{-- Background with blur --}}
    <div class="absolute inset-0 transform scale-105" 
         style="background-image: url('/img/kopi10.jpg'); 
                background-size: cover; 
                background-position: center; 
                background-attachment: fixed; 
                filter: blur(4px);">
    </div>
    <script src="//unpkg.com/alpinejs" defer></script>
    
    {{-- Hero content --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="text-center space-y-4">
            <h1 class="text-5xl md:text-6xl font-bold text-white text-shadow font-bold animate-fade-in-down">
                Get in Touch
            </h1>
            <p class="text-xl md:text-2xl text-white text-shadow font-semibold z-10 animate-fade-in-up max-w-2xl mx-auto">
                Have questions about our coffee? We'd love to hear from you and help!
            </p>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 pb-16 relative z-10">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        {{-- Contact Form Card --}}
        <div class="bg-white rounded-xl shadow-xl border border-primary-100 transform hover:scale-[1.02] transition-all duration-300">
            <div class="p-8">
                <h2 class="text-2xl font-bold text-primary-800 mb-6">Send us a Message</h2>

                {{-- Form --}}
                <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                    @csrf

                    {{-- Name Field --}}
                    <div class="space-y-2">
                        <label for="name" class="text-sm font-medium text-gray-700">Full Name</label>
                        <input type="text" 
                               name="name" 
                               id="name" 
                               class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors @error('name') border-red-500 @enderror"
                               value="{{ old('name') }}"
                               required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email Field --}}
                    <div class="space-y-2">
                        <label for="email" class="text-sm font-medium text-gray-700">Email Address</label>
                        <input type="email" 
                               name="email" 
                               id="email" 
                               class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors @error('email') border-red-500 @enderror"
                               value="{{ old('email') }}"
                               required>
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Message Field --}}
                    <div class="space-y-2">
                        <label for="message" class="text-sm font-medium text-gray-700">Your Message</label>
                        <textarea name="message" 
                                  id="message" 
                                  rows="5" 
                                  class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors @error('message') border-red-500 @enderror"
                                  required>{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit" 
                            class="w-full bg-primary-600 hover:bg-primary-700 text-white font-medium py-3 px-6 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        Send Message
                    </button>
                </form>
            </div>
        </div>
   

{{-- Modal --}}
@if(session('success') || session('error'))
    <div x-data="{ showModal: true }" x-show="showModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg w-96 p-6">
            <h2 class="text-lg font-semibold @if(session('success')) text-green-700 @else text-red-700 @endif">
                @if(session('success'))
                    Success
                @else
                    Error
                @endif
            </h2>
            <p class="mt-2 text-gray-600">
                {{ session('success') ?? session('error') }}
            </p>
            <div class="mt-4 flex justify-end">
                <button @click="showModal = false" class="bg-primary-600 hover:bg-primary-700 text-white py-2 px-4 rounded">
                    Close
                </button>
            </div>
        </div>
    </div>
@endif

        {{-- Info Card --}}
        <div class="bg-white rounded-xl shadow-xl border border-primary-100 transform hover:scale-[1.02] transition-all duration-300">
            <div class="p-8 space-y-8">
                <div>
                    <h2 class="text-2xl font-bold text-primary-800 mb-6">Visit Our Coffee Shop</h2>
                    <div class="space-y-6">
                        {{-- Address Section --}}
                        <div class="flex items-start space-x-4">
                            <div class="text-primary-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">Our Location</h3>
                                <p class="mt-1 text-gray-600">
                                    West Ringroad road, Sawah Area, Banyuraden, District. Gamping, Sleman Regency, Yogyakarta Special Region<br>
                                     Siti Moendjijah Building                                </p>
                            </div>
                        </div>

                        {{-- Contact Info Section --}}
                        <div class="flex items-start space-x-4">
                            <div class="text-primary-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">Contact Details</h3>
                                <p class="mt-1 text-gray-600">
                                    Phone: (555) 123-4567<br>
                                    Email: info@geraimu.com
                                </p>
                            </div>
                        </div>

                        {{-- Hours Section --}}
                        <div class="flex items-start space-x-4">
                            <div class="text-primary-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">Hours of Operation</h3>
                                <p class="mt-1 text-gray-600">
                                    Monday - Friday: 10:00 AM - 5:00 PM<br>
                                    Saturday: 8:00 AM - 03:00 PM
                            
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Social Media Links --}}
                <div class="pt-6 border-t border-gray-200">
                    <h3 class="font-semibold text-gray-900 mb-4">Follow Us</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-primary-600 transition-colors">
                            <span class="sr-only">Facebook</span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                        <a href="https://www.instagram.com/geraimu.space/" 
                        target="_blank"
                        class="text-gray-400 hover:text-primary-600 transition-colors">
                            <span class="sr-only">Instagram</span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-primary-600 transition-colors">
                            <span class="sr-only">Twitter</span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.
                                65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.073 4.073 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.093 4.093 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.615 11.615 0 006.29 1.84"/>
                            </svg>
                        </a>
                    </div>
                </div>

                {{-- Map Placeholder --}}
                <div class="rounded-lg overflow-hidden shadow-inner bg-gray-100 h-48 relative">
                    <div class="rounded-lg overflow-hidden shadow-inner bg-gray-100 h-64 relative">
                        <div id="map" class="absolute inset-0">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d469.6625341104543!2d110.33077542347787!3d-7.767579827577868!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a587709f8feb9%3A0x9092c640c6f901ac!2sUniversitas%20&#39;Aisyiyah%20Yogyakarta!5e0!3m2!1sid!2sid!4v1736165813484!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Success Message Toast --}}
@if (session('success'))
<div class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg transform transition-all duration-500 ease-in-out animate-slide-in-right" 
     role="alert"
     x-data="{ show: true }"
     x-show="show"
     x-init="setTimeout(() => show = false, 5000)">
    <div class="flex items-center space-x-2">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
        <p>{{ session('success') }}</p>
    </div>
</div>
@endif

{{-- Add these styles to your CSS --}}
@push('styles')
<style>
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
        100% { transform: translateY(0px); }
    }
    
    .animate-float {
        animation: float 6s ease-in-out infinite;
    }
    
    .animate-fade-in-down {
        animation: fadeInDown 1s ease-out;
    }
    
    .animate-fade-in-up {
        animation: fadeInUp 1s ease-out;
    }
    
    .animate-slide-in-right {
        animation: slideInRight 0.5s ease-out;
    }
    
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(100px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    .text-shadow {
    text-shadow: -100px -100px 100px rgba(0, 0, 0, 0.8), 
     
}

</style>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Inisialisasi peta
        var map = L.map('map').setView([-7.768111563215865, 110.33369069486987], 13); // Koordinat Jakarta

        // Tambahkan tile dari OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        }).addTo(map);

        // Tambahkan marker
        L.marker([-7.768111563215865, 110.33369069486987]).addTo(map)
            .bindPopup('This is Jakarta!')
            .openPopup();
            
    });
</script>


@endpush
@endsection
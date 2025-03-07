@extends('layouts.main')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-gray-50 to-gray-100">
    <!-- Hero Section with User Info -->
    <div class="relative h-80 mb-24 bg-gradient-to-r from-primary-600 to-primary-800 overflow-hidden">
        <div class="absolute inset-0 bg-black/30"></div>
        <div class="absolute inset-0 opacity-30 bg-[url('/img/pattern.svg')] bg-center"></div>
        <div class="relative max-w-7xl mx-auto px-4 h-full flex items-center">
            <div class="text-white">
                <h1 class="text-4xl md:text-5xl font-bold tracking-tight">{{ $user->name }}</h1>
                <p class="mt-3 text-lg text-primary-100 flex items-center gap-2">
                    <svg class="w-5 h-5 opacity-75" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 2a8 8 0 100 16 8 8 0 000-16zm0 14a6 6 0 110-12 6 6 0 010 12zm1-6a1 1 0 11-2 0 1 1 0 012 0zm-1-4a1 1 0 00-1 1v3a1 1 0 002 0V7a1 1 0 00-1-1z"/>
                    </svg>
                    Member since {{ $user->created_at->format('F Y') }}
                </p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 pb-16">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Navigation Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 sticky top-24">
                    <nav class="p-4 space-y-1">
                        <a href="#profile" 
                            class="flex items-center px-4 py-3 text-primary-700 bg-primary-50 rounded-xl font-medium transition-all hover:bg-primary-100">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Profile Information
                        </a>
                        <a href="#security" 
                            class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-xl font-medium transition-all">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            Security
                        </a>
                        <a href="{{ route('orders.history') }}" 
                            class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-xl font-medium transition-all">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            Order History
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="lg:col-span-3 space-y-8">
                <!-- Profile Information -->
                <div id="profile" class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 transition-all hover:shadow-xl">
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-2xl font-bold text-gray-900">Profile Information</h2>
                        @if (session('status') === 'profile-updated')
                            <div x-data="{ show: true }" x-show="show" x-transition.duration.300ms x-init="setTimeout(() => show = false, 2000)"
                                class="bg-green-50 text-green-700 px-4 py-2 rounded-lg flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                                </svg>
                                Profile updated successfully
                            </div>
                        @endif
                    </div>

                    <form method="post" action="{{ route('profile.update') }}" class="space-y-8">
                        @csrf
                        @method('patch')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-2">
                                <label for="name" class="text-sm font-medium text-gray-700">Full Name</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" 
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-shadow"/>
                                <x-input-error :messages="$errors->get('name')" class="mt-1" />
                            </div>

                            <div class="space-y-2">
                                <label for="email" class="text-sm font-medium text-gray-700">Email Address</label>
                                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-shadow"/>
                                <x-input-error :messages="$errors->get('email')" class="mt-1" />
                            </div>

                            <div class="space-y-2">
                                <label for="phone" class="text-sm font-medium text-gray-700">Phone Number</label>
                                <input type="tel" name="phone" id="phone" value="{{ old('phone', $user->phone) }}"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-shadow"/>
                                <x-input-error :messages="$errors->get('phone')" class="mt-1" />
                            </div>

                            <div class="md:col-span-2 space-y-2">
                                <label for="address" class="text-sm font-medium text-gray-700">Shipping Address</label>
                                <textarea name="address" id="address" rows="3" 
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-shadow">{{ old('address', $user->address) }}</textarea>
                                <x-input-error :messages="$errors->get('address')" class="mt-1" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end">
                            <button type="submit" 
                                class="px-6 py-3 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition-all transform hover:scale-105">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Password Update -->
                <div id="security" class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 transition-all hover:shadow-xl">
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-2xl font-bold text-gray-900">Security Settings</h2>
                        @if (session('status') === 'password-updated')
                            <div x-data="{ show: true }" x-show="show" x-transition.duration.300ms x-init="setTimeout(() => show = false, 2000)"
                                class="bg-green-50 text-green-700 px-4 py-2 rounded-lg flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                                </svg>
                                Password updated successfully
                            </div>
                        @endif
                    </div>

                    <form method="post" action="{{ route('password.update') }}" class="space-y-8">
                        @csrf
                        @method('put')

                        <div class="space-y-6">
                            <div class="space-y-2">
                                <label for="current_password" class="text-sm font-medium text-gray-700">Current Password</label>
                                <input type="password" name="current_password" id="current_password"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-shadow"/>
                                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-1" />
                            </div>

                            <div class="space-y-2">
                                <label for="password" class="text-sm font-medium text-gray-700">New Password</label>
                                <input type="password" name="password" id="password"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-shadow"/>
                                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-1" />
                            </div>

                            <div class="space-y-2">
                                <label for="password_confirmation" class="text-sm font-medium text-gray-700">Confirm New Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-shadow"/>
                                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-1" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end">
                            <button type="submit" 
                                class="px-6 py-3 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition-all transform hover:scale-105">
                                Update Password
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Delete Account -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900">Delete Account</h2>
                            <p class="mt-2 text-gray-600">Once your account is deleted, all of its resources and data will be permanently deleted.</p>
                        </div>
                        <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                            class="px-6 py-3 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all transform hover:scale-105">
                            Delete Account
                        </button>
                    </div>

                    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                        <form method="post" action="{{ route('profile.destroy') }}" class="p-8">
                            @csrf
                            @method('delete')

                            <div class="mb-8">
                                <h2 class="text-2xl font-bold text-gray-900">Are you sure?</h2>
                                <p class="mt-2 text-gray-600">This action cannot be undone. Please enter your password to confirm.</p>
                            </div>

                            <div class="space-y-2">
                                <input type="password" name="password" placeholder="Enter your password"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-shadow"/>
                                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                            </div>

                            <div class="mt-8 flex justify-end gap-4">
                                <button type="button" x-on:click="$dispatch('close')"
                                    class="px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all">
                                    Cancel
                                </button>
                                <button type="submit"
                                    class="px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all">
                                    Delete Account
                                </button>
                            </div>
                        </form>
                    </x-modal>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
/* Smooth scrolling for anchor links */
html {
    scroll-behavior: smooth;
}

/* Enhanced animations */
.fade-in-up {
    animation: fadeInUp 0.5s cubic-bezier(0.4, 0, 0.2, 1);
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

/* Smooth transitions */
.transition-all {
    transition-property: all;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 150ms;
}

/* Focus styles */
.focus-within\:ring:focus-within {
    --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
    --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(2px + var(--tw-ring-offset-width)) var(--tw-ring-color);
    box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000);
}
</style>
@endpush
@endsection
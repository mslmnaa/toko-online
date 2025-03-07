@extends('layouts.main')

@section('content')
<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full m-4">
            <div class="p-8 rounded-lg shadow-2xl">
                <div class="text-center">
                    <h2 class="text-3xl font-bold text-primary-800 mb-2">Welcome Back!</h2>
                    <p class="text-primary-600 mb-8">Sign in to your Geraimu account</p>
                </div>

                @if (session('status'))
                    <div class="mb-4 p-4 bg-primary-100 border border-primary-400 text-primary-700 rounded">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Use single route for both admin and user -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <!-- Keep your existing form fields -->
                    ...

                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition duration-150 ease-in-out">
                        Sign In
                    </button>

                    <!-- Only show register link for non-admin login -->
                    @if (Route::has('register'))
                    <p class="text-center text-sm text-primary-600 mt-4">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="font-medium text-primary-600 hover:text-primary-500">
                            Register now
                        </a>
                    </p>
                    @endif
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
@endsection
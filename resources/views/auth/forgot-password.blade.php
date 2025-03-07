<x-auth-layout>
    <div class="text-center">
        <h2 class="text-3xl font-bold text-primary-800 mb-2">Forgot Password?</h2>
        <p class="text-primary-600 mb-8">No worries, we'll send you reset instructions.</p>
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div class="mb-6 p-4 bg-primary-50 border-l-4 border-primary-500 text-primary-700 rounded-r">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <div class="space-y-1">
            <label for="email" class="block text-sm font-medium text-primary-700">Email Address</label>
            <div class="relative rounded-lg shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                    </svg>
                </div>
                <input id="email" name="email" type="email" :value="old('email')" required autofocus
                    class="block w-full pl-10 pr-4 py-3 border-2 border-primary-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-150 ease-in-out"
                    placeholder="you@example.com">
            </div>
            @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" 
            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-lg text-sm font-semibold text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-4 focus:ring-primary-500/50 transform hover:-translate-y-0.5 transition duration-150 ease-in-out">
            Send Reset Link
        </button>

        <div class="relative my-6">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-primary-200"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-2 bg-white text-primary-500">
                    Remember your password? 
                    <a href="{{ route('login') }}" class="font-medium text-primary-600 hover:text-primary-800 transition-colors duration-200 inline-block">
                        Back to login
                    </a>
                </span>
            </div>
        </div>
    </form>
</x-auth-layout>
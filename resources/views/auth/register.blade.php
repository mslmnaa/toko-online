<x-auth-layout>
    <div class="text-center">
        <h2 class="text-2xl font-bold text-primary-800 mb-2">Join Geraimu</h2>
        <p class="text-primary-600 mb-8">Create your account and start your coffee journey</p>
    </div>

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Progress Bar -->
    <div class="mb-8">
        <div class="flex justify-between mb-2">
            @php
                $currentStep = session('registration_step', 1);
                $steps = ['Account', 'Contact', 'Security'];
            @endphp
            @foreach($steps as $index => $label)
                <div class="flex flex-col items-center">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center 
                        {{ $currentStep > ($index + 1) ? 'bg-primary-500' : 
                           ($currentStep === ($index + 1) ? 'bg-primary-600' : 'bg-gray-300') }} 
                        text-white mb-1 transition-all duration-300">
                        {{ $currentStep > ($index + 1) ? '✓' : ($index + 1) }}
                    </div>
                    <span class="text-sm text-primary-700">{{ $label }}</span>
                </div>
                @if($index < count($steps) - 1)
                    <div class="flex-1 hidden sm:block">
                        <div class="h-0.5 bg-gray-200 relative top-4">
                            <div class="h-0.5 bg-primary-500 transition-all duration-300"
                                style="width: {{ $currentStep > ($index + 1) ? '100%' : ($currentStep === ($index + 1) ? '50%' : '0%') }}">
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    <form method="POST" action="{{ route('register.step' . session('registration_step', 1)) }}" class="space-y-6" id="registrationForm">
        @csrf
        
        @if(session('registration_step', 1) === 1)
            <!-- Step 1: Account Information -->
            <div class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-primary-700 mb-1">Full Name</label>
                    <input id="name" name="name" type="text" required 
                        class="w-full px-4 py-3 border-2 border-primary-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-150 ease-in-out"
                        placeholder="Enter your full name"
                        value="{{ old('name', session('registration_data.name', '')) }}">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-primary-700 mb-1">Email Address</label>
                    <input id="email" name="email" type="email" required 
                        class="w-full px-4 py-3 border-2 border-primary-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-150 ease-in-out"
                        placeholder="you@example.com"
                        value="{{ old('email', session('registration_data.email', '')) }}">
                </div>
            </div>

        @elseif(session('registration_step', 1) === 2)
            <!-- Step 2: Contact Information -->
            <div class="space-y-4">
                <div>
                    <label for="phone" class="block text-sm font-medium text-primary-700 mb-1">Phone Number</label>
                    <input id="phone" name="phone" type="tel"
                        class="w-full px-4 py-3 border-2 border-primary-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-150 ease-in-out"
                        placeholder="+62 xxx-xxxx-xxxx"
                        value="{{ old('phone', session('registration_data.phone', '')) }}">
                </div>

                <div>
                    <label for="address" class="block text-sm font-medium text-primary-700 mb-1">Address</label>
                    <textarea id="address" name="address" rows="3"
                        class="w-full px-4 py-3 border-2 border-primary-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-150 ease-in-out"
                        placeholder="Enter your complete address">{{ old('address', session('registration_data.address', '')) }}</textarea>
                </div>
            </div>

        @else
            <!-- Step 3: Security -->
            <div class="space-y-4">
                <div>
                    <label for="password" class="block text-sm font-medium text-primary-700 mb-1">Password</label>
                    <input id="password" name="password" type="password" 
                        class="w-full px-4 py-3 border-2 border-primary-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-150 ease-in-out"
                        placeholder="Create a strong password">
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-primary-700 mb-1">Confirm Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" 
                        class="w-full px-4 py-3 border-2 border-primary-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-150 ease-in-out"
                        placeholder="Confirm your password">
                </div>
            </div>
        @endif

        <div class="flex justify-between space-x-4 pt-6">
            @if(session('registration_step', 1) > 1)
                <button type="submit" name="action" value="previous"
                    class="flex-1 py-3 px-4 border-2 border-primary-300 rounded-lg shadow-sm text-sm font-medium text-primary-700 bg-white hover:bg-primary-50 focus:outline-none focus:ring-4 focus:ring-primary-500/50 transition duration-150 ease-in-out">
                    Previous
                </button>
            @endif

            <button type="submit" name="action" value="{{ session('registration_step', 1) === 3 ? 'register' : 'next' }}"
                class="flex-1 py-3 px-4 border border-transparent rounded-lg shadow-lg text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-4 focus:ring-primary-500/50 transform hover:-translate-y-0.5 transition duration-150 ease-in-out">
                {{ session('registration_step', 1) === 3 ? 'Create Account' : 'Next' }}
            </button>
        </div>

        @if(session('registration_step', 1) === 1)
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-primary-200"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white text-primary-500">Already have an account?
                        <a href="{{ route('login') }}" class="font-medium text-primary-600 hover:text-primary-800 transition-colors duration-200 inline-block">
                            Sign in
                        </a>
                    </span>
                   
                </div>
            </div>

            {{-- <a href="{{ route('login') }}" 
                class="block w-full text-center py-3 px-4 border-2 border-primary-600 rounded-lg text-sm font-medium text-primary-700 hover:bg-primary-50 focus:outline-none focus:ring-4 focus:ring-primary-500/50 transition duration-150 ease-in-out">
                Sign In
            </a> --}}
        @endif
    </form>

    <!-- Add this script to fix the password validation issue -->
   <!-- Previous code remains the same until the script section -->

    <!-- Add this script to fix the password validation issue -->
    @if(session('registration_step', 1) === 3)
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('registrationForm');
            const previousButton = form.querySelector('button[value="previous"]');
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('password_confirmation');
            
            if (previousButton) {
                previousButton.addEventListener('click', function(e) {
                    // Remove required attribute from password fields when clicking previous
                    passwordInput.removeAttribute('required');
                    confirmPasswordInput.removeAttribute('required');
                    
                    // Set temporary values to pass HTML5 validation
                    passwordInput.value = 'temp';
                    confirmPasswordInput.value = 'temp';
                    
                    // Clear the temporary values after form submission
                    form.addEventListener('submit', function() {
                        if (previousButton.clicked) {
                            passwordInput.value = '';
                            confirmPasswordInput.value = '';
                        }
                    });
                });
            }

            // Add password strength indicator
            const strengthIndicator = document.createElement('div');
            strengthIndicator.className = 'mt-1 h-1 rounded-full bg-gray-200 overflow-hidden';
            passwordInput.parentElement.appendChild(strengthIndicator);

            const strengthBar = document.createElement('div');
            strengthBar.className = 'h-full transition-all duration-300';
            strengthIndicator.appendChild(strengthBar);

            const strengthText = document.createElement('p');
            strengthText.className = 'text-xs mt-1 text-gray-600';
            strengthIndicator.insertAdjacentElement('afterend', strengthText);

            passwordInput.addEventListener('input', function() {
                const value = this.value;
                let strength = 0;
                let message = '';

                // Calculate password strength
                if (value.length >= 8) strength += 25;
                if (value.match(/[a-z]/) && value.match(/[A-Z]/)) strength += 25;
                if (value.match(/\d/)) strength += 25;
                if (value.match(/[^a-zA-Z\d]/)) strength += 25;

                // Update strength bar
                strengthBar.style.width = strength + '%';
                
                // Update color based on strength
                if (strength < 50) {
                    strengthBar.className = 'h-full bg-red-500 transition-all duration-300';
                    message = 'Weak password';
                } else if (strength < 75) {
                    strengthBar.className = 'h-full bg-yellow-500 transition-all duration-300';
                    message = 'Moderate password';
                } else {
                    strengthBar.className = 'h-full bg-green-500 transition-all duration-300';
                    message = 'Strong password';
                }

                strengthText.textContent = message;
            });

            // Add password match indicator
            confirmPasswordInput.addEventListener('input', function() {
                const matchText = document.createElement('p');
                matchText.className = 'text-xs mt-1';
                
                // Remove existing match text if it exists
                const existingMatchText = this.parentElement.querySelector('p');
                if (existingMatchText) existingMatchText.remove();

                if (this.value && this.value === passwordInput.value) {
                    matchText.className += ' text-green-600';
                    matchText.textContent = 'Passwords match';
                } else if (this.value) {
                    matchText.className += ' text-red-600';
                    matchText.textContent = 'Passwords do not match';
                }

                this.parentElement.appendChild(matchText);
            });
        });
    </script>
    @endif
</x-auth-layout>
<x-guest-layout>
    <style>
        /* Custom styles can be added here if needed */
    </style>

    <div class="flex items-center justify-center min-h-screen bg-white">
        <div class="bg-white shadow-md rounded-lg p-8 w-full max-w-sm">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">POS System Login</h2>
            <p class="text-center text-gray-600 mb-4">Please enter your credentials to access the system.</p>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('employee.login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-4">
                    <label for="employee_number"
                        class="block text-gray-700 font-semibold mb-2">{{ __('Employee Number') }}</label>
                    <x-text-input id="employee_number"
                        class="block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        type="text" name="employee_number" :value="old('employee_number')" required autofocus
                        autocomplete="username" />
                    <x-input-error :messages="$errors->get('employee_number')" class="text-red-500 mt-1" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 font-semibold mb-2">{{ __('Password') }}</label>
                    <x-text-input id="password"
                        class="block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="text-red-500 mt-1" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center mb-4">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" name="remember">
                    <label for="remember_me" class="ml-2 text-gray-600">{{ __('Remember me') }}</label>
                </div>

                <div class="flex items-center justify-between">
                    @if (Route::has('password.request'))
                        <a class="text-sm text-indigo-600 hover:text-indigo-900" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <x-primary-button class="bg-indigo-600 text-white rounded-md px-4 py-2 hover:bg-indigo-700">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>

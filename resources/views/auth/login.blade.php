<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>




        <div class="flex items-center justify-between mt-4 ">
            @if (Route::has('password.request'))
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
            @endif

            <x-primary-button>
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        <div class="relative mt-2 mb-2 my-6">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="bg-white px-2 text-gray-500">Or sign in with</span>
            </div>
        </div>

        <!-- Google Sign-in Button -->
        <div class="mt-2">
            <a href="{{ route('auth.google') }}"
                class="flex items-center justify-center bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded transition duration-300">
                <svg class="w-5 h-5 mr-2" viewBox="0 0 48 48">
                    <path fill="#EA4335"
                        d="M24 9.5c3.4 0 6.3 1.2 8.4 3.2l6.2-6.2C34.5 2.6 29.6 0 24 0 14.6 0 6.8 6.2 3.4 14.9l7.3 5.7C12.8 14.2 17.9 9.5 24 9.5z" />
                    <path fill="#4285F4"
                        d="M46.1 24.5c0-1.6-.1-3.1-.4-4.5H24v9h12.5c-.5 2.6-1.9 4.7-3.9 6.2l6.1 4.8c3.6-3.3 5.7-8.2 5.7-15.5z" />
                    <path fill="#FBBC05"
                        d="M10.7 28.4c-1-2.9-1-6 0-8.8l-7.3-5.7C1.6 18.6 0 21.2 0 24s1.6 5.4 3.4 7.7l7.3-5.7z" />
                    <path fill="#34A853"
                        d="M24 48c6.5 0 12-2.1 16-5.6l-6.1-4.8c-2.1 1.4-4.9 2.3-9.9 2.3-6.1 0-11.2-4.7-12.9-10.9l-7.3 5.7C6.8 41.8 14.6 48 24 48z" />
                    <path fill="none" d="M0 0h48v48H0z" />
                </svg>
                Sign in with Google
            </a>
        </div>

        <!-- register -->
        <div class="text-center mt-4 flex items-center justify-center gap-2">
            @if(Route::has('register'))
            <x-input-label for="register-link" :value="__('Don\'t have an account yet?')"
                class="block text-sm font-medium text-gray-700 mr-2" />
            <a id="register-link"
                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('register') }}">
                {{ __('Register') }}
            </a>
            @endif
        </div>
    </form>
</x-guest-layout>
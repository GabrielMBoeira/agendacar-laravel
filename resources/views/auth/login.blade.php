<x-guest-layout>
    <x-auth-card>

        @section('title', 'Login')
        @section('sub-title', 'Faça seu login')

        <form method="POST" action="{{ route('login') }}" style="width: 400px">
            @csrf

            <div>
                <x-label for="email" :value="__('Email')" />
                <x-input id="email" class="block mt-1 w-full form-control" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />
                <x-input id="password" class="block mt-1 w-full form-control" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="d-flex justify-content-around align-items-center mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
                <x-button class="ml-3" style="background-color: #4154f1; border-radius: 5px;">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>

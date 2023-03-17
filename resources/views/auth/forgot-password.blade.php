<x-guest-layout>
    <x-auth-card>

        @section('sub-title', 'Escqueceu sua senha?')
        @section('title', 'Redefinir senha')

        <div>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div>
                    <x-label for="email" :value="__('Email')" />
                    <x-input id="email" class="block mt-1 w-full form-control" type="email" name="email"
                        :value="old('email')" required autofocus />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-button style="background-color: #4154f1; border-radius: 5px;">
                        {{ __('Email Password Reset Link') }}
                    </x-button>
                </div>
            </form>
        </div>

    </x-auth-card>
</x-guest-layout>

<x-guest-layout>
    <x-auth-card>

        @section('title', 'Cadastro')
        @section('sub-title', 'Cadastre seu estabelecimento')

        <form method="POST" action="{{ route('register') }}" style="width: 800px">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <x-label for="name" :value="__('Name')" />
                    <x-input id="name" class="form-control" type="text" name="name" :value="old('name')" autofocus />
                    <small class="text-danger"> @error('name') {{ $message }} @enderror </small>
                </div>

                <div class="col-md-6">
                    <x-label for="email" :value="__('Email')" />
                    <x-input id="email" class="form-control" type="email" name="email" :value="old('email')" />
                    <small class="text-danger"> @error('email') {{ $message }} @enderror </small>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <x-label for="business" :value="__('Nome do estabelecimento')" />
                    <x-input id="business" class="form-control" type="business" name="business" :value="old('business')" />
                    <small class="text-danger"> @error('business') {{ $message }} @enderror </small>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md 6">
                    <x-label for="password" :value="__('Password')" />
                    <x-input id="password" class="form-control" type="password" name="password" autocomplete="new-password" />
                    <small class="text-danger"> @error('password') {{ $message }} @enderror </small>
                </div>

                <div class="col-md-6">
                    <x-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" />
                    <small class="text-danger"> @error('password_confirmation') {{ $message }} @enderror </small>
                </div>
            </div>

            <div style="display: flex; align-items: center; justify-content: center; margin-top: 20px">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 mx-4" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
                <x-button class="ml-4" style="background-color: #4154f1; border-radius: 5px;">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>

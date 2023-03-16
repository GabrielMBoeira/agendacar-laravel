<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">


         <!-- Template Main CSS File -->
        <link href="assets/css/auth.css" rel="stylesheet">

        {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
        {{--<script src="{{ asset('js/app.js') }}" defer></script> --}}

        <!-- Scripts -->
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    </head>
    <body>
        <div class="teste">
            {{ $slot }}
        </div>
    </body>
</html>

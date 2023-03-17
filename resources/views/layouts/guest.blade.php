@extends('site.layouts.site-layout')

@section('main')
    <section id="contact" class="contact">

        <div class="container mt-5">

            <header class="section-header">
                <h2>@yield('sub-title')</h2>
                <p class="mt-3">@yield('title')</p>
            </header>

            <div class="row gy-5">
                <div class="col-lg-12">

                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    {{ $slot }}
                </div>
            </div>

        </div>

    </section>
@endsection('main')

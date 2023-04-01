@extends('admin.layouts.layout')

@section('page', 'Editar profissional')

@section('content')

    <section class="my-5">

        @if (session('service_null'))
            <div class="alert alert-danger" role="alert">
                {{ session('service_null') }}
            </div>
        @endif

        <div class="col-12">
            <form action="{{ route('admin.professionals.update', $professional->id) }}" method="post">
                @csrf
                @method('PUT')

                @include('admin.professionals_partials_form')

                <div class="mt-3">
                    <button class="btn" style="background: #4154f1; border-radius: 4px; color: #fff;">Salvar</button>
                </div>

            </form>
        </div>
    </section>
@endsection

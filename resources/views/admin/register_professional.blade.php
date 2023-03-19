@extends('admin.layouts.layout')

@section('page', 'Cadastro do profissional')

@section('content')

    <section class="my-5">
        <div class="col-12">
            <form action="{{ route('admin.store_professional') }}" method="post">
                @csrf
                @method('POST')

                <div class="row mt-2">
                    <div class="col-md-6">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" style="text-transform: uppercase;" name="name">
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-7">
                        <label for="service1">Tipo de serviço 1</label>
                        <input type="text" class="form-control" style="text-transform: uppercase;" name="service1" value="{{ old('service1') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="time_service1">Tempo de atendimento do serviço 1</label>
                        <input type="time" class="form-control" name="time_service1" value="{{ old('time_service1') }}">
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-7">
                        <label for="service2">Tipo de serviço 2</label>
                        <input type="text" class="form-control" style="text-transform: uppercase;" name="service2" value="{{ old('service2') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="time_service2">Tempo de atendimento do serviço 2</label>
                        <input type="time" class="form-control" name="time_service2" value="{{ old('time_service2') }}">
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-7">
                        <label for="service3">Tipo de serviço 3</label>
                        <input type="text" class="form-control" style="text-transform: uppercase;" name="service3" value="{{ old('service3') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="time_service3">Tempo de atendimento do serviço 3</label>
                        <input type="time" class="form-control" name="time_service3" value="{{ old('time_service3') }}">
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-7">
                        <label for="service4">Tipo de serviço 4</label>
                        <input type="text" class="form-control" style="text-transform: uppercase;" name="service4" value="{{ old('service4') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="time_service4">Tempo de atendimento do serviço 4</label>
                        <input type="time" class="form-control" name="time_service4" value="{{ old('time_service4') }}">
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-7">
                        <label for="service5">Tipo de serviço 5</label>
                        <input type="text" class="form-control" style="text-transform: uppercase;" name="service5" value="{{ old('service5') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="time_service5">Tempo de atendimento do serviço 5</label>
                        <input type="time" class="form-control" name="time_service5" value="{{ old('time_service5') }}">
                    </div>
                </div>

                <div class="mt-3">
                    <button class="btn" style="background: #4154f1; border-radius: 4px; color: #fff;">Salvar</button>
                </div>

            </form>
        </div>
    </section>
@endsection

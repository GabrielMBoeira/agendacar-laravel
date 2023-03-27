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

                <div class="row mt-2">
                    <div class="col-md-6">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" style="text-transform: uppercase;" name="name" value="{{ $professional->name }}">
                        <small class="text-danger"> @error('name') {{ $message }} @enderror</small>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-3">
                        <label for="date_start">Período de atendimento (Início)</label>
                        <input type="date" class="form-control" name="date_start" value="{{ $professional->date_start }}">
                        <small class="text-danger"> @error('date_start')
                                {{ $message }}
                            @enderror </small>
                    </div>
                    <div class="col-md-3">
                        <label for="date_end">Período de atendimento (Fim)</label>
                        <input type="date" class="form-control" name="date_end" value="{{ $professional->date_end }}">
                        <small class="text-danger"> @error('date_end')
                                {{ $message }}
                            @enderror </small>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-3">
                        <label for="interval">Intervalo entre horários</label>
                        <input type="time" class="form-control" name="interval" value="{{ $professional->interval }}">
                        <small class="text-danger"> @error('interval')
                                {{ $message }}
                            @enderror </small>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-7">
                        <label for="service1">Tipo de serviço 1</label>
                        <input type="text" class="form-control" style="text-transform: uppercase;" name="service1" value="{{ $professional->service1 }}">
                        <small class="text-danger"> @error('service1') {{ $message }} @enderror </small>
                    </div>
                    <div class="col-md-4">
                        <label for="time_service1">Tempo de atendimento do serviço 1</label>
                        <input type="time" class="form-control" name="time_service1" value="{{ $professional->time_service1 }}">
                        <small class="text-danger"> @error('time_service1')  {{ $message }} @enderror </small>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-7">
                        <label for="service2">Tipo de serviço 2</label>
                        <input type="text" class="form-control" style="text-transform: uppercase;" name="service2" value="{{ $professional->service2 }}">
                        <small class="text-danger"> @error('service2') {{ $message }} @enderror </small>
                    </div>
                    <div class="col-md-4">
                        <label for="time_service2">Tempo de atendimento do serviço 2</label>
                        <input type="time" class="form-control" name="time_service2" value="{{ $professional->time_service2 }}">
                        <small class="text-danger"> @error('time_service2') {{ $message }} @enderror </small>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-7">
                        <label for="service3">Tipo de serviço 3</label>
                        <input type="text" class="form-control" style="text-transform: uppercase;" name="service3" value="{{ $professional->service3 }}">
                        <small class="text-danger"> @error('service3') {{ $message }} @enderror </small>
                    </div>
                    <div class="col-md-4">
                        <label for="time_service3">Tempo de atendimento do serviço 3</label>
                        <input type="time" class="form-control" name="time_service3" value="{{ $professional->time_service3 }}">
                        <small class="text-danger"> @error('time_service3') {{ $message }} @enderror </small>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-7">
                        <label for="service4">Tipo de serviço 4</label>
                        <input type="text" class="form-control" style="text-transform: uppercase;" name="service4" value="{{ $professional->service4 }}">
                        <small class="text-danger"> @error('service4') {{ $message }} @enderror </small>
                    </div>
                    <div class="col-md-4">
                        <label for="time_service4">Tempo de atendimento do serviço 4</label>
                        <input type="time" class="form-control" name="time_service4" value="{{ $professional->time_service4 }}">
                        <small class="text-danger"> @error('time_service4') {{ $message }} @enderror </small>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-7">
                        <label for="service5">Tipo de serviço 5</label>
                        <input type="text" class="form-control" style="text-transform: uppercase;" name="service5" value="{{ $professional->service5 }}">
                        <small class="text-danger"> @error('service5') {{ $message }} @enderror </small>
                    </div>
                    <div class="col-md-4">
                        <label for="time_service5">Tempo de atendimento do serviço 5</label>
                        <input type="time" class="form-control" name="time_service5" value="{{ $professional->time_service5 }}">
                        <small class="text-danger"> @error('time_service5') {{ $message }} @enderror </small>
                    </div>
                </div>

                <div class="mt-3">
                    <button class="btn" style="background: #4154f1; border-radius: 4px; color: #fff;">Salvar</button>
                </div>

            </form>
        </div>
    </section>
@endsection

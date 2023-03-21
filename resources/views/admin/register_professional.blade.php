@extends('admin.layouts.layout')

@section('page', 'Cadastro do profissional')

@section('content')

    @if (session('msg'))
        <!-- Modal -->
        <div class="modal fade" id="modalMessage" tabindex="-1" role="dialog" aria-labelledby="modalMessageTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body" style="background-color: #4154f1; color:#fff">
                        {{ session('msg') }}
                    </div>
                    <div class="modal-footer d-flex justify-content-center align-iten">
                        <button type="button" class="btn btn-primary" onclick="closeModal()">OK</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <section class="my-5">
        <div class="col-12">
            <form action="{{ route('admin.store_professional') }}" method="post">
                @csrf
                @method('POST')

                <div class="row mt-2">
                    <div class="col-md-6">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" style="text-transform: uppercase;" name="name"
                            value="{{ old('name') }}">
                        <small class="text-danger"> @error('name')
                                {{ $message }}
                            @enderror </small>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-3">
                        <label for="date_start">Período de atendimento (Início)</label>
                        <input type="date" class="form-control" name="date_start" value="{{ old('date_start') }}">
                        <small class="text-danger"> @error('date_start')
                                {{ $message }}
                            @enderror </small>
                    </div>
                    <div class="col-md-3">
                        <label for="date_end">Período de atendimento (Fim)</label>
                        <input type="date" class="form-control" name="date_end" value="{{ old('date_end') }}">
                        <small class="text-danger"> @error('date_end')
                                {{ $message }}
                            @enderror </small>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-3">
                        <label for="interval">Intervalo entre horários</label>
                        <input type="time" class="form-control" name="interval" value="{{ old('intreval') }}">
                        <small class="text-danger"> @error('interval')
                                {{ $message }}
                            @enderror </small>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-7">
                        <label for="service1">Tipo de serviço 1</label>
                        <input type="text" class="form-control" style="text-transform: uppercase;" name="service1"
                            value="{{ old('service1') }}">
                        <small class="text-danger"> @error('service1')
                                {{ $message }}
                            @enderror </small>
                    </div>
                    <div class="col-md-4">
                        <label for="time_service1">Tempo de atendimento do serviço 1</label>
                        <input type="time" class="form-control" name="time_service1" value="{{ old('time_service1') }}">
                        <small class="text-danger"> @error('time_service1')
                                {{ $message }}
                            @enderror </small>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-7">
                        <label for="service2">Tipo de serviço 2</label>
                        <input type="text" class="form-control" style="text-transform: uppercase;" name="service2"
                            value="{{ old('service2') }}">
                        <small class="text-danger"> @error('service2')
                                {{ $message }}
                            @enderror </small>
                    </div>
                    <div class="col-md-4">
                        <label for="time_service2">Tempo de atendimento do serviço 2</label>
                        <input type="time" class="form-control" name="time_service2" value="{{ old('time_service2') }}">
                        <small class="text-danger"> @error('time_service2')
                                {{ $message }}
                            @enderror </small>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-7">
                        <label for="service3">Tipo de serviço 3</label>
                        <input type="text" class="form-control" style="text-transform: uppercase;" name="service3"
                            value="{{ old('service3') }}">
                        <small class="text-danger"> @error('service3')
                                {{ $message }}
                            @enderror </small>
                    </div>
                    <div class="col-md-4">
                        <label for="time_service3">Tempo de atendimento do serviço 3</label>
                        <input type="time" class="form-control" name="time_service3" value="{{ old('time_service3') }}">
                        <small class="text-danger"> @error('time_service3')
                                {{ $message }}
                            @enderror </small>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-7">
                        <label for="service4">Tipo de serviço 4</label>
                        <input type="text" class="form-control" style="text-transform: uppercase;" name="service4"
                            value="{{ old('service4') }}">
                        <small class="text-danger"> @error('service4')
                                {{ $message }}
                            @enderror </small>
                    </div>
                    <div class="col-md-4">
                        <label for="time_service4">Tempo de atendimento do serviço 4</label>
                        <input type="time" class="form-control" name="time_service4"
                            value="{{ old('time_service4') }}">
                        <small class="text-danger"> @error('time_service4')
                                {{ $message }}
                            @enderror </small>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-7">
                        <label for="service5">Tipo de serviço 5</label>
                        <input type="text" class="form-control" style="text-transform: uppercase;" name="service5"
                            value="{{ old('service5') }}">
                        <small class="text-danger"> @error('service5')
                                {{ $message }}
                            @enderror </small>
                    </div>
                    <div class="col-md-4">
                        <label for="time_service5">Tempo de atendimento do serviço 5</label>
                        <input type="time" class="form-control" name="time_service5"
                            value="{{ old('time_service5') }}">
                        <small class="text-danger"> @error('time_service5')
                                {{ $message }}
                            @enderror </small>
                    </div>
                </div>

                <div class="mt-3">
                    <button class="btn" style="background: #4154f1; border-radius: 4px; color: #fff;">Salvar</button>
                </div>

            </form>
        </div>
    </section>
@endsection


{{-- Script Modal --}}
<script>
    window.onload = function() {
        $('#modalMessage').appendTo("body").modal('show');
    }

    function closeModal() {
        $('#modalMessage').modal('hide');
    }
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>

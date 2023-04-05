@extends('admin.layouts.layout')

@section('page', 'Cadastrar Agendamento')

@section('content')

{{ $professional }}

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

    <section class="my-4">
        <div class="col-12">
            <form action="{{ route('admin.professionals.store') }}" method="post">
                @csrf
                @method('POST')
                <div class="row mt-2">
                    <div class="col-md-6">
                        <label for="name">Profissional</label>
                        <input type="text" class="form-control" name="professional"  value="{{ $professional->name }}" disabled>
                        <small class="text-danger">
                            @error('professional')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-3">
                        <label for="date">Data:</label>
                        <input type="date" class="form-control" name="date" value="{{ $scheduling->date }}" disabled>
                        <small class="text-danger">
                            @error('date')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>

                </div>

                <div class="row mt-2">
                    <div class="col-md-3">
                        <label for="hour">Hora:</label>
                        <input type="time" class="form-control" name="hour" value="{{ $scheduling->hour }}" disabled>
                        <small class="text-danger">
                            @error('hour')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-6">
                        <label for="client">Cliente</label>
                        <input type="text" class="form-control" style="text-transform: uppercase" name="client">
                        <small class="text-danger">
                            @error('client')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-6">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control" style="text-transform: uppercase"  name="email">
                        <small class="text-danger">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-6">
                        <label for="service">Serviço</label>

                        {{-- @foreach ($professional->service as $service)

                        {{ $service }}

                        @endforeach --}}

                        {{-- <select name="service" id="service" class="form-control">
                            <option value="">Aqui</option>
                        </select> --}}

                        <small class="text-danger">
                            @error('service')
                                {{ $message }}
                            @enderror
                        </small>
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

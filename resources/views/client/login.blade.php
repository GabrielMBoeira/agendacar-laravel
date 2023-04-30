@extends('client.layouts.layout')

@section('main')



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

    <section id="hero" class="hero">

        <h1 style="color: #fff">{{ ucwords(strtolower($user->business)) }}</h1>
        <br>
        <br>

        <div class="box-form">
            <form action="#" method="post">
                @csrf
                <div>
                    <div class="row">
                        <label for="name">Data:</label>
                        <input type="date" name="date" id="date" class="form-control" value="{{ old('date') }}">
                        <small class="text-light error-message-client">
                            @error('date')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>
                    <div class="row">
                        <label for="service">Serviço</label>
                        <select name="service" id="service" class="form-control">
                            @foreach ($professionals as $professional)
                                    <option value="{{ $service->id }}" {{ $service->id == $scheduling->service ? "selected" : '' }}>  {{ mb_strtoupper($service->service, 'UTF-8') }} </option>
                            @endforeach
                        </select>
                        <small class="text-danger">
                            @error('service')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>
                </div>
                <div class="d-flex justify-content-around align-items-center mt-3">
                    <button class="btn btn-success">Cadastrar</button>
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

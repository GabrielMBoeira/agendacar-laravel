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
        <form action="{{ route('client.store') }}" class="form-create-client" method="post">
            @csrf
            <div>
                <div class="row">
                    <label for="name" style="color: #fff">Nome:</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                    <small class="text-light error-message-client">
                        @error('name')
                            {{ $message }}
                        @enderror
                    </small>
                </div>
                <div class="row">
                    <label for="email" class="mt-2" style="color: #fff">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                    <small class="text-light error-message-client">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </small>
                </div>
                <div class="row">
                    <label for="password" class="mt-2" style="color: #fff">Senha:</label>
                    <input type="password" name="password" id="password" class="form-control" value="{{ old('password') }}">
                    <small class="text-light error-message-client">
                        @error('password')
                            {{ $message }}
                        @enderror
                    </small>
                </div>
                <div class="row">
                    <label for="confirm_password" class="mt-2" style="color: #fff">Confirme sua senha:</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" value="{{ old('confirm_password') }}">
                    <small class="text-light error-message-client">
                        @error('confirm_password')
                            {{ $message }}
                        @enderror
                    </small>
                </div>
            </div>
            <div class="d-flex justify-content-around align-items-center mt-3">
                <button class="btn btn-success">Cadastrar</button>
            </div>
        </form>
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

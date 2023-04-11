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
        {{-- <form action="{{ route('client.index') }}" style="width: 400px">
            <div class="form-group">
                <label for="email" style="color: #fff">Email</label>
                <input type="email" name="email" id="email" class="form-control">
                <br>
                <label for="password" style="color: #fff">Password</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <br>
            <div class="d-flex justify-content-around align-items-center">
                <a href="#" class="btn btn-sm btn-primary" style="color:#fff">
                    Esqueci a senha
                </a>
                <button class="btn btn-success">Entrar</button>
            </div>
        </form> --}}
        <br>
        <a href="login/google" class="btn-google">
            <div>
                <img src="../assets/img/logo-google.png" width="20px" height="20px" alt="Login com Google">
                &nbsp;
                <span style="text-decoration: none; color: #000">Efetuar login com Google</span>
            </div>
        </a>
        <br>
        <a href="login/facebook" class="btn-google">
            <div>
                <img src="../assets/img/logo-facebook.png" width="20px" height="20px" alt="Login com Google">
                &nbsp;
                <span style="text-decoration: none; color: #000">Efetuar login com Facebook</span>
            </div>
        </a>

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

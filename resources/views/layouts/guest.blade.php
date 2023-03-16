@extends('site.layouts.site-layout')

@section('main')
    <section id="contact" class="contact">

        @if (session('msg'))
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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

        <div class="container mt-5">

            <header class="section-header">
                <h2>Cadastre seu estabelecimento</h2>
                <p class="mt-3">Cadastro</p>
            </header>

            <div class="row gy-5">
                <div class="col-lg-12">
                    {{ $slot }}
                </div>
            </div>

        </div>

    </section>
@endsection('main')

{{-- Script Modal --}}
<script>

    window.onload = function() {
        $('#exampleModalCenter').appendTo("body").modal('show');
    }

    function closeModal() {
        $('#exampleModalCenter').modal('hide');
    }
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

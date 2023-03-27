@extends('admin.layouts.layout')

@section('page', 'Lista de profissionais cadastrados')

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

            <div class="row">

                <div class="card col-md-4" style="width: 18rem; border: solid 1px #000; margin: 10px">
                    {{-- <img src="..." class="card-img-top" alt="..."> --}}
                    <div class="card-body overflow-auto">
                        <h5 class="card-title">Nome do profissional</h5>
                        <p class="card-text">
                        <div class="agenda-card">
                            Agenda:
                            &nbsp;
                            <span class="agenda-card-date">01/01/2021</span>
                            &nbsp; a &nbsp;
                            <span class="agenda-card-date">01/01/2021</span>
                        </div>
                        </p>

                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Servico 1</li>
                        <li class="list-group-item">Servico 2</li>
                        <li class="list-group-item">Servico 3</li>
                        <li class="list-group-item">Servico 4</li>
                        <li class="list-group-item">Servico 5</li>
                    </ul>
                    <div class="card-body d-flex justify-content-around mt-2">
                        <a href="{{ route('admin.professionals.edit', $user->id) }}" class="card-link">
                            <button class="btn btn-sm btn-success">Editar</button>
                        </a>
                        <a href="#" class="card-link">
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </a>

                    </div>
                </div>

            </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"> </script>


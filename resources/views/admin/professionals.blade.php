@extends('admin.layouts.layout')

@section('page', 'Lista de profissionais cadastrados')

@section('content')

    {{-- {{ $user }} --}}
    {{-- {{ $professional }} --}}


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

                @foreach ($professionals as $professional)
                    <div class="card col-md-4" style="width: 18rem; border: solid 1px #000; margin: 10px">
                        {{-- <img src="..." class="card-img-top" alt="..."> --}}
                        <div class="card-body overflow-auto">
                            <h5 class="card-title">{{$professional->id . '-'. $professional->name }}</h5>
                            <p class="card-text">
                            <div class="agenda-card">
                                <div>
                                    Agenda:
                                </div>
                                <div>
                                    <span
                                        class="agenda-card-date">{{ date('d/m/Y', strtotime($professional->date_start)) }}</span>
                                    &nbsp; à &nbsp;
                                    <span
                                        class="agenda-card-date">{{ date('d/m/Y', strtotime($professional->date_end)) }}</span>
                                </div>
                            </div>
                            </p>

                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">{{ $professional->service1 }} - @if ($professional->time_service1) {{ date('H:i', strtotime($professional->time_service1)) }} @endif </li>
                            <li class="list-group-item">{{ $professional->service2 }} - @if ($professional->time_service2) {{ date('H:i', strtotime($professional->time_service2)) }} @endif </li>
                            <li class="list-group-item">{{ $professional->service3 }} - @if ($professional->time_service3) {{ date('H:i', strtotime($professional->time_service3)) }} @endif </li>
                            <li class="list-group-item">{{ $professional->service4 }} - @if ($professional->time_service4) {{ date('H:i', strtotime($professional->time_service4)) }} @endif </li>
                            <li class="list-group-item">{{ $professional->service5 }} - @if ($professional->time_service5) {{ date('H:i', strtotime($professional->time_service5)) }} @endif </li>
                        </ul>
                        <div class="card-body d-flex justify-content-around mt-2">
                            <a href="{{ route('admin.agenda.index', $professional->id) }}" class="card-link">
                                <button class="btn btn-sm btn-primary">Agenda</button>
                            </a>
                            <a href="{{ route('admin.professionals.edit', $professional->id) }}" class="card-link">
                                <button class="btn btn-sm btn-success">Editar</button>
                            </a>
                            <a href="#" class="card-link">
                                <form action="{{ route('admin.professionals.destroy', $professional->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Deletar</button>
                                </form>
                            </a>
                        </div>
                    </div>
                @endforeach

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>

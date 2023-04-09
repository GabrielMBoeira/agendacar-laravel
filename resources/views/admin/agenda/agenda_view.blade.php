@extends('admin.layouts.layout')

@section('page', 'Agenda do dia ')

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


    <section class="my-1">
        <div class="col-12">
            <div class="row">
                <div class="card-body">
                    <h5 class="card-title">Agenda {{ mb_convert_case($professional->name, MB_CASE_TITLE, 'UTF-8') }} <span>|
                            Today</span></h5>

                    <table class="table table-borderless datatable">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Data</th>
                                <th scope="col">Hora</th>
                                <th scope="col">Cliente</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">Serviço</th>
                                <th scope="col">Status</th>
                                <th scope="col">Agenda</th>
                                <th scope="col">Limpar</th>
                                <th scope="col">Excluir</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($agendas as $agenda)
                                <tr>
                                    <td scope="row"> {{ $agenda->id }} </td>
                                    <td scope="row"> {{ date('d/m/Y', strtotime($agenda->date)) }} </td>
                                    <td scope="row"> {{ date('H:i', strtotime($agenda->hour)) }} </td>
                                    <td scope="row"> {{ mb_strtoupper($agenda->client, 'UTF-8') ?? '-' }} </td>
                                    <td scope="row"> {{ mb_strtoupper($agenda->email, 'UTF-8') ?? '-' }} </td>
                                    <td scope="row"> {{ $agenda->service ?? '-' }} </td>
                                    <td scope="row">
                                        <span class="badge {{ $agenda->client == null || $agenda->client == '-'  ? 'bg-success' : 'bg-primary' }} ">
                                            {{ $agenda->client == null || $agenda->client == '-'  ? 'Livre' : 'Ocupado' }}
                                        </span>
                                    </td>
                                    <td scope="row"><a href="{{ route('admin.agenda.show', $agenda->id) }}"
                                            class="btn btn-sm btn-primary">
                                            <i class="bi bi-journal-check"></i>
                                        </a>
                                    </td>
                                    <td scope="row"><a href="{{ route('admin.agenda.clean', $agenda->id) }}"
                                            class="btn btn-sm btn-warning">
                                            <i class="bi bi-person-slash"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="#" class="card-link">
                                            <form action="{{ route('admin.agenda.destroy', $agenda->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>

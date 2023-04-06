@extends('admin.layouts.layout')

@section('page', 'Serviços')

@section('content')

    @if (session('msg'))
        <!-- Modal -->
        <div class="modal fade" id="modalMessage" tabindex="-1" role="dialog" aria-labelledby="modalMessageTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-cent  ered" role="document">
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
                    <h5 class="card-title">Serviços {{ mb_convert_case($professional->name, MB_CASE_TITLE, 'UTF-8') }}
                        <span> | Today</span>
                    </h5>

                    <div>
                        <a href="{{ route('admin.services.create', $professional) }}" class="btn btn-primary my-2">Cadastrar Serviço</a>
                    </div>

                    <table class="table table-borderless datatable">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Serviço</th>
                                <th scope="col">Tempo cadastrado</th>
                                <th scope="col">Editar</th>
                                <th scope="col">Deletar</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($services as $service)
                                <tr>
                                    <td scope="row">{{ $service->id }}</td>
                                    <td scope="row">{{ $service->service }}</td>
                                    <td scope="row">{{ $service->time_service }}</td>
                                    <td scope="row">
                                        <a href="{{ route('admin.services.edit', $service->id) }}"
                                            class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="#" class="card-link">
                                            <form action="{{ route('admin.services.destroy', $service->id) }}"
                                                method="post">
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

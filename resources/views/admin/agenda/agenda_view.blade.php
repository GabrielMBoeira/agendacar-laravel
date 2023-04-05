@extends('admin.layouts.layout')

@section('page', 'Agenda do dia ')

@section('content')

    <section class="my-1">
        <div class="col-12">
            <div class="row">
                <div class="card-body">
                    <h5 class="card-title">Agenda {{ mb_convert_case($professional->name, MB_CASE_TITLE, "UTF-8") }} <span>| Today</span></h5>

                    <table class="table table-borderless datatable">
                        <thead>
                            <tr>
                                <th scope="col">Data</th>
                                <th scope="col">Hora</th>
                                <th scope="col">Cliente</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">Serviço</th>
                                <th scope="col">Status</th>
                                <th scope="col">Incluir</th>
                                <th scope="col">Editar</th>
                                <th scope="col">Excluir</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($agendas as $agenda)
                                <tr>
                                    <td scope="row"> {{ date('d/m/Y', strtotime($agenda->date)) }} </td>
                                    <td scope="row"> {{ date('H:i', strtotime($agenda->hour)) }} </td>
                                    <td scope="row"> Cliente </td>
                                    <td scope="row"> Email </td>
                                    <td scope="row"> Service </td>
                                    <td scope="row"><span class="badge bg-success">{{ $agenda->status }}</span></td>
                                    <td scope="row"><button class="btn btn-sm btn-primary"><i class="bi bi-person-plus"></i></button></td>
                                    <td scope="row"><button class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i></button></td>
                                    <td scope="row"><button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button></td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </section>

@endsection


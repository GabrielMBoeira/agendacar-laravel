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
                                <th scope="col">ID</th>
                                <th scope="col">Data</th>
                                <th scope="col">Hora</th>
                                <th scope="col">Cliente</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">Serviço</th>
                                <th scope="col">Status</th>
                                <th scope="col">Agenda</th>
                                <th scope="col">Excluir</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($agendas as $agenda)
                                <tr>
                                    <td scope="row"> {{ $agenda->id }} </td>
                                    <td scope="row"> {{ date('d/m/Y', strtotime($agenda->date)) }} </td>
                                    <td scope="row"> {{ date('H:i', strtotime($agenda->hour)) }} </td>
                                    <td scope="row"> {{  $agenda->client ?? '-'}} </td>
                                    <td scope="row"> {{ $agenda->email ?? '-'}} </td>
                                    <td scope="row"> {{ $agenda->service ?? '-'}} </td>
                                    <td scope="row"><span class="badge {{$agenda->client ? 'bg-primary' : 'bg-success'}} ">{{ $agenda->client ? 'Ocupado' : 'Livre' }}</span></td>
                                    <td scope="row"><a href="{{ route('admin.agenda.show', $agenda->id) }}" class="btn btn-sm btn-primary"><i class="bi bi-journal-check"></i></a></td>
                                    <td>
                                        <a href="#" class="card-link">
                                            <form action="{{ route('admin.agenda.destroy', $agenda->id) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </a>
                                    </td>
{{--
                                    <td scope="row">
                                        <a href="#" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td> --}}


                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </section>

@endsection


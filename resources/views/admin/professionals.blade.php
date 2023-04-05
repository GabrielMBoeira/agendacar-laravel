@extends('admin.layouts.layout')

@section('page', 'Lista de profissionais cadastrados')

@section('content')

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

                            @foreach($professional->services as $service_and_time)
                                <li class="list-group-item">{{ $service_and_time->service }} - {{ date('H:i', strtotime($service_and_time->time_service)) }} </li>
                            @endforeach

                        </ul>
                        <div class="card-body d-flex justify-content-around mt-2">
                            <a href="{{ route('admin.agenda.index', $professional->id) }}" class="card-link">
                                <button class="btn btn-sm btn-primary">Agenda</button>
                            </a>
                            <a href="{{ route('admin.services.index', $professional->id) }}" class="card-link">
                                <button class="btn btn-sm btn-success">Serviços</button>
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

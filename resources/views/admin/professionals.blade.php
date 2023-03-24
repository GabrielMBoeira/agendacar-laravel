@extends('admin.layouts.layout')

@section('page', 'Lista de profissionais cadastrados')

@section('content')

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

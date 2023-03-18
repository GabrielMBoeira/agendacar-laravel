@extends('admin.layouts.layout')

@section('page', 'Cadastro do profissional')

@section('content')

    <section class="my-5">
        <div class="col-12">
            <form action="#" method="post">

                <div class="row mt-2">
                    <div class="col-md-8">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" style="text-transform: uppercase;">
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-7">
                        <label for="name">Tipo de serviço</label>
                        <input type="text" class="form-control" style="text-transform: uppercase;">
                    </div>
                    <div class="col-md-4">
                        <label for="name">Tempo de atendimento do serviço</label>
                        <input type="time" class="form-control">
                    </div>
                </div>

                <div class="mt-3">
                    <button class="btn" style="background: #4154f1; border-radius: 4px; color: #fff;">Salvar</button>
                </div>

            </form>
        </div>
    </section>
@endsection

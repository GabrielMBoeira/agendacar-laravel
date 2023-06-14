@extends('client.layouts.layout')

@section('main')

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

    <section id="hero" class="hero">

        <h1 style="color: #fff">{{ ucwords(strtolower($user->business)) }}</h1>

        <div class="box-form">
            <form name="formulario" class="formulario">
                @csrf

                <div>
                    <label for="service">Selecione um serviço</label>
                    <select name="service" id="service" class="form-control" onchange="getDates()">
                        <option value="">Escolha um serviço</option>

                        @if ($services->count() > 0)
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}">{{ $service->id . "-" . $service->service }}</option>
                            @endforeach
                        @else
                            <option value="">Não há serviço cadastrado.</option>
                        @endif

                    </select>
                </div>

                <div class="my-2">
                    <label for="date">Selecione uma data</label>
                    <select name="date" id="date" class="form-control">
                        <option value="" selected>Escolha uma data</option>
                    </select>
                </div>

                <div class="d-flex justify-content-center align-items-center">
                    <button class="btn btn-sm btn-success my-2">Próximo</button>
                </div>

            </form>
        </div>

    </section>

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>

<script>

    function getDates() {

        let service_id = $('#service').val();

        $.ajax({
            url: "{{ route('client.ajax.date') }}",
            type: 'post',
            data: { service_id: service_id },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function (response) {

                $("#date").empty();
                $('#date').append("<option>Escolha uma data</option>");

                response.forEach(element => {
                    $('#date').append("<option>"+element.date+"</option>");
                });
                $('#date').prop('disabled', false);
            }
        });
    }


    //Script Modal
    window.onload = function() {
        $('#modalMessage').appendTo("body").modal('show');
        $('#date').prop('disabled', true);
    }

    function closeModal() {
        $('#modalMessage').modal('hide');
    }

</script>

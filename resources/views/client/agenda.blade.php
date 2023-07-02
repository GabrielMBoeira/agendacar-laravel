@extends('client.layouts.layout')

@section('main')

    <!-- Modal msg -->
    @if (session('msg'))
        <div class="modal fade" id="modalMessage" tabindex="-1" role="dialog" aria-labelledby="modalMessageTitle" aria-hidden="true">
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

    <!-- Modal horários agenda -->
    <div class="modal fade" id="modalAgenda" tabindex="-1" role="dialog" aria-labelledby="modalAgendaTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body" style="background-color: #4154f1; color:#fff">
                    Horários de agendamento
                </div>
                <div class="modal-footer d-flex justify-content-center align-iten">
                    <form action="{{ route('client.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="hashForm" id="hashForm">
                        <input type="hidden" name="serviceForm" id="serviceForm">
                        <input type="hidden" name="professionalForm" id="professionalForm">
                        <input type="hidden" name="dateForm" id="dateForm">
                        <input type="hidden" name="nameForm" id="nameForm">
                        <input type="hidden" name="emailForm" id="emailForm">
                        <input type="hidden" name="phoneForm" id="phoneForm">
                        <div class="row">
                            <div id="div-agenda-hour" class="div-agenda-hour"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <section id="hero" class="hero">

        <h1 style="color: #fff">Agenda {{ ucwords(strtolower($user->business)) }}</h1>

        <div class="box-form">
            <form name="form" id="form" class="formulario">
                @csrf

                <input type="hidden" name="hash" id="hash" value="{{ $user->hash }}">

                <div>
                    <label for="service">Selecione um serviço</label>
                    <select name="service" id="service" class="form-control" onchange="getDates()">
                        <option value="">Escolha um serviço</option>

                        @if ($services->count() > 0)
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}">{{ $service->id . '-' . $service->service }}</option>
                            @endforeach
                        @else
                            <option value="">Não há serviço cadastrado.</option>
                        @endif

                    </select>
                </div>

                <div class="my-2">
                    <label for="professional">Profissional</label>
                    <input type="text" name="professional" id="professional" class="form-control">
                </div>

                <div class="my-2">
                    <label for="date">Selecione uma data</label>
                    <select name="date" id="date" class="form-control">
                        <option value="" selected>Escolha uma data</option>
                    </select>
                </div>

                <div class="my-2">
                    <label for="name">Digite seu nome</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Digite seu nome...">
                </div>

                <div class="my-2">
                    <label for="email">Digite seu email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Digite seu email...">
                </div>

                <div class="my-2">
                    <label for="phone">Digite seu telefone</label>
                    <input type="text" name="phone" id="phone" class="form-control" placeholder="Digite seu telefone...">
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
    window.onload = function() {
        $('#modalMessage').appendTo("body").modal('show');
        $('#modalAgenda').appendTo("body").modal('hide');
        $('#date').prop('disabled', true);
        $('#professional').val("Profissional");
        $('#professional').prop('disabled', true);
    }

    function getDates() {

        let service_id = $('#service').val();

        $.ajax({
            url: "{{ route('client.ajax.date') }}",
            type: 'post',
            data: {
                service_id: service_id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function(response) {

                $("#date").empty();
                $('#date').append("<option value=''>Escolha uma data</option>");

                response.forEach(element => {
                    $('#date').append("<option>" + element.date + "</option>");
                    $('#professional').val(element.name);
                });

                $('#date').prop('disabled', false);
            }
        });
    }


    //Monta botões de horários em modal
    $(document).ready(function() {
        $('#form').submit(function(e) {
            e.preventDefault();

            let hash = $('#hash').val();
            let service = $('#service').val();
            let date = $('#date').val();
            let name = $('#name').val();
            let email = $('#email').val();
            let phone = $('#phone').val();

            if (!service || !date || !name || !email || !phone) {
                alert('Preencher campos pendentes')
                return false
            }

            $.ajax({
                url: "{{ route('client.ajax.agenda') }}",
                type: 'post',
                data: {
                    hash: hash,
                    service: service,
                    date: date
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                success: function(response) {

                    $("#div-agenda-hour").empty();

                    for (let i = 0; i < response.length; i++) {

                        const hour = response[i].hour
                        const minute = response[i].minute
                        const hourFormatted = hour + ':' + minute

                        $('#div-agenda-hour').append(
                        "<input type='submit' name='btn_agenda_hour' class='btn m-1 btn-agenda-hour' id='btn_agenda_hour' value='" + hourFormatted + "' onclick='transferForm(event)'></>"
                        );
                    }

                    $('#modalAgenda').modal('show');

                }
            });

        });
    });


    function transferForm(event) {

         $('#serviceForm').val($('#service').val())
         $('#professionalForm').val($('#professional').val())
         $('#dateForm').val($('#date').val())
         $('#nameForm').val($('#name').val())
         $('#emailForm').val($('#email').val())
         $('#phoneForm').val($('#phone').val())
         $('#hashForm').val($('#hash').val())
         const btnHour = event.target.value;
    }

    function closeModal() {
        $('#modalMessage').modal('hide');
    }

</script>

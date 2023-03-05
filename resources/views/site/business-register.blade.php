@extends('site.layouts.site-layout')

@section('main')
    <section id="contact" class="contact">

        @if (session('msg'))
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content message-box">
                    <div class="modal-body message-body">
                        {{ session('msg') }}
                    </div>
                    <div class="modal-footer d-flex justify-content-center align-iten">
                    <button type="button" class="btn btn-primary" onclick="//closeModal()">OK</button>
                    </div>
                </div>
                </div>
            </div>
        @endif

        <div class="container mt-5" data-aos="fade-up">

            <header class="section-header">
                <h2>Cadastre seu estabelecimento</h2>
                <p class="mt-3">Cadastro</p>
            </header>

            <div class="row gy-5">
                <div class="col-lg-12">
                    <form action="{{ route('business.store') }}" method="post" class="php-email-form">
                        @csrf
                        @method('POST')
                        <div class="row gy-4">

                            <div class="col-md-4">
                                <label for="name" style="font-size: 0.9rem">Nome:</label>
                                <input type="text" class="form-control" name="name" value=" {{ old('name') }} ">
                                <small class="text-danger"> @error('name') {{ $message }} @enderror </small>
                            </div>

                            <div class="col-md-4">
                                <label for="email" style="font-size: 0.9rem">E-mail:</label>
                                <input type="email" class="form-control" name="email" value=" {{ old('email') }} ">
                                <small class="text-danger"> @error('email') {{ $message }} @enderror </small>
                            </div>

                            <div class="col-md-4">
                                <label for="phone" style="font-size: 0.9rem">Telefone:</label>
                                <input type="text" class="form-control" name="phone" value=" {{ old('phone') }} ">
                                <small class="text-danger"> @error('phone') {{ $message }} @enderror </small>
                            </div>

                            <div class="col-md-12">
                                <label for="business" style="font-size: 0.9rem">Digite o nome de seu estabelecimento:</label>
                                <input type="text" class="form-control" name="business" value=" {{ old('business') }} ">
                                <small class="text-danger"> @error('business') {{ $message }} @enderror </small>
                            </div>

                            <div class="col-md-6">
                                <label for="password" style="font-size: 0.9rem">Digite sua senha:</label>
                                <input type="password" class="form-control" name="password">
                                <small class="text-danger"> @error('password') {{ $message }} @enderror </small>
                            </div>

                            <div class="col-md-6">
                                <label for="confirm-password" style="font-size: 0.9rem">Confirme sua senha:</label>
                                <input type="password" class="form-control" name="confirm-password">
                                <small class="text-danger"> @error('confirm-password') {{ $message }} @enderror </small>
                            </div>

                            <div class="col-md-12 text-center mt-5">
                                {{-- <div class="loading">Loading</div>
                                <div class="error-message"></div> --}}
                                <div class="sent-message">Sua mensagem foi enviada. Obrigado!</div>

                                <button type="submit">Cadastrar</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>

        </div>

    </section>
@endsection('main')

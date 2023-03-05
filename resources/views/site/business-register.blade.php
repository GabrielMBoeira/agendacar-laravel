@extends('site.layouts.site-layout')

@section('main')
    <section id="contact" class="contact">

        <div class="container mt-5" data-aos="fade-up">

            <header class="section-header">
                <h2>Cadastre seu estabelecimento</h2>
                <p class="mt-3">Cadastro</p>
            </header>

            <div class="row gy-5">
                <div class="col-lg-12">
                    <form action="forms/contact.php" method="post" class="php-email-form">
                        <div class="row gy-4">

                            <div class="col-md-4">
                                <input type="text" name="name" class="form-control" placeholder="Digite seu nome" required>
                            </div>

                            <div class="col-md-4">
                                <input type="email" class="form-control" name="email" placeholder="Digite seu E-mail" required>
                            </div>

                            <div class="col-md-4">
                                <input type="text" name="phone" class="form-control" placeholder="Digite seu telefone" required>
                            </div>

                            <div class="col-md-12">
                                <input type="text" class="form-control" name="establishment" placeholder="Digite o nome de seu estabelecimento" required>
                            </div>

                            <div class="col-md-6 ">
                                <input type="email" class="form-control" name="password" placeholder="Senha" required>
                            </div>

                            <div class="col-md-6 ">
                                <input type="email" class="form-control" name="confimr-password" placeholder="Confirme sua senha" required>
                            </div>

                            <div class="col-md-12 text-center">
                                <div class="loading">Loading</div>
                                <div class="error-message"></div>
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

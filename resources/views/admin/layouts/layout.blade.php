<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard Agendacar</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../assets/img/logo.png" rel="icon">
    <link href="../../admin/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../../admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../admin/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../../admin/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../../admin/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../../admin/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../../admin/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../../admin/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../../admin/css/style.css" rel="stylesheet">

</head>

<body>

    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="#" class="logo d-flex align-items-center toggle-sidebar-btn">
                <img src="../assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">AgendaCar</span>
            </a>
        </div>
    </header>

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('dashboard') }}">
                    <i class="bi bi-window"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('admin.professionals.index') }}">
                    <i class="bi bi-person-badge-fill"></i>
                    <span>Profissionais cadastrados</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('admin.professionals.create') }}">
                    <i class="bi bi-person-add"></i>
                    <span>Cadastrar profissional</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('admin.services.create') }}">
                    <i class="bi bi-hammer"></i>
                    <span>Cadastrar serviços</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-journal-check"></i>
                    <span>Cadastrar agenda</span>
                </a>
                <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('admin.agenda.create') }}">
                            <i class="bi bi-circle"></i>
                            <span>Cadastrar agenda em lote</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('admin.agenda.create.single') }}">
                            <i class="bi bi-circle"></i>
                            <span>Cadastrar agenda específica</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('client.link') }}">
                    <i class="bi bi-link"></i>
                    <span>Link para clientes</span>
                </a>
            </li>

            @auth

                <li class="nav-item">
                    <form action="{{ url('logout') }}" method="post">
                        @csrf
                        <a class="nav-link collapsed" href="logout" onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="bi bi-box-arrow-right"></i>
                            Sair
                        </a>
                    </form>
                </li>

            @endauth

    </aside>

    <main id="main" class="main">

        <div class="pagetitle">
            <div class="d-flex justify-content-between">
                <h1>@yield('page')</h1>

                @if (request()->path() != 'dashboard')
                    <a href="{{ url()->previous() }}" class="btn btn-primary mx-5">Voltar</a>
                @endif

            </div>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                    <li class="breadcrumb-item active">@yield('page')</li>
                </ol>
            </nav>
        </div>

        @yield('content')

    </main>

    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>Agendacar</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            Designed by <a href="#">Agendacar</a>
        </div>
    </footer>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="../../admin/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../../admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../admin/vendor/chart.js/chart.umd.js"></script>
    <script src="../../admin/vendor/echarts/echarts.min.js"></script>
    <script src="../../admin/vendor/quill/quill.min.js"></script>
    <script src="../../admin/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../../admin/vendor/tinymce/tinymce.min.js"></script>
    <script src="../../admin/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../../admin/js/main.js"></script>

</body>

</html>

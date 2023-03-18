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
    <link href="../admin/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../admin/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../admin/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../admin/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../admin/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../admin/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../admin/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../admin/css/style.css" rel="stylesheet">

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
                <a class="nav-link " href="dashboard">
                    <i class="bi bi-window"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link " href="register_professional">
                    <i class="bi bi-person-add"></i>
                    <span>Cadastrar profissional</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-gear"></i>
                    <span>Configurações</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="components-alerts.html">
                            <i class="bi bi-person-add"></i><span>Cadastrar profisional</span>
                        </a>
                    </li>
                    <li>
                        <a href="components-accordion.html">
                            <i class="bi bi-circle"></i><span>Accordion</span>
                        </a>
                    </li>
                    <li>
                        <a href="components-badges.html">
                            <i class="bi bi-circle"></i><span>Badges</span>
                        </a>
                    </li>
                    <li>
                        <a href="components-breadcrumbs.html">
                            <i class="bi bi-circle"></i><span>Breadcrumbs</span>
                        </a>
                    </li>
                    <li>
                        <a href="components-buttons.html">
                            <i class="bi bi-circle"></i><span>Buttons</span>
                        </a>
                    </li>
                    <li>
                        <a href="components-cards.html">
                            <i class="bi bi-circle"></i><span>Cards</span>
                        </a>
                    </li>
                    <li>
                        <a href="components-carousel.html">
                            <i class="bi bi-circle"></i><span>Carousel</span>
                        </a>
                    </li>
                    <li>
                        <a href="components-list-group.html">
                            <i class="bi bi-circle"></i><span>List group</span>
                        </a>
                    </li>
                    <li>
                        <a href="components-modal.html">
                            <i class="bi bi-circle"></i><span>Modal</span>
                        </a>
                    </li>
                    <li>
                        <a href="components-tabs.html">
                            <i class="bi bi-circle"></i><span>Tabs</span>
                        </a>
                    </li>
                    <li>
                        <a href="components-pagination.html">
                            <i class="bi bi-circle"></i><span>Pagination</span>
                        </a>
                    </li>
                    <li>
                        <a href="components-progress.html">
                            <i class="bi bi-circle"></i><span>Progress</span>
                        </a>
                    </li>
                    <li>
                        <a href="components-spinners.html">
                            <i class="bi bi-circle"></i><span>Spinners</span>
                        </a>
                    </li>
                    <li>
                        <a href="components-tooltips.html">
                            <i class="bi bi-circle"></i><span>Tooltips</span>
                        </a>
                    </li>
                </ul>
            </li>

            @auth
                <li class="nav-item">

                    <form action="{{ url('logout') }}" method="post">
                        @csrf
                        <a class="nav-link" href="logout"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="bi bi-box-arrow-right"></i>
                            Sair
                        </a>
                    </form>
                </li>
            @endauth

    </aside>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>@yield('page')</h1>
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
    <script src="../admin/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../admin/vendor/chart.js/chart.umd.js"></script>
    <script src="../admin/vendor/echarts/echarts.min.js"></script>
    <script src="../admin/vendor/quill/quill.min.js"></script>
    <script src="../admin/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../admin/vendor/tinymce/tinymce.min.js"></script>
    <script src="../admin/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../admin/js/main.js"></script>

</body>

</html>

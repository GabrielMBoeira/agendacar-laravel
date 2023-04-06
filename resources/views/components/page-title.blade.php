<div class="pagetitle">
    <div>
        <div class="pagetitle-title">
            <h1>@yield('page')</h1>

            @if (request()->path() != 'dashboard')
                <a class="btn mx-5" style="background: #4154f1; border-radius: 4px; color: #fff;" href="{{ @yield('btn-title')}}" >voltar</a>
            @endif

        </div>
    </div>

    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
            <li class="breadcrumb-item active">@yield('page')</li>
        </ol>
    </nav>
</div>

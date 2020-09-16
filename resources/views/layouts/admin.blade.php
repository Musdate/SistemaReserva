<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="https://lh3.googleusercontent.com/proxy/exhBV91c0xEbvD_2cd8Z3ggpjZB3j_dHJueuKdN8cwDwGEDSivXhTUcnffDZ58eH8PSiCbcbmo57uMW7lTV9K2dQ7Mu_ndamt1FsloO3iigZTeKtWKG1cQLewkkuxHOfmxXdcg_tov8OHl4oImE6GTrF">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>

<header>
    <div class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        
        <a class="navbar-brand" href="/">Página Principal</a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/AgregarLaboratorio') }}">Agregar Laboratorio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/AgregarEncargado') }}">Agregar Encargado</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/AgregarUsuario') }}">Agregar Usuario</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/AgregarAdmin') }}">Agregar Admin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/Laboratorios') }}">Lista Laboratorios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/Encargados') }}">Lista Encargados</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/Usuarios') }}">Lista Usuarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/Admins') }}">Lista Admins</a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto"> 
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Iniciar Sesion</a>
                    </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Registrarse</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->nombre }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                Desconectarse
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>

    </div>
</header>

<main class="py-4"></br></br></br>
    <div class="container">
        @yield('content')
    </div>
</main>

</body>

</html>
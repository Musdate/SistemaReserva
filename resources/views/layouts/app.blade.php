<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Exo&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
    body{
      font-family: 'Exo', sans-serif;
    }
    .header-col{
      background: #E3E9E5;
      color:#536170;
      text-align: center;
      font-size: 20px;
      font-weight: bold;
    }
    .header-calendar{
      background: #EE192D;color:white;
    }
    .box-day{
      border:1px solid #E3E9E5;
      height:150px;
    }
    .box-dayoff{
      border:1px solid #E3E9E5;
      height:150px;
      background-color: #ccd1ce;
    }
    </style>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>

<header>
    <div class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        
        <a class="navbar-brand" href="/">Página Principal</a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent"> 

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Iniciar Sesion</a>
                    </li>
                @else
            </ul>

            <!-- Left Side Of Navbar -->

            <!-- Si es Admin -->
            @if ( Auth::user()->tipoUsuarioID == '0' )
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
            @endif

            <!-- Si es Encargado -->
            @if ( Auth::user()->tipoUsuarioID == '1' )
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/AgregarUsuario') }}">Agregar Usuario</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/Laboratorios') }}">Lista Laboratorios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/Usuarios') }}">Lista Usuarios</a>
                    </li>
                </ul>
            @endif

            <ul class="navbar-nav ml-auto">
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
             </ul>   
            @endguest
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
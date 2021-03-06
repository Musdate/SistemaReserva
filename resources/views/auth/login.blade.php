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

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Exo&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Styles -->
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
</head>

<body>
<header>
        <div class="navbar navbar-expand-md navbar-dark fixed-top bg-dark navbar-inverse">
            <div class="navbar-header">
                <a class="navbar-brand" href="/">
                    <svg width="3em" height="3em" viewBox="0 0 16 16" class="bi bi-house" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                        <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
                    </svg>
                </a>
              </div>

            <div class="collapse navbar-collapse" id="navbarSupportedContent"> 

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        
                    @else
                </ul>

                <!-- Left Side Of Navbar -->

                <!-- Si es Admin -->
                @if ( Auth::user()->tipoUsuarioID == '0' )
                    <ul class="nav navbar-nav">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Laboratorios
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{ url('/AgregarLaboratorio') }}">Agregar Laboratorio</a>
                                    <a class="dropdown-item" href="{{ url('/Laboratorios') }}">Listado de Laboratorios</a>
                                </div>
                            </div>

                        <li class="nav-item">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Encargados
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{ url('/AgregarEncargado') }}">Agregar Encargado</a>
                                    <a class="dropdown-item" href="{{ url('/Encargados') }}">Listado de Encargados</a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Usuarios
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{ url('/AgregarUsuario') }}">Agregar Usuario</a>
                                    <a class="dropdown-item" href="{{ url('/Usuarios') }}">Listado de Usuarios</a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Administrador
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ url('/AgregarAdmin') }}">Agregar Administrador</a>
                                <a class="dropdown-item" href="{{ url('/Admins') }}">Lista de Administradores</a>
                            </div>
                        </div>
                    </li>
                </ul>
            @endif

            <!-- Si es Encargado -->
            @if ( Auth::user()->tipoUsuarioID == '1' )
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Usuarios
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ url('/AgregarUsuario') }}">Agregar Usuario</a>
                                <a class="dropdown-item" href="{{ url('/Usuarios') }}">Listado de Usuarios</a>
                            </div>
                          </div>
                    </li>
                    <li class="nav-item">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Laboratorios
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ url('/Laboratorios') }}">Listado de Laboratorios</a>
                            </div>
                          </div>
                    </li>
                </ul>
            @endif

            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->nombre }} <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('user.details.route', Auth::user()->rut) }}">
                            Perfil
                        </a>
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
    </br></br>
    <div class="container">
    <div class="card"></div>
    <div class="card">
      <h1 class="title">Iniciar Sesión</h1>
      <form method="POST" action="{{ route('login') }}">
            @csrf
        <div class="input-container">
            <input type="email" id="#{label}" required="required" @error('email') is-invalid @enderror" name="email" />
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <label for="#{label}">Email</label>
            <div class="bar"></div>
        </div>

        <div class="input-container">
            <input type="password" id="#{label}" required="required" @error('password') is-invalid @enderror" name="password" />
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <label for="#{label}">Contraseña</label>
          <div class="bar"></div>
        </div>

        <div class="button-container">
          <button><span>Ingresar</span></button>
        </div>
      </form>

      <div class="button-container">
        <!-- Boton Atras -->
        <a href="/"><button><span>Volver</span></button></a>
      </div>
    </div>
  </div></div>
</main>

</body>

</html>
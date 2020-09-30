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
        <a href="/"><button><span>Volver</span></button></a>
      </div>
    </div>
  </div>
</body>

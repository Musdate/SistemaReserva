@extends('layouts.app')

@section('title', "Sistema de Reserva")

<!-- Styles -->
<style>
    .full-height {
        height: 65vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 84px;
    }

    .links > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }

    .m-b-md {
        margin-bottom: 30px;
    }
</style>

@section('content')

    <div class="flex-center position-ref full-height">

        <div class="content">

            <div class="title m-b-md">Pagina Principal</div>

            <div class="links">
                <a href="{{ url('/Laboratorios') }}">Ver Laboratorios</a>
                <a href="{{ url('#') }}">Ver Reservas</a>
            </div>

        </div>

    </div>

@endsection
@extends('layouts.app')

@section('title', "Agregar Reserva")

@section('content')

    </br></br>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{  $error  }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('mensaje'))
        <div class="alert alert-success">
            <p>{{ session('mensaje') }}</p>
        </div>
    @endif

    <div class="card border-primary">

        <div class="card-header border-primary"><h2>Agregar reserva</h2></div>

        <div class="card-body">

            <form method="POST" action="{{ url('/AgregarReserva') }}">
                @csrf
                <div class="form-group">
                    <label for="rutUsuario"> Rut Usuario: </label>
                    <input type="text" class="form-control" name="rutUsuario" placeholder="11.111.111-1">
                </div>

                <div class="form-group">
                    <label for="codigoLab"> Codigo Laboratorio: </label>
                    <input type="text" class="form-control" name="codigoLab" placeholder="A01">
                </div>

                <div class="form-group">
                    <label for="moduloReservado"> Modulo: </label>
                    <input type="text" class="form-control" name="moduloReservado" placeholder="1">
                </div>

                </br><button type="submit" class="btn btn-primary" style="width: 130px;">Guardar</button></br></br>

            </form>

        </div>
    </div>

@endsection
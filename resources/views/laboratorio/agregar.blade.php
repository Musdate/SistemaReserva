@extends('layouts.app')

@section('title', "Agregar Laboratorio")

@section('content') 

    <br/></br>

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

        <div class="card-header border-primary"><h2>Agregar Laboratorio</h2></div>

        <div class="card-body">

            <form method="POST" action="{{url('/AgregarLaboratorio')}}">
                @csrf
                <div class="form-group">
                    <label for="codigoLab"> Codigo Laboratorio: </label>
                    <input type="text" class="form-control" name="codigoLab" placeholder="">
                </div>

                <div class="form-group">
                    <label for="nombreSala"> Nombre Sala: </label>
                    <input type="text" class="form-control" name="nombreSala" placeholder="">
                </div>

                <div class="form-group">
                    <label for="capacidadMax"> Capacidad: </label>
                    <input type="text" class="form-control" name="capacidadMax" placeholder="">
                </div>

                <div class="form-group">
                    <label for="tipoLab"> Tipo de Laboratorio: </label>
                    <input type="text" class="form-control" name="tipoLab" placeholder="">
                </div>

                </br><button type="submit" class="btn btn-primary" style="width: 130px;">Guardar</button></br></br>

            </form>

            <a href="{{ url('/') }}"><button type="submit" class="btn btn-primary" style="width: 130px;">Volver</button></a></br></br>
            
        </div>
    </div>

@endsection
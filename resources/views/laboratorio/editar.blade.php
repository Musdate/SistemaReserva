@extends('layouts.app')

@section('title', "Editar Laboratorio")

@section('content')

    </br>

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

    <div class="card border-info">

        <div class="card-header border-info"><h2>Editar Laboratorio</h2></div>

        <div class="card-body">

            <form method="POST" action="{{ url('/EditarLaboratorio/'.$lab->codigoLab) }}">
                {{ method_field('PUT') }}
                @csrf
                <div class="form-group">
                    <label for="codigoLab"> Codigo Laboratorio:</label>
                    <input type="text" readonly class="form-control" name="codigoLab" value="{{old('codigoLab', $lab->codigoLab)}}">
                </div>

                <div class="form-group">
                    <label for="nombreSala"> Nombre Sala:</label>
                    <input type="text" class="form-control" name="nombreSala" value="{{old('nombreSala', $lab->nombreSala)}}">
                </div>
 
                <div class="form-group">
                    <label for="capacidadMax"> Capacidad Máxima:</label>
                    <input type="text" class="form-control" name="capacidadMax" value="{{old('capacidadMax', $lab->capacidadMax)}}">
                </div>

                <div class="form-group">
                    <label for="tipoLab"> Tipo de Laboratorio:</label>
                    <input type="text" class="form-control" name="tipoLab" value="{{old('tipoLab', $lab->tipoLab)}}">
                </div>

                </br><button type="submit" class="btn btn-info" style="width: 130px;">Guardar</button></br></br>

            </form>

            <a href="{{ url('/Laboratorios') }}"><button type="submit" class="btn btn-primary" style="width: 130px;">Volver</button></a></br></br>

        </div>
    </div>

@endsection
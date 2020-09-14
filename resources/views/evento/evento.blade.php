@extends('layouts.app')

@section('title', "Reserva")

@section('content')

      @if ($message = Session::get('success'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
       @endif

<div class="card border-info">

  <div class="card-header border-info"><h2>Reserva</h2></div>

    <div class="card-body">

      <form action="{{ url('/EditarReserva/'.$event->id) }}" method="POST">
      {{ method_field('PUT') }}
      @csrf
        <div class="fomr-group">
          <label for="rut">Rut Usuario:</label>
          <input type="text" readonly class="form-control" name="rutUsuario" value="{{old('rut', $event->rutUsuario)}}">
        </div></br>

        <div class="fomr-group">
          <label for="codigoLab">Codigo Laboratorio:</label>
          <input type="text" class="form-control" name="codigoLab" value="{{old('codigoLab', $event->codigoLab)}}">
        </div></br>

        <div class="fomr-group">
          <label for="motivoReserva">Motivo de la Reserva:</label>
          <input type="text" class="form-control" name="motivoReserva" value="{{old('motivoReserva', $event->motivoReserva)}}">
        </div></br>

        <div class="fomr-group">
          <label for="moduloReservado">Modulo Reservado:</label>
          <input type="text" class="form-control" name="moduloReservado" value="{{old('moduloReservado', $event->moduloReservado)}}">
        </div></br>

        <div class="fomr-group">
          <label for="fecha">Fecha:</label>
          <input type="text" class="form-control" name="fecha" value="{{old('fecha', $event->fecha)}}">
        </div></br></br>

        <div class="fomr-group">
          <label for="estadp">Estado de la Reserva:</br> (1 para Aceptar)</label>
          <input type="text" class="form-control" name="estado" value="{{old('estado', $event->estado)}}" placeholder="1 para Aceptar">
        </div></br>

        <button type="submit" class="btn btn-info" style="width: 130px;">Guardar</button></a>

      </form></br>


      <!-- Boton Eliminar -->
      <a href="{{ route('reserva.delete.route', $event->id) }}" class="delete"
        onclick="return confirm('¿Está seguro que desea ELIMINAR esta Reserva?')">
        <button type="button" class="btn btn-danger" style="width: 130px;">Eliminar</button>
      </a>

      </br></br>
      <a href="{{ url()->previous() }}"><button type="submit" class="btn btn-primary" style="width: 130px;">Atras</button></a>


    </div>

  </div>

@endsection
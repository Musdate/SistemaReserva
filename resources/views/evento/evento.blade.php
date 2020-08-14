@extends('layouts.app')

@section('title', "Evento")

@section('content')

<div class="card border-info">

  <div class="card-header border-info"><h2>Reserva</h2></div>

    <div class="card-body">

      <form action="{{ asset('/AgregarReserva') }}" method="POST">

        <div class="fomr-group">
          <label for="rut">Rut Usuario:</label>
          <input type="text" readonly class="form-control" value="{{old('rut', $event->rutUsuario)}}">
        </div></br>

        <div class="fomr-group">
          <label for="codigoLab">Codigo Laboratorio:</label>
          <input type="text" class="form-control" value="{{old('codigoLab', $event->codigoLab)}}">
        </div></br>

        <div class="fomr-group">
          <label for="motivoReserva">Motivo de la Reserva:</label>
          <input type="text" class="form-control" value="{{old('motivoReserva', $event->motivoReserva)}}">
        </div></br>

        <div class="fomr-group">
          <label for="moduloReservado">Fecha:</label>
          <input type="text" class="form-control" value="{{old('moduloReservado', $event->moduloReservado)}}">
        </div></br></br>

        <button type="submit" class="btn btn-info" style="width: 130px;">Guardar</button></br>

      </form></br>

      <a href="{{ asset('/Evento/index') }}"><button type="submit" class="btn btn-primary">Atras</button></a>

    </div>

  </div>

@endsection
@extends('layouts.app')

@section('title', "Evento")

@section('content')

    <div class="container">
      <div style="height:50px"></div>
      <h1>Evento</h1>

      <hr>

      <div class="col-md-6">
        <form action="{{ asset('/Evento/create/') }}" method="post">
          <div class="fomr-group">
            <h4>Titulo</h4>
            {{ $event->titulo }}
          </div>
          <div class="fomr-group">
            <h4>Descripcion del Evento</h4>
            {{ $event->descripcion }}
          </div>
          <div class="fomr-group">
            <h4>Fecha</h4>
            {{ $event->fecha }}
          </div>
          <br>
          <input type="submit" class="btn btn-info" value="Guardar">
        </form></br>
        <a href="{{ asset('/Evento/index') }}"><button type="submit" class="btn btn-primary">Atras</button></a>
      </div>

    </div>

@endsection
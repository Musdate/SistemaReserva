@extends('layouts.app')

@section('title', "Agregar Reserva")

@section('content')

    </br></br>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
         <button type="button" class="close" data-dismiss="alert">×</button>
         <ul>
          @foreach ($errors->all() as $error)
           <li>{{ $error }}</li>
          @endforeach
         </ul>
        </div>
       @endif
       @if ($message = Session::get('success'))
       <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>{{ $message }}</strong>
       </div>
       @endif

    <div class="card border-primary">

        <div class="card-header border-primary"><h2>Agregar reserva</h2></div>

        <div class="card-body">

            <form method="POST" action="{{ url('/AgregarReserva') }}">
                @csrf
                <div class="fomr-group">
                  <label>Rut Usuario:</label>
                  <input type="text" readonly class="form-control" name="rutUsuario" value="{{old('rut', Auth::user()->rut)}}"></br>
                </div>

                <div class="fomr-group">
                  <label>Codigo Laboratorio:</label>
                  <input type="text" class="form-control" name="codigoLab"></br>
                </div>

                <div class="fomr-group">
                  <label>Motivo de la Reserva:</label>
                  <input type="text" class="form-control" name="motivoReserva"></br>
                </div>                

                <div class="fomr-group">
                  <label>Modulo reservado:</label>
                  <input type="text" class="form-control" name="moduloReservado">
                </div>

                <div class="fomr-group">
                  <label>Fecha:</label>
                  <input type="date" class="form-control" name="fecha">
                </div>

                </br><button type="submit" class="btn btn-info" style="width: 130px;">Guardar</button></br></br>

            </form>
            <a href="{{ url()->previous() }}"><button type="submit" class="btn btn-primary" style="width: 130px;">Atras</button></a>
        </div>
    </div>

@endsection
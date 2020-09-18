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

                <div class="form-row">
                    <div class="col-4">
                        <label>Fecha Inicio:</label>
                        <input type="date" class="form-control" name="fechaInicio">
                    </div>
                    <div class="col-4">
                        <label>Fecha Fin:</label>
                        <input type="date" class="form-control" name="fechaFin">
                    </div>
                    <div class="col-4">
                        <label>Dia:</label>
                        <input type="text" class="form-control" name="dia">
                    </div>
                 </div></br></br>

                <div class="row">
                    <div class="col-6">

                  <table class="table">

                    <thead>
                      <tr>
                          <th>Módulos</th>
                          <th></th>
                      </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>08:30 - 09:30</td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="check1" name="moduloReservado[]" value="1">
                                    <label class="custom-control-label" for="check1">Reservar</label>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>09:35 - 10:35</td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="check2" name="moduloReservado[]" value="2">
                                    <label class="custom-control-label" for="check2">Reservar</label>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>10:50 - 11:50</td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="check3" name="moduloReservado[]" value="3">
                                    <label class="custom-control-label" for="check3">Reservar</label>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>11:55 - 12:55</td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="check4" name="moduloReservado[]" value="4">
                                    <label class="custom-control-label" for="check4">Reservar</label>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>13:10 - 14:10</td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="check5" name="moduloReservado[]" value="5">
                                    <label class="custom-control-label" for="check5">Reservar</label>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>14:30 - 15:30</td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="check6" name="moduloReservado[]" value="6">
                                    <label class="custom-control-label" for="check6">Reservar</label>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>15:35 - 16:35</td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="check7" name="moduloReservado[]" value="7">
                                    <label class="custom-control-label" for="check7">Reservar</label>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>16:50 - 17:50</td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="check8" name="moduloReservado[]" value="8">
                                    <label class="custom-control-label" for="check8">Reservar</label>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>17:55 - 18:55</td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="check9" name="moduloReservado[]" value="9">
                                    <label class="custom-control-label" for="check9">Reservar</label>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>19:10 - 20:10</td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="check10" name="moduloReservado[]" value="10">
                                    <label class="custom-control-label" for="check10">Reservar</label>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                  </table>
                  </div>
                </div>

                </br><button type="submit" class="btn btn-info" style="width: 130px;">Guardar</button></br></br>

            </form>
            <a href="{{ url()->previous() }}"><button type="submit" class="btn btn-primary" style="width: 130px;">Atras</button></a>
        </div>
    </div>

@endsection
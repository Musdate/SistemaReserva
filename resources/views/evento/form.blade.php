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
                  <label>Fecha:</label>
                  <input type="date" class="form-control" name="fecha">
                </div></br>

                <div class="fomr-group">

                  <table class="table">
                    <thead>
                      <tr>
                          <th>Módulo</th>
                          <th scope="col" style="text-align: center;">Lunes</th>
                          <th scope="col" style="text-align: center;">Martes</th>
                          <th scope="col" style="text-align: center;">Miercoles</th>
                          <th scope="col" style="text-align: center;">Jueves</th>
                          <th scope="col" style="text-align: center;">Viernes</th>
                          <th scope="col" style="text-align: center;">Sabado</th>
                      </tr>
                    </thead>
                    <tbody>

                      <tr>
                        <td>08:30 - 09:30</td>

                          <ul class="list-group list-group-flush">

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check1" name="moduloReservado[]" value="Lunes">
                                        <label class="custom-control-label" for="check1">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check2" name="moduloReservado[]" value="Martes">
                                        <label class="custom-control-label" for="check2">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check3" name="moduloReservado[]" value="Miercoles">
                                        <label class="custom-control-label" for="check3">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check4" name="moduloReservado[]" value="Jueves">
                                        <label class="custom-control-label" for="check4">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check5" name="moduloReservado[]" value="Viernes">
                                        <label class="custom-control-label" for="check5">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check6" name="moduloReservado[]" value="Sabado">
                                        <label class="custom-control-label" for="check6">Reservar</label>
                                    </div>
                                </li>
                            </td>
                      </tr>

                      <tr>
                            <td>09:35 - 10:35</td>
                            
                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check8" name="moduloReservado[]" value="Lunes">
                                        <label class="custom-control-label" for="check8">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check9" name="moduloReservado[]" value="Martes">
                                        <label class="custom-control-label" for="check9">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check10" name="moduloReservado[]" value="Miercoles">
                                        <label class="custom-control-label" for="check10">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check11" name="moduloReservado[]" value="Jueves">
                                        <label class="custom-control-label" for="check11">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check12" name="moduloReservado[]" value="Viernes">
                                        <label class="custom-control-label" for="check12">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check13" name="moduloReservado[]" value="Sabado">
                                        <label class="custom-control-label" for="check13">Reservar</label>
                                    </div>
                                </li>
                            </td>

                          </ul>
                      </tr>
                    </tbody>
                  </table>
                </div>

                </br><button type="submit" class="btn btn-info" style="width: 130px;">Guardar</button></br></br>

            </form>
            <a href="{{ url()->previous() }}"><button type="submit" class="btn btn-primary" style="width: 130px;">Atras</button></a>
        </div>
    </div>

@endsection
@extends('layouts.app')

@section('title', "Agregar Reserva")

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
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

    @if ($mensaje)
        @if ($mensaje == "Reserva Exitosa!")
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $mensaje }}</strong>
            </div>
        @else
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $mensaje }}</strong>
            </div>
        @endif
    @endif

    @if ($veriVariable)
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <li><strong>Estos son los Modulos NO Disponibles, Marque la Opcion "Reservar Solo Disponibles" si desea hacer la Reserva de todas formas.</strong></li>
        </div>
        @foreach ($veriVariable as $veri)
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <li>Modulo {{ $veri->moduloReservado }}, {{ $veri->fecha }}</li>
            </div>
        @endforeach
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <li><strong>Modulos Disponibles: {{ $modDisponibles }}</strong></li>
        </div>
    @endif

    <div class="card border-primary">

        <div class="card-header border-primary"><h2>Agregar reserva</h2></div>

        <div class="card-body">

            <form method="POST" action="{{ url('/AgregarReserva') }}">
                @csrf
                <div class="form-group">
                  <label for="rutUsuario">Rut Usuario:</label>
                  <input type="text" readonly class="form-control" id="rutUsuario" name="rutUsuario" value="{{$datos['rutUsuario']}}">
                </div>

                <div class="form-group">
                    <label for="codigoLab">Codigo Laboratorio</label>
                    <select class="custom-select d-block w-100" id="codigoLab" name="codigoLab" required>
                        <option value="{{$datos['codigoLab']}}">{{$datos['codigoLab']}}</option>
                        @foreach ($labs as $lab)
                            @if ($lab->codigoLab == $datos['codigoLab'])
                            @else
                                <option value="{{$lab->codigoLab}}">{{$lab->codigoLab}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="motivoReserva">Motivo de la Reserva:</label>
                    <textarea type="text" class="form-control" rows="2" id="motivoReserva" name="motivoReserva">{{$datos['motivoReserva']}}</textarea>
                </div>

                <div class="form-group">
                    <div class="form-row">
                        <div class="col">
                            <label for="fechaInicio">Fecha Inicio:</label>
                            <input type="date" class="form-control" id="fechaInicio" name="fechaInicio" value="{{$datos['fechaInicio']}}">
                        </div>
                        <div class="col">
                            <label for="fechaFin">Fecha Fin:</label>
                            <input type="date" class="form-control" id="fechaFin" name="fechaFin" value="{{$datos['fechaFin']}}">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-row">
                        <div class="col-4">
                            <div class="panel-group">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-tittle" style="text-align: center;">
                                            <button type="button" class="btn btn-primary" data-toggle="collapse" style="height: 48px; margin-top: 1px; width: 349px; border: none;" href="#collapse1">Reserva Entre Semanas</button>
                                        </h4>
                                    </div>
                                    <div id="collapse1" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <ul class="list-group">
                                                <li class="list-group-item">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="checkSem1" name="semanaReservada[]" value="1" @if (in_array(1, $datos['semanaReservada'])) checked @endif>
                                                        <label readonly class="custom-control-label" for="checkSem1">Semana 1</label>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="checkSem2" name="semanaReservada[]" value="2" @if (in_array(2, $datos['semanaReservada'])) checked @endif>
                                                        <label class="custom-control-label" for="checkSem2">Semana 2</label>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="checkSem3" name="semanaReservada[]" value="3"@if (in_array(3, $datos['semanaReservada'])) checked @endif>
                                                        <label class="custom-control-label" for="checkSem3">Semana 3</label>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="checkSem4" name="semanaReservada[]" value="4" @if (in_array(4, $datos['semanaReservada'])) checked @endif>
                                                        <label class="custom-control-label" for="checkSem4">Semana 4</label>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="checkSem5" name="semanaReservada[]" value="5" @if (in_array(5, $datos['semanaReservada'])) checked @endif>
                                                        <label class="custom-control-label" for="checkSem5">Semana 5</label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div></br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="checkAtomico" name="checkAtomico" value="1">
                                        <label class="custom-control-label" for="checkAtomico">Realizar Reserva Atomica</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-4">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="checkReserva" name="checkReserva" value="1">
                                        <label class="custom-control-label" for="checkReserva">Reservar solo Disponibles</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <table class="table table-bordered">

                <thead style="text-align: center;">
                    <tr class="table-primary">
                        <th>N°</th>
                        <th>Módulos</th>
                        <th>Lunes</th>
                        <th>Martes</th>
                        <th>Miercoles</th>
                        <th>Jueves</th>
                        <th>Viernes</th>
                        <th>Sabado</th>
                        <th>Domingo</th>
                    </tr>
                </thead>

                <tbody  style="text-align: center;">
                    <tr>
                        <th>1</th>
                        <td>08:30 - 09:30</td>
                        @for($i = 0; $i < 7; $i++)
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="check{{$i}}1" name="moduloReservado[]" value="{{$i}}1" @if (in_array($i.'1', $datos['moduloReservado'])) checked @endif>
                                    <label class="custom-control-label" for="check{{$i}}1"></label>
                                </div>
                            </td>
                        @endfor
                    </tr>

                    <tr>
                        <th>2</th>
                        <td>09:35 - 10:35</td>
                        @for($i = 0; $i < 7; $i++)
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="check{{$i}}2" name="moduloReservado[]" value="{{$i}}2" @if (in_array($i.'2', $datos['moduloReservado'])) checked @endif>
                                    <label class="custom-control-label" for="check{{$i}}2"></label>
                                </div>
                            </td>
                        @endfor
                    </tr>

                    <tr>
                        <th>3</th>
                        <td>10:50 - 11:50</td>
                        @for($i = 0; $i < 7; $i++)
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="check{{$i}}3" name="moduloReservado[]" value="{{$i}}3" @if (in_array($i.'3', $datos['moduloReservado'])) checked @endif>
                                    <label class="custom-control-label" for="check{{$i}}3"></label>
                                </div>
                            </td>
                        @endfor
                    </tr>

                    <tr>
                        <th>4</th>
                        <td>11:55 - 12:55</td>
                        @for($i = 0; $i < 7; $i++)
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="check{{$i}}4" name="moduloReservado[]" value="{{$i}}4" @if (in_array($i.'4', $datos['moduloReservado'])) checked @endif>
                                    <label class="custom-control-label" for="check{{$i}}4"></label>
                                </div>
                            </td>
                        @endfor
                    </tr>

                    <tr>
                        <th>5</th>
                        <td>13:10 - 14:10</td>
                        @for($i = 0; $i < 7; $i++)
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="check{{$i}}5" name="moduloReservado[]" value="{{$i}}5" @if (in_array($i.'5', $datos['moduloReservado'])) checked @endif>
                                    <label class="custom-control-label" for="check{{$i}}5"></label>
                                </div>
                            </td>
                        @endfor
                    </tr>

                    <tr>
                        <th>6</th>
                        <td>14:30 - 15:30</td>
                        @for($i = 0; $i < 7; $i++)
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="check{{$i}}6" name="moduloReservado[]" value="{{$i}}6" @if (in_array($i.'6', $datos['moduloReservado'])) checked @endif>
                                    <label class="custom-control-label" for="check{{$i}}6"></label>
                                </div>
                            </td>
                        @endfor
                    </tr>

                    <tr>
                        <th>7</th>
                        <td>15:35 - 16:35</td>
                        @for($i = 0; $i < 7; $i++)
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="check{{$i}}7" name="moduloReservado[]" value="{{$i}}7" @if (in_array($i.'7', $datos['moduloReservado'])) checked @endif>
                                    <label class="custom-control-label" for="check{{$i}}7"></label>
                                </div>
                            </td>
                        @endfor
                    </tr>

                    <tr>
                        <th>8</th>
                        <td>16:50 - 17:50</td>
                        @for($i = 0; $i < 7; $i++)
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="check{{$i}}8" name="moduloReservado[]" value="{{$i}}8" @if (in_array($i.'8', $datos['moduloReservado'])) checked @endif>
                                    <label class="custom-control-label" for="check{{$i}}8"></label>
                                </div>
                            </td>
                        @endfor
                    </tr>

                    <tr>
                        <th>9</th>
                        <td>17:55 - 18:55</td>
                        @for($i = 0; $i < 7; $i++)
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="check{{$i}}9" name="moduloReservado[]" value="{{$i}}9" @if (in_array($i.'9', $datos['moduloReservado'])) checked @endif>
                                    <label class="custom-control-label" for="check{{$i}}9"></label>
                                </div>
                            </td>
                        @endfor
                    </tr>

                    <tr>
                        <th>10</th>
                        <td>19:10 - 20:10</td>
                        @for($i = 1; $i < 8; $i++)
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="check{{$i}}0" name="moduloReservado[]" value="{{$i}}0" @if (in_array($i.'0', $datos['moduloReservado'])) checked @endif>
                                    <label class="custom-control-label" for="check{{$i}}0"></label>
                                </div>
                            </td>
                        @endfor
                    </tr>
                </tbody>
                </table>

                </br><button type="submit" class="btn btn-info" style="width: 130px;">Guardar</button></br></br>

            </form>
            <!-- Boton Atras -->
            <a href="{{ url()->previous() }}"><button type="submit" class="btn btn-primary" style="width: 130px;">Atras</button></a></br></br>
        </div>
    </div>

@endsection
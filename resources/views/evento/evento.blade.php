@extends('layouts.app')

@section('title', "Reserva")

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

    @if ($message = Session::get('failure'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif

        <div class="card border-info">

            <div class="card-header border-info"><h2>Reserva - {{$event->codigoLab}}</h2></div>

            <div class="card-body">

                <form action="{{ url('/EditarReserva/'.$event->id) }}" method="POST">
                    {{ method_field('PUT') }}
                    @csrf

                    <div class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-tittle" style="text-align: center;">
                                    <button type="button" class="btn btn-primary" data-toggle="collapse" href="#collapse0" style="width: 1223px; border: none;">Expandir Datos de la Reserva</button>
                                </h4>
                            </div>
                            <div id="collapse0" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label for="rutUsuario">Rut Usuario:</label>
                                        <input type="text" readonly class="form-control" id="rutUsuario" name="rutUsuario" value="{{old('rutUsuario', $event->rutUsuario)}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="codigoLab">Nombre Sala</label>
                                        <!-- SI ES DUEÑO DE LA RESERVA -->
                                        @if ($event->rutUsuario == Auth::user()->rut || Auth::user()->tipoUsuarioID == 0)
                                            <select class="custom-select d-block w-100" id="codigoLab" name="codigoLab" required>
                                                @if (old('codigoLab', $event->codigoLab))
                                                    <option value="{{$event->codigoLab}}">{{$event->codigoLab}}</option>
                                                @else
                                                    <option value="">Elegir...</option>
                                                @endif
                                                @foreach ($labs as $lab)
                                                    @if($lab->codigoLab == $event->codigoLab)
                                                    @else
                                                    <option value="{{$lab->codigoLab}}">{{$lab->codigoLab}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        @else
                                            <input type="text" readonly class="form-control" id="codigoLab" name="codigoLab" value="{{old('codigoLab', $event->codigoLab)}}">
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="motivoReserva">Motivo de la Reserva:</label>
                                        @if ($event->rutUsuario == Auth::user()->rut || Auth::user()->tipoUsuarioID == 0)
                                            <input type="text" class="form-control" name="motivoReserva" value="{{old('motivoReserva', $event->motivoReserva)}}">
                                        @else
                                            <input type="text" readonly class="form-control" name="motivoReserva" value="{{old('motivoReserva', $event->motivoReserva)}}">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <label for="fechaInicio">Fecha Inicio:</label>
                            @if ($event->rutUsuario == Auth::user()->rut || Auth::user()->tipoUsuarioID == 0)
                                <input type="date" class="form-control" id="fechaInicio" name="fechaInicio" value="{{old('fechaInicio', $event->fechaInicio)}}">
                            @else
                                <input type="date" readonly class="form-control" id="fechaInicio" name="fechaInicio" value="{{old('fechaInicio', $event->fechaInicio)}}">
                            @endif
                        </div>
                        <div class="col">
                            <label for="fechaFin">Fecha Fin:</label>
                            @if ($event->rutUsuario == Auth::user()->rut || Auth::user()->tipoUsuarioID == 0)
                                <input type="date" class="form-control" id="fechaFin" name="fechaFin" value="{{old('fechaFin', $event->fechaFin)}}">
                            @else
                                <input type="date" readonly class="form-control" id="fechaFin" name="fechaFin" value="{{old('fechaFin', $event->fechaFin)}}">
                            @endif
                        </div>
                    </div></br>

                    <div class="form-row">
                        <div class="col">
                            <div class="panel-group">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-tittle" style="text-align: center;">
                                            <button type="button" class="btn btn-primary" data-toggle="collapse" href="#collapse1" style="width: 529px; border: none;">Reserva Entre Semanas</button>
                                        </h4>
                                    </div>
                                    <div id="collapse1" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <ul class="list-group">
                                                <li class="list-group-item">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="checkSem1" name="semanaReservada[]" value="1" checked>
                                                        <label readonly class="custom-control-label" for="checkSem1">Semana 1</label>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="checkSem2" name="semanaReservada[]" value="2" checked>
                                                        <label class="custom-control-label" for="checkSem2">Semana 2</label>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="checkSem3" name="semanaReservada[]" value="3" checked>
                                                        <label class="custom-control-label" for="checkSem3">Semana 3</label>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="checkSem4" name="semanaReservada[]" value="4" checked>
                                                        <label class="custom-control-label" for="checkSem4">Semana 4</label>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="checkSem5" name="semanaReservada[]" value="5" checked>
                                                        <label class="custom-control-label" for="checkSem5">Semana 5</label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div></br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="panel-group">
                                <div class="panel panel-default">
                                    <div class="panel-heading" style="text-align: center;">
                                        <h4 class="panel-tittle">
                                            <button type="button" class="btn btn-primary" data-toggle="collapse" href="#collapse2" style="width: 529px; border: none;">Eliminar intervalo de fechas</button>
                                        </h4>
                                    </div>
                                    <div id="collapse2" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="card">
                                                <div class="container">
                                                    <div class="form-row">
                                                        <div class="col">
                                                            <label for="intervaloFechaInicio" style="margin-top: 7px;">Fecha Inicio:</label>
                                                            @if ($event->rutUsuario == Auth::user()->rut || Auth::user()->tipoUsuarioID == 0)
                                                                <input type="date" class="form-control" id="intervaloFechaInicio" name="intervaloFechaInicio" value="">
                                                            @else
                                                                <input type="date" readonly class="form-control" id="intervaloFechaInicio" name="intervaloFechaInicio" value="">
                                                            @endif
                                                        </div>
                                                        <div class="col">
                                                            <label for="intervaloFechaFin" style="margin-top: 7px;">Fecha Fin:</label>
                                                            @if ($event->rutUsuario == Auth::user()->rut || Auth::user()->tipoUsuarioID == 0)
                                                                <input type="date" class="form-control" id="intervaloFechaFin" name="intervaloFechaFin" value="">
                                                            @else
                                                                <input type="date" readonly class="form-control" id="intervaloFechaFin" name="intervaloFechaFin" value="">
                                                            @endif
                                                        </div>
                                                    </div></br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div></br>

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
                                            <input type="checkbox" class="custom-control-input" id="check{{$i}}1" name="moduloReservado[]" value="{{$i}}1" @if(in_array( "{$i}1" , explode( ',' , $event->moduloReservado ))) checked @endif>
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
                                            <input type="checkbox" class="custom-control-input" id="check{{$i}}2" name="moduloReservado[]" value="{{$i}}2" @if(in_array( "{$i}2" , explode( ',' , $event->moduloReservado ))) checked @endif>
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
                                            <input type="checkbox" class="custom-control-input" id="check{{$i}}3" name="moduloReservado[]" value="{{$i}}3" @if(in_array( "{$i}3" , explode( ',' , $event->moduloReservado ))) checked @endif>
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
                                            <input type="checkbox" class="custom-control-input" id="check{{$i}}4" name="moduloReservado[]" value="{{$i}}4" @if(in_array( "{$i}4" , explode( ',' , $event->moduloReservado ))) checked @endif>
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
                                            <input type="checkbox" class="custom-control-input" id="check{{$i}}5" name="moduloReservado[]" value="{{$i}}5" @if(in_array( "{$i}5" , explode( ',' , $event->moduloReservado ))) checked @endif>
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
                                            <input type="checkbox" class="custom-control-input" id="check{{$i}}6" name="moduloReservado[]" value="{{$i}}6" @if(in_array( "{$i}6" , explode( ',' , $event->moduloReservado ))) checked @endif>
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
                                            <input type="checkbox" class="custom-control-input" id="check{{$i}}7" name="moduloReservado[]" value="{{$i}}7" @if(in_array( "{$i}7" , explode( ',' , $event->moduloReservado ))) checked @endif>
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
                                            <input type="checkbox" class="custom-control-input" id="check{{$i}}8" name="moduloReservado[]" value="{{$i}}8" @if(in_array( "{$i}8" , explode( ',' , $event->moduloReservado ))) checked @endif>
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
                                            <input type="checkbox" class="custom-control-input" id="check{{$i}}9" name="moduloReservado[]" value="{{$i}}9" @if(in_array( "{$i}9" , explode( ',' , $event->moduloReservado ))) checked @endif>
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
                                            <input type="checkbox" class="custom-control-input" id="check{{$i}}0" name="moduloReservado[]" value="{{$i}}0" @if(in_array( "{$i}0" , explode( ',' , $event->moduloReservado ))) checked @endif>
                                            <label class="custom-control-label" for="check{{$i}}0"></label>
                                        </div>
                                    </td>
                                @endfor
                            </tr>
                        </tbody>
                    </table></br>

                    @if ($event->rutUsuario == Auth::user()->rut || Auth::user()->tipoUsuarioID == 0)
                        <div class="form-horizontal">
                            <div class="form-group">
                                
                                <!-- Boton Guardar -->
                                <button type="submit" class="btn btn-info" style="width: 130px;">Guardar</button></a>
                                <!-- Boton Calendario -->
                                <a href="{{ route('laboratorio.show.route', $event->codigoLab) }}"><button type="button" class="btn btn-primary" style="width: 130px;">Calendario</button></a>
                            </div>
                            <div class="form-group">
                                <!-- Boton Eliminar -->
                                <a href="{{ route('reserva.delete.route', $event->id) }}" class="delete"
                                onclick="return confirm('¿Está seguro que desea ELIMINAR esta Reserva?')">
                                    <button type="button" class="btn btn-danger " style="width: 130px;">Eliminar</button>
                                </a>
                                <!-- Boton Listado -->
                                <a href="{{ url('/Reservas') }}"><button type="button" class="btn btn-primary" style="width: 130px;">Listado</button></a>
                            </div>
                        </div>
                    @else
                        <div class="form-horizontal">
                            <div class="form-group">
                                <!-- Boton Calendario -->
                                <a href="{{ route('laboratorio.show.route', $event->codigoLab) }}"><button type="button" class="btn btn-primary" style="width: 130px;">Calendario</button></a>
                            </div>
                            <div class="form-group">
                                <!-- Boton Listado -->
                                <a href="{{ url('/Reservas') }}"><button type="button" class="btn btn-primary" style="width: 130px;">Listado</button></a>
                            </div>
                        </div>
                    @endif
                </form></br>
            </div>
        </div>

@endsection
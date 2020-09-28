@extends('layouts.app')

@section('title', "Reserva")

@section('content')

  </br>

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

    <div class="card-header border-info"><h2>Reserva</h2></div>

    <div class="card-body">

      <form action="{{ url('/EditarReserva/'.$event->id) }}" method="POST">
        {{ method_field('PUT') }}
        @csrf
        <div class="fomr-group">
          <label for="rut">Rut Usuario:</label>
          <input type="text" readonly class="form-control" name="rutUsuario" value="{{old('rut', $event->rutUsuario)}}">
        </div></br>

        <div class="form-group">
          <label for="lab">Codigo Laboratorio</label>
          <select class="custom-select d-block w-100" id="lab" name="codigoLab" value="{{old('codigoLab', $event->codigoLab)}}" required>
            @foreach ($labs as $lab)
              <option value="{{$lab->codigoLab}}">{{$lab->codigoLab}}</option>
            @endforeach
          </select>
          <div class="invalid-feedback">
            Por favor seleccione un Laboratorio valido.
          </div>
        </div>

        <div class="fomr-group">
          <label for="motivoReserva">Motivo de la Reserva:</label>
          <input type="text" class="form-control" name="motivoReserva" value="{{old('motivoReserva', $event->motivoReserva)}}">
        </div></br>

        <div class="form-row">
          <div class="col">
              <label>Fecha Inicio:</label>
              <input type="date" class="form-control" name="fechaInicio" value="{{old('fecha', $event->fechaInicio)}}">
          </div>
          <div class="col">
              <label>Fecha Fin:</label>
              <input type="date" class="form-control" name="fechaFin" value="{{old('fecha', $event->fechaFin)}}">
          </div>
        </div></br></br>

        <table class="table table-bordered">

                <thead style="text-align: center;">
                    <tr class="table-primary">
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

        <button type="submit" class="btn btn-info" style="width: 130px;">Guardar</button></a>

      </form></br>


      <!-- Boton Eliminar -->
      <a href="{{ route('reserva.delete.route', $event->id) }}" class="delete"
        onclick="return confirm('¿Está seguro que desea ELIMINAR esta Reserva?')">
        <button type="button" class="btn btn-danger" style="width: 130px;">Eliminar</button>
      </a></br></br>

      <a href="{{ url()->previous() }}"><button type="submit" class="btn btn-primary" style="width: 130px;">Atras</button></a>

    </div>

  </div>

@endsection
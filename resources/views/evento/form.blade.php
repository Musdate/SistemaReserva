@extends('layouts.app')

@section('title', "Agregar Reserva")

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

    <div class="card border-primary">

        <div class="card-header border-primary"><h2>Agregar reserva</h2></div>

        <div class="card-body">

            <form method="POST" action="{{ url('/AgregarReserva') }}">
                @csrf
                <div class="fomr-group">
                  <label>Rut Usuario:</label>
                  <input type="text" readonly class="form-control" name="rutUsuario" value="{{old('rut', Auth::user()->rut)}}"></br>
                </div>

                <div class="form-group">
                    <label for="lab">Codigo Laboratorio</label>
                    <select class="custom-select d-block w-100" id="lab" name="codigoLab" required>
                        <option value="">Elegir...</option>
                        @foreach ($labs as $lab)
                        <option value="{{$lab->codigoLab}}">{{$lab->codigoLab}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="fomr-group">
                    <label for="Textarea1">Motivo de la Reserva:</label>
                    <textarea class="form-control" id="Textarea1" rows="2" name="motivoReserva"></textarea>
                </div></br>

                <div class="form-row">
                    <div class="col">
                        <label>Fecha Inicio:</label>
                        <input type="date" class="form-control" name="fechaInicio">
                    </div>
                    <div class="col">
                        <label>Fecha Fin:</label>
                        <input type="date" class="form-control" name="fechaFin">
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
                                    <input type="checkbox" class="custom-control-input" id="check{{$i}}1"i name="moduloReservado[]" value="{{$i}}1">
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
                                    <input type="checkbox" class="custom-control-input" id="check{{$i}}2"i name="moduloReservado[]" value="{{$i}}2">
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
                                    <input type="checkbox" class="custom-control-input" id="check{{$i}}3"i name="moduloReservado[]" value="{{$i}}3">
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
                                    <input type="checkbox" class="custom-control-input" id="check{{$i}}4"i name="moduloReservado[]" value="{{$i}}4">
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
                                    <input type="checkbox" class="custom-control-input" id="check{{$i}}5"i name="moduloReservado[]" value="{{$i}}5">
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
                                    <input type="checkbox" class="custom-control-input" id="check{{$i}}6"i name="moduloReservado[]" value="{{$i}}6">
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
                                    <input type="checkbox" class="custom-control-input" id="check{{$i}}7"i name="moduloReservado[]" value="{{$i}}7">
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
                                    <input type="checkbox" class="custom-control-input" id="check{{$i}}8"i name="moduloReservado[]" value="{{$i}}8">
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
                                    <input type="checkbox" class="custom-control-input" id="check{{$i}}9"i name="moduloReservado[]" value="{{$i}}9">
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
                                    <input type="checkbox" class="custom-control-input" id="check{{$i}}0"i name="moduloReservado[]" value="{{$i}}0">
                                    <label class="custom-control-label" for="check{{$i}}0"></label>
                                </div>
                            </td>
                        @endfor
                    </tr>
                </tbody>
                </table>

                </br><button type="submit" class="btn btn-info" style="width: 130px;">Guardar</button></br></br>

            </form>
            <a href="{{ url()->previous() }}"><button type="submit" class="btn btn-primary" style="width: 130px;">Atras</button></a>
        </div>
    </div>

@endsection
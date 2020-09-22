@extends('layouts.app')

@section('title', "Agregar Reserva")

@section('content')

    </br>

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
                    <div class="col-4">
                        <label>Fecha Inicio:</label>
                        <input type="date" class="form-control" name="fechaInicio">
                    </div>
                    <div class="col-4">
                        <label>Fecha Fin:</label>
                        <input type="date" class="form-control" name="fechaFin">
                    </div>

                    <div class="col-4">
                        <label for="dia">Dia:</label>
                        <select class="custom-select d-block w-100" id="dia" name="dia" required>
                            <option value="">Elegir...</option>
                            <option value="Lunes">Lunes</option>
                            <option value="Martes">Martes</option>
                            <option value="Miercoles">Miercoles</option>
                            <option value="Jueves">Jueves</option>
                            <option value="Viernes">Viernes</option>
                            <option value="Sabado">Sabado</option>
                            <option value="Domingo">Domingo</option>                        
                        </select>
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
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="check1" name="moduloReservado[]" value="1">
                                <label class="custom-control-label" for="check1"></label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>09:35 - 10:35</td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="check2" name="moduloReservado[]" value="2">
                                <label class="custom-control-label" for="check2"></label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>10:50 - 11:50</td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="check3" name="moduloReservado[]" value="3">
                                <label class="custom-control-label" for="check3"></label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>11:55 - 12:55</td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="check4" name="moduloReservado[]" value="4">
                                <label class="custom-control-label" for="check4"></label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>13:10 - 14:10</td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="check5" name="moduloReservado[]" value="5">
                                <label class="custom-control-label" for="check5"></label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>14:30 - 15:30</td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="check6" name="moduloReservado[]" value="6">
                                <label class="custom-control-label" for="check6"></label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>15:35 - 16:35</td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="check7" name="moduloReservado[]" value="7">
                                <label class="custom-control-label" for="check7"></label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>16:50 - 17:50</td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="check8" name="moduloReservado[]" value="8">
                                <label class="custom-control-label" for="check8"></label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>17:55 - 18:55</td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="check9" name="moduloReservado[]" value="9">
                                <label class="custom-control-label" for="check9"></label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>19:10 - 20:10</td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="check10" name="moduloReservado[]" value="10">
                                <label class="custom-control-label" for="check10"></label>
                            </div>
                        </td>
                    </tr>
                </tbody>
                </table>

                </br><button type="submit" class="btn btn-info" style="width: 130px;">Guardar</button></br></br>

            </form>
            <a href="{{ url()->previous() }}"><button type="submit" class="btn btn-primary" style="width: 130px;">Atras</button></a>
        </div>
    </div>

@endsection
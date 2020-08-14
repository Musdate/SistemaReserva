@extends('layouts.app')

@section('title', "Laboratorio")

@section('content')

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{  $error  }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('mensaje'))
        <div class="alert alert-success">
            <p>{{ session('mensaje') }}</p>
        </div>
    @endif

    <h1>Horario {{ $lab->nombreSala }}</h1></br>

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
                <th scope="col" style="text-align: center;">Domingo</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>08:30 - 09:30</td>

                <form method="POST" action="{{ route('reserva.create.route', Auth::user()->rut) }}">
                    @csrf

                    <div class="form-group">
                        <ul class="list-group list-group-flush">

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check1" name="modulosReservados" value="1 Lunes">
                                        <label class="custom-control-label" for="check1">Reservar</label>
                                        
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check2" name="modulosReservados" value="1 Martes">
                                        <label class="custom-control-label" for="check2">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check3" name="modulosReservados" value="1 Miercoles">
                                        <label class="custom-control-label" for="check3">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check4" name="modulosReservados" value="1 Jueves">
                                        <label class="custom-control-label" for="check4">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check5" name="modulosReservados" value="1 Viernes">
                                        <label class="custom-control-label" for="check5">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check6" name="modulosReservados" value="1 Sabado">
                                        <label class="custom-control-label" for="check6">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check7" name="modulosReservados" value="1 Domingo">
                                        <label class="custom-control-label" for="check7">Reservar</label>
                                    </div>
                                </li>
                            </td>
            </tr>

            <tr>
                            <td>09:35 - 10:35</td>
                            
                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check8" name="modulosReservados" value="Lunes">
                                        <label class="custom-control-label" for="check8">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check9" name="modulosReservados" value="Martes">
                                        <label class="custom-control-label" for="check9">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check10" name="modulosReservados" value="Miercoles">
                                        <label class="custom-control-label" for="check10">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check11" name="modulosReservados" value="Jueves">
                                        <label class="custom-control-label" for="check11">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check12" name="modulosReservados" value="Viernes">
                                        <label class="custom-control-label" for="check12">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check13" name="modulosReservados" value="Sabado">
                                        <label class="custom-control-label" for="check13">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check14" name="modulosReservados" value="Domingo">
                                        <label class="custom-control-label" for="check14">Reservar</label>
                                    </div>
                                </li>
                            </td>
            </tr>

            <tr>
                            <td>10:50 - 11:50</td>
                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check15" name="nombre" value="Lunes">
                                        <label class="custom-control-label" for="check15">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check16" name="nombre" value="Martes">
                                        <label class="custom-control-label" for="check16">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check17" name="nombre" value="Miercoles">
                                        <label class="custom-control-label" for="check17">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check18" name="nombre" value="Jueves">
                                        <label class="custom-control-label" for="check18">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check19" name="nombre" value="Viernes">
                                        <label class="custom-control-label" for="check19">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check20" name="nombre" value="Sabado">
                                        <label class="custom-control-label" for="check20">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check21" name="nombre" value="Domingo">
                                        <label class="custom-control-label" for="check21">Reservar</label>
                                    </div>
                                </li>
                            </td>
            </tr>

            <tr>
                            <td>11:55 - 12:55</td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check22" name="nombre" value="Lunes">
                                        <label class="custom-control-label" for="check22">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check23" name="nombre" value="Martes">
                                        <label class="custom-control-label" for="check23">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check24" name="nombre" value="Miercoles">
                                        <label class="custom-control-label" for="check24">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check25" name="nombre" value="Jueves">
                                        <label class="custom-control-label" for="check25">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check26" name="nombre" value="Viernes">
                                        <label class="custom-control-label" for="check26">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check27" name="nombre" value="Sabado">
                                        <label class="custom-control-label" for="check27">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check28" name="nombre" value="Domingo">
                                        <label class="custom-control-label" for="check28">Reservar</label>
                                    </div>
                                </li>
                            </td>
            </tr>

            <tr>
                            <td>13:10 - 14:10</td>
                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check29" name="nombre" value="Lunes">
                                        <label class="custom-control-label" for="check29">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check30" name="nombre" value="Martes">
                                        <label class="custom-control-label" for="check30">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check31" name="nombre" value="Miercoles">
                                        <label class="custom-control-label" for="check31">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check32" name="nombre" value="Jueves">
                                        <label class="custom-control-label" for="check32">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check33" name="nombre" value="Viernes">
                                        <label class="custom-control-label" for="check33">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check34" name="nombre" value="Sabado">
                                        <label class="custom-control-label" for="check34">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check35" name="nombre" value="Domingo">
                                        <label class="custom-control-label" for="check35">Reservar</label>
                                    </div>
                                </li>
                            </td>
            </tr>

            <tr>
                            <td>14:30 - 15:30</td>
                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check36" name="nombre" value="Lunes">
                                        <label class="custom-control-label" for="check36">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check37" name="nombre" value="Martes">
                                        <label class="custom-control-label" for="check37">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check38" name="nombre" value="Miercoles">
                                        <label class="custom-control-label" for="check38">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check39" name="nombre" value="Jueves">
                                        <label class="custom-control-label" for="check39">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check40" name="nombre" value="Viernes">
                                        <label class="custom-control-label" for="check40">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check41" name="nombre" value="Sabado">
                                        <label class="custom-control-label" for="check41">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check42" name="nombre" value="Domingo">
                                        <label class="custom-control-label" for="check42">Reservar</label>
                                    </div>
                                </li>
                            </td>
            </tr>

            <tr>
                            <td>15:35 - 16:35</td>
                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check43" name="nombre" value="Lunes">
                                        <label class="custom-control-label" for="check43">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check44" name="nombre" value="Martes">
                                        <label class="custom-control-label" for="check44">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check45" name="nombre" value="Miercoles">
                                        <label class="custom-control-label" for="check45">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check46" name="nombre" value="Jueves">
                                        <label class="custom-control-label" for="check46">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check47" name="nombre" value="Viernes">
                                        <label class="custom-control-label" for="check47">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check48" name="nombre" value="Sabado">
                                        <label class="custom-control-label" for="check48">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check49" name="nombre" value="Domingo">
                                        <label class="custom-control-label" for="check49">Reservar</label>
                                    </div>
                                </li>
                            </td>
            </tr>

            <tr>
                            <td>16:50 - 17:50</td>
                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check50" name="nombre" value="Lunes">
                                        <label class="custom-control-label" for="check50">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check51" name="nombre" value="Martes">
                                        <label class="custom-control-label" for="check51">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check52" name="nombre" value="Miercoles">
                                        <label class="custom-control-label" for="check52">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check53" name="nombre" value="Jueves">
                                        <label class="custom-control-label" for="check53">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check54" name="nombre" value="Viernes">
                                        <label class="custom-control-label" for="check54">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check55" name="nombre" value="Sabado">
                                        <label class="custom-control-label" for="check55">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check56" name="nombre" value="Domingo">
                                        <label class="custom-control-label" for="check56">Reservar</label>
                                    </div>
                                </li>
                            </td>
            </tr>

            <tr>
                            <td>17:55 - 18:55</td>
                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check57" name="nombre" value="Lunes">
                                        <label class="custom-control-label" for="check57">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check58" name="nombre" value="Martes">
                                        <label class="custom-control-label" for="check58">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check59" name="nombre" value="Miercoles">
                                        <label class="custom-control-label" for="check59">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check60" name="nombre" value="Jueves">
                                        <label class="custom-control-label" for="check60">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check61" name="nombre" value="Viernes">
                                        <label class="custom-control-label" for="check61">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check62" name="nombre" value="Sabado">
                                        <label class="custom-control-label" for="check62">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check63" name="nombre" value="Domingo">
                                        <label class="custom-control-label" for="check63">Reservar</label>
                                    </div>
                                </li>
                            </td>
            </tr>

            <tr>
                            <td>19:10 - 20:10</td>
                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check64" name="nombre" value="Lunes">
                                        <label class="custom-control-label" for="check64">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check65" name="nombre" value="Martes">
                                        <label class="custom-control-label" for="check65">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check66" name="nombre" value="Miercoles">
                                        <label class="custom-control-label" for="check66">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check67" name="nombre" value="Jueves">
                                        <label class="custom-control-label" for="check67">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check68" name="nombre" value="Viernes">
                                        <label class="custom-control-label" for="check68">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check69" name="nombre" value="Sabado">
                                        <label class="custom-control-label" for="check69">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check70" name="nombre" value="Domingo">
                                        <label class="custom-control-label" for="check70">Reservar</label>
                                    </div>
                                </li>
                            </td>
                        </ul>
                    </div>

                    </br><button type="submit" class="btn btn-primary" style="width: 130px;">Guardar</button></br></br>

                </form>
            </tr>
        </tbody>
    </table>
    
    

@endsection
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


    <div class="container">
        <div style="height:50px"></div>
        <h1 style="text-align: center;">Horario {{ $lab->nombreSala }}</h1>

        <div class="row header-calendar">
            <div class="col" style="display: flex; justify-content: space-between; padding: 10px;">
                <a  href="{{ asset('/DetallesLaboratorio')}}/<?= $lab->codigoLab; ?>/<?= $data['last']; ?>" style="margin:10px;">
                    <i class="fas fa-chevron-circle-left" style="font-size:30px;color:white;"></i>
                </a>
                <h2 style="font-weight:bold;margin:10px;"><?= $mespanish; ?> <small><?= $data['year']; ?></small></h2>
                <a  href="{{ asset('/DetallesLaboratorio')}}/<?= $lab->codigoLab; ?>/<?= $data['next']; ?>" style="margin:10px;">
                    <i class="fas fa-chevron-circle-right" style="font-size:30px;color:white;"></i>
                </a>
            </div>
        </div>

        <div class="row">
        <div class="col header-col">Lunes</div>
        <div class="col header-col">Martes</div>
        <div class="col header-col">Miercoles</div>
        <div class="col header-col">Jueves</div>
        <div class="col header-col">Viernes</div>
        <div class="col header-col">Sabado</div>
        <div class="col header-col">Domingo</div>
        </div>

        <!-- inicio de semana -->
        @foreach ($data['calendar'] as $weekdata)
            <div class="row">
                <!-- ciclo de dia por semana -->
                @foreach  ($weekdata['datos'] as $dayweek)
                    @if  ($dayweek['mes']==$mes)
                        <div class="col box-day">
                            {{ $dayweek['dia']  }}
                            <!-- evento -->
                            @foreach ($dayweek['evento'] as $event)</br>
                                @for ($i = 1; $i < 11; $i++)
                                    @if (in_array($i, explode(',', $event->moduloReservado)))
                                        <a class="badge badge-danger" href="{{ asset('/Evento/details/') }}/{{ $event->id }}">
                                            Modulo {{$i}}
                                        </a>
                                    @else 
                                        <a class="badge badge-info">
                                            Modulo {{$i}}
                                        </a>
                                    @endif
                                @endfor
                            @endforeach
                        </div>
                    @else
                    <div class="col box-dayoff"></div>
                    @endif
                @endforeach
            </div>
        @endforeach
  </div>




    <!--
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

                <form method="POST" action="#">
                    @csrf

                    <div class="form-group">
                        <ul class="list-group list-group-flush">

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check1" name="modulosReservados[]" value="Lunes">
                                        <label class="custom-control-label" for="check1">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check2" name="modulosReservados[]" value="Martes">
                                        <label class="custom-control-label" for="check2">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check3" name="modulosReservados[]" value="Miercoles">
                                        <label class="custom-control-label" for="check3">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check4" name="modulosReservados[]" value="Jueves">
                                        <label class="custom-control-label" for="check4">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check5" name="modulosReservados[]" value="Viernes">
                                        <label class="custom-control-label" for="check5">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check6" name="modulosReservados[]" value="Sabado">
                                        <label class="custom-control-label" for="check6">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check7" name="modulosReservados[]" value="Domingo">
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
                                        <input type="checkbox" class="custom-control-input" id="check8" name="modulosReservados[]" value="Lunes">
                                        <label class="custom-control-label" for="check8">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check9" name="modulosReservados[]" value="Martes">
                                        <label class="custom-control-label" for="check9">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check10" name="modulosReservados[]" value="Miercoles">
                                        <label class="custom-control-label" for="check10">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check11" name="modulosReservados[]" value="Jueves">
                                        <label class="custom-control-label" for="check11">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check12" name="modulosReservados[]" value="Viernes">
                                        <label class="custom-control-label" for="check12">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check13" name="modulosReservados[]" value="Sabado">
                                        <label class="custom-control-label" for="check13">Reservar</label>
                                    </div>
                                </li>
                            </td>

                            <td>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check14" name="modulosReservados[]" value="Domingo">
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
                        </ul>
                    </div>
                </form>
            </tr>    
        </tbody>
    </table>-->

    </br><a href="{{ url('/Laboratorios') }}"><button type="submit" class="btn btn-primary" style="width: 160px;">Atras</button></a>

@endsection
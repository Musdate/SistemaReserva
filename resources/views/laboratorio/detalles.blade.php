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
                            {{ $dayweek['dia']  }}</br>
                            <!-- imprime eventos -->
                            @php($cont=1)
                            @foreach ($dayweek['evento'] as $event)
                                @for ($i = $cont; $i < 11; $i++)
                                    @if ($i==$event->moduloReservado || $i==$event->moduloReservado - 10 || $i==$event->moduloReservado - 20 || $i==$event->moduloReservado - 30 || $i==$event->moduloReservado - 40 || $i==$event->moduloReservado - 50 || $i==$event->moduloReservado - 60)
                                        <a class="badge badge-danger" href="{{ asset('/Evento/details/') }}/{{ $event->idReserva }}">
                                            Modulo {{$i}} 
                                        </a>
                                        @php($i=11)
                                        @php($cont++)
                                    @else
                                        <a class="badge badge-warning">
                                            Modulo {{$i}}
                                        </a>
                                        @php($cont++)
                                    @endif
                                @endfor
                            @endforeach
                            <!-- imprime el resto de eventos hasta el modulo 10 -->
                            @if (!$dayweek['evento']->isEmpty())
                                @if ($cont < 11)
                                    @for ($i = $cont; $i < 11; $i++)
                                        <a class="badge badge-warning">
                                            Modulo {{$i}}
                                        </a>
                                    @endfor
                                @endif
                            @endif
                        </div>
                    @else
                    <div class="col box-dayoff"></div>
                    @endif
                @endforeach
            </div>
        @endforeach
    </div>

    </br><a href="{{ url('/Laboratorios') }}"><button type="submit" class="btn btn-primary" style="width: 160px;">Atras</button></a>

@endsection
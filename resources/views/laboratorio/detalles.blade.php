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
        
    </br><h1 style="text-align: center;">Horario {{ $lab->nombreSala }}</br>Codigo {{ $lab->codigoLab }}</h1>

    <a href="{{ asset('/AgregarReserva') }}"><button type="submit" class="btn btn-outline-danger">Crear una reserva <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-calendar-plus-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
    <path fill-rule="evenodd" d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zM8.5 8.5a.5.5 0 0 0-1 0V10H6a.5.5 0 0 0 0 1h1.5v1.5a.5.5 0 0 0 1 0V11H10a.5.5 0 0 0 0-1H8.5V8.5z"/>
    </svg></button></a><hr>

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

                        @php($arrayModulos=array())
                        @foreach ($dayweek['evento'] as $event)
                            @php(array_push($arrayModulos, $event->moduloReservado))
                        @endforeach
                        @php(sort($arrayModulos))

                        @php($cont=1)
                        @for ($j = 0 ; $j < count($arrayModulos); $j++)
                            @php($aux=0)
                            @for ($i = $cont; $i < 11; $i++)
                                
                                @foreach ($dayweek['evento'] as $event)
                                    @if ($event->moduloReservado == $arrayModulos[$j])
                                        @if ($i==$event->moduloReservado || $i==$event->moduloReservado - 10 || $i==$event->moduloReservado - 20 || $i==$event->moduloReservado - 30 || $i==$event->moduloReservado - 40 || $i==$event->moduloReservado - 50 || $i==$event->moduloReservado - 60)
                                            <a class="badge badge-danger" href="{{ asset('/Evento/details/') }}/{{ $event->idReserva }}" style="width: 63px;">
                                                Modulo {{$i}} 
                                            </a>
                                            @php($aux=1)
                                            @php($cont++)
                                        @endif
                                    @endif
                                @endforeach
                                @if($aux == 0)
                                    <a class="badge badge-warning" style="width: 63px;">
                                        Modulo {{$i}}
                                    </a>
                                    @php($cont++)
                                @endif
                            @endfor
                        @endfor

                        <!-- imprime el resto de eventos hasta el modulo 10 -->
                        @if (!$dayweek['evento']->isEmpty())
                                @if ($cont < 11)
                                    @for ($i = $cont; $i < 11; $i++)
                                        <a class="badge badge-warning" style="width: 63px;">
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

    </br><a href="{{ url('/Laboratorios') }}"><button type="submit" class="btn btn-primary" style="width: 160px;">Atras</button></a>

@endsection
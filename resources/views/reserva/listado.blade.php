@extends('layouts.app')

@section('title', "Reservas")

@section('content')

    @if (Auth::user()->tipoUsuarioID == '2')

        </br><h1>Mis Reservas</h1></br>

        <table class="table">

            <thead>
                <tr>
                    <th scope="col" style="text-align: center;">Rut Usuario</th>
                    <th scope="col" style="text-align: center;">Rol</th>
                    <th scope="col" style="text-align: center;">Codigo Laboratorio</th>
                    <th scope="col" style="text-align: center;">Modulos Reservados</th>
                    <th scope="col" style="text-align: center;">Fecha Inicio</th>
                    <th scope="col" style="text-align: center;">Fecha Fin</th>
                    <th scope="col" style="text-align: center;">Acciones</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($reservas as $reserva)
                    @if($reserva->rutUsuario == Auth::user()->rut)
                        <tr>
                            <th scope="row" style="text-align: center;">{{ $reserva->rutUsuario }}</th>
                                @if (Auth::user()->rol == 'Estudiante')
                                    <td class="font-weight-bold text-secondary" style="text-align: center;">Estudiante</td>
                                @else
                                    <td  class="font-weight-bold text-primary" style="text-align: center;">{{ Auth::user()->rol }}</td>
                                @endif                            
                            <td style="text-align: center;">{{ $reserva->codigoLab}}</td>
                            <td style="text-align: center;">{{ $reserva->moduloReservado}}</td>
                            <td style="text-align: center;">{{ $reserva->fechaInicio}}</td>
                            <td style="text-align: center;">{{ $reserva->fechaFin}}</td>
                            <td style="text-align: center;">

                                <!-- Boton inspeccionar -->
                                <a href="{{ asset('/Evento/details/') }}/{{ $reserva->id }}">
                                    <button type="submit" class="btn btn-primary">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="black" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                                            <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                                        </svg>
                                    </button>
                                </a>
                            </td>
                        </tr>
                    @endif
                @endforeach
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <!-- Boton Atras -->
        <a href="{{ url()->previous() }}"><button type="submit" class="btn btn-primary" style="width: 130px;">Atras</button></a>

    @else

        </br><h1>Reservas</h1></br>

        <table class="table">

            <thead>
                <tr>
                    <th scope="col" style="text-align: center;">Rut Usuario</th>
                    <th scope="col" style="text-align: center;">Rol</th>
                    <th scope="col" style="text-align: center;">Codigo Laboratorio</th>
                    <th scope="col" style="text-align: center;">Modulos Reservados</th>
                    <th scope="col" style="text-align: center;">Fecha Inicio</th>
                    <th scope="col" style="text-align: center;">Fecha Fin</th>
                    <th scope="col" style="text-align: center;">Acciones</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($reservas as $reserva)              
                    <tr>
                        <th scope="row" style="text-align: center;">{{ $reserva->rutUsuario }}</th>
                        @foreach ($users as $user)
                            @if ($user->rut == $reserva->rutUsuario)
                                @if ($user->rol == 'Estudiante')
                                    <td class="font-weight-bold text-secondary" style="text-align: center;">Estudiante</td>
                                @else
                                    <td  class="font-weight-bold text-primary" style="text-align: center;">{{ $user->rol }}</td>
                                @endif
                            @endif
                        @endforeach
                        <td style="text-align: center;">{{ $reserva->codigoLab}}</td>
                        <td style="text-align: center;">{{ $reserva->moduloReservado}}</td>
                        <td style="text-align: center;">{{ $reserva->fechaInicio}}</td>
                        <td style="text-align: center;">{{ $reserva->fechaFin}}</td>
                        <td style="text-align: center;">

                            <!-- Boton inspeccionar -->
                            <a href="{{ asset('/Evento/details/') }}/{{ $reserva->id }}">
                                <button type="submit" class="btn btn-primary">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="black" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                                        <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                                    </svg>
                                </button>
                            </a>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <!-- Boton Atras -->
        <a href="{{ url()->previous() }}"><button type="submit" class="btn btn-primary" style="width: 130px;">Atras</button></a>

    @endif

@endsection
@extends('layouts.app')

@section('title', "Laboratorios")

@section('content')

    @guest <!-- Usuario NO Registrado -->

        </br><h1>Laboratorios</h1></br>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col" style="text-align: center;">Codigo Laboratorio</th>
                    <th scope="col" style="text-align: center;">Nombre de la Sala</th>
                    <th scope="col" style="text-align: center;">Capacidad Máxima</th>
                    <th scope="col" style="text-align: center;">Tipo de Laboratorio</th>
                    <th scope="col" style="text-align: center;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($labs as $lab)
                    <tr>
                        <th scope="row" style="text-align: center;">{{ $lab->codigoLab }}</th>
                        <td style="text-align: center;">{{ $lab->nombreSala}}</td>
                        <td style="text-align: center;">{{ $lab->capacidadMax}}</td>
                        <td style="text-align: center;">{{ $lab->tipoLab}}</td>
                        <td style="text-align: center;">
                            <a href="{{ route('laboratorio.show.route', $lab->codigoLab) }}">
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
                </tr>
            </tbody>
        </table>

        <!-- Boton Atras -->
        <a href="/"><button type="submit" class="btn btn-primary" style="width: 130px;">Volver</button></a>

    @else <!-- Usuario Registrado -->

    </br><h1>Laboratorios</h1></br>

    <table class="table">
        <thead>
            <tr>
                <th scope="col" style="text-align: center;">Codigo Laboratorio</th>
                <th scope="col" style="text-align: center;">Nombre de la Sala</th>
                <th scope="col" style="text-align: center;">Capacidad Máxima</th>
                <th scope="col" style="text-align: center;">Tipo de Laboratorio</th>
                <th scope="col" style="text-align: center;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($labs as $lab)
                <tr>
                    <th scope="row" style="text-align: center;">{{ $lab->codigoLab }}</th>
                    <td style="text-align: center;">{{ $lab->nombreSala}}</td>
                    <td style="text-align: center;">{{ $lab->capacidadMax}}</td>
                    <td style="text-align: center;">{{ $lab->tipoLab}}</td>
                    <td style="text-align: center;">
                        <a href="{{ route('laboratorio.show.route', $lab->codigoLab) }}">
                            <button type="submit" class="btn btn-primary">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="black" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                                    <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                                </svg>
                            </button>
                        </a>
                        @if ( Auth::user()->tipoUsuarioID == '0' ) <!-- Acciones para el Admin -->
                            <a href="{{ route('laboratorio.details.route', $lab->codigoLab) }}">
                                <button type="submit" class="btn btn-info">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil" fill="black" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M11.293 1.293a1 1 0 0 1 1.414 0l2 2a1 1 0 0 1 0 1.414l-9 9a1 1 0 0 1-.39.242l-3 1a1 1 0 0 1-1.266-1.265l1-3a1 1 0 0 1 .242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z"/>
                                        <path fill-rule="evenodd" d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 0 0 .5.5H4v.5a.5.5 0 0 0 .5.5H5v.5a.5.5 0 0 0 .5.5H6v-1.5a.5.5 0 0 0-.5-.5H5v-.5a.5.5 0 0 0-.5-.5H3z"/>
                                    </svg>
                                </button>
                            </a>

                            <a href="{{ route('laboratorio.delete.route', $lab->codigoLab) }}" class="delete"
                            onclick="return confirm('¿Está seguro que desea ELIMINAR este Laboratorio?')">
                                <button type="button" class="btn btn-danger">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="black" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                                </button>
                            </a>
                        @endif
                    </td>
                </tr>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>

    <!-- Boton Atras -->
    <a href="{{ url()->previous() }}"><button type="submit" class="btn btn-primary" style="width: 130px;">Volver</button></a>
    @endguest

@endsection
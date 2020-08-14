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
        <tbody>
            <tr>
                <td>08:30 - 09:30</td>
                <td><form method="POST" action="{{ route('reserva.create.route', $lab->codigoLab) }}">
                        <div class="form-group">
                            <label for="modulosReservados"> Modulo:</label>
                            <input type="text" class="form-control" name="modulosReservados">
                        </div>
                        <button type="submit" class="btn btn-primary">Reservar</button>
                    </form>
                </td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
            </tr>
            <tr>
                <td>09:35 - 10:35</td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
            </tr>
            <tr>
                <td>10:50 - 11:50</td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
            </tr>
            <tr>
                <td>11:55 - 12:55</td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
            </tr>
            <tr>
                <td>13:10 - 14:10</td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
            </tr>
            <tr>
                <td>14:30 - 15:30</td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
            </tr>
            <tr>
                <td>15:35 - 16:35</td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
            </tr>
            <tr>
                <td>16:50 - 17:50</td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
            </tr>
            <tr>
                <td>17:55 - 18:55</td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
            </tr>
            <tr>
                <td>19:10 - 20:10</td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
                <td><a href=""><button type="submit" class="btn btn-primary">Reservar</button></a></td>
            </tr>
        </tbody>
    </table>
    
    

@endsection
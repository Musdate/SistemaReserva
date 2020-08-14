@extends('layouts.app')

@section('title', "Editar Admin")

@section('content')

    </br></br>

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

    <div class="card border-info">

        <div class="card-header border-info"><h2>Editar Admin</h2></div>

        <div class="card-body">

            <form method="POST" action="{{ url('/EditarAdmin/'.$user->rut) }}">
                {{ method_field('PUT') }}
                @csrf
                <div class="form-group">
                    <label for="rut"> Rut:</label>
                    <input type="text" readonly class="form-control" name="rut" value="{{old('rut', $user->rut)}}">
                </div>

                <div class="form-group">
                    <label for="nombre"> Nombre: </label>
                    <input type="text" class="form-control" name="nombre" value="{{old('nombre', $user->nombre)}}">
                </div>
 
                <div class="form-group">
                    <label for="telefono"> Numero Telefono: </label>
                    <input type="text" class="form-control" name="telefono" value="{{old('telefono', $user->telefono)}}">
                </div>

                <div class="form-group">
                    <label for="email"> Email: </label>
                    <input type="email" class="form-control" name="email" value="{{old('email', $user->email)}}">
                </div>

                <div class="form-group">
                    <label for="password"> Contraseña: </label>
                    <input type="password" class="form-control" name="password" value="{{old('password', $user->password)}}">
                </div>

                </br><button type="submit" class="btn btn-info" style="width: 130px;">Guardar</button></br></br>

            </form>

            <a href="{{ url('/Admins') }}"><button type="submit" class="btn btn-primary" style="width: 130px;">Atras</button></a></br></br>

        </div>
    </div>

@endsection
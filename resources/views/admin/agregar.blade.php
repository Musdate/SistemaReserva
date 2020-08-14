@extends('layouts.app')

@section('title', "Agregar Admin")

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

    <div class="card border-primary">

        <div class="card-header border-primary"><h2>Agregar Admin</h2></div>

        <div class="card-body">

            <form method="POST" action="{{url('/AgregarAdmin')}}">
                @csrf
                <div class="form-group">
                    <label for="rut"> Rut: </label>
                    <input type="text" class="form-control" name="rut" placeholder="11.111.111-1">
                </div>

                <div class="form-group">
                    <label for="nombre"> Nombre: </label>
                    <input type="text" class="form-control" name="nombre" placeholder="Nombre">
                </div>

                <div class="form-group">
                    <label for="telefono"> Numero Telefono: </label>
                    <input type="text" class="form-control" name="telefono" placeholder="11111111">
                </div>

                <div class="form-group">
                    <label for="email"> Email: </label>
                    <input type="email" class="form-control" name="email" placeholder="user@example.com">
                </div>

                <div class="form-group">
                    <label for="password"> Contraseña: </label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña">
                </div>
                
                <div class="form-group">
                    <label for="rol">Rol</label>
                    <select class="custom-select d-block w-100" id="rol" required>
                        <option value="">Elegir...</option>
                        <option>Profesor</option>
                        <option>Estudiante</option>
                        <option>Secretaria(o)</option>
                        <option>Encargado de Laboratorio</option>
                    </select>
                    <div class="invalid-feedback">
                        Por favor seleccione un Rol valido.
                    </div>
                </div>

                </br><button type="submit" class="btn btn-primary" style="width: 130px;">Guardar</button></br></br>

            </form>

        </div>
    </div>

@endsection
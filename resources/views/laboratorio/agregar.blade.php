@extends('layouts.app')

@section('title', "Agregar Laboratorio")

@section('content') 

    </br>

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

    <div class="card">

        <div><h2 class="title">Agregar Laboratorio</h2></div>

        <div class="card-body">

            <form method="POST" action="{{url('/AgregarLaboratorio')}}">
                @csrf
                <!--<div class="input-container">                 
                    <input type="text" id="#codigo" required="required " name="codigoLab" placeholder="                      Código">
                    <label for="#codigo"> Codigo Sala: </label>
                    <div class="bar"></div>
                </div>-->

                <div class="input-container">
                    <input type="text" id="#Nombre" required="required" name="nombreSala" placeholder="                        Nombre">
                    <label for="#Nombre"> Nombre Sala: </label>
                    <div class="bar"></div>
                </div>

                <div class="input-container">
                    <input type="text" id="#Capacidad" required="required" name="capacidadMax" placeholder="                    50">
                    <label for="#Capacidad"> Capacidad: </label>
                    <div class="bar"></div>
                </div>

                <div class="input-container">
                    <input type="text" id="#tipo" required="required" name="tipoLab" placeholder="                                    Informatica">
                    <label for="#tipo"> Tipo de Laboratorio: </label>
                    <div class="bar"></div>
                </div>

                </br><button type="submit" class="button-Guardar"><svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-file-plus-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM8.5 6a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V10a.5.5 0 0 0 1 0V8.5H10a.5.5 0 0 0 0-1H8.5V6z"/>
                  </svg>Añadir Laboratorio</button></br></br>

            </form>

            <a href="{{ url('/') }}"><button type="submit" class="button-Volver"><svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-backspace" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M6.603 2h7.08a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1h-7.08a1 1 0 0 1-.76-.35L1 8l4.844-5.65A1 1 0 0 1 6.603 2zm7.08-1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-7.08a2 2 0 0 1-1.519-.698L.241 8.65a1 1 0 0 1 0-1.302L5.084 1.7A2 2 0 0 1 6.603 1h7.08zM5.829 5.146a.5.5 0 0 0 0 .708L7.976 8l-2.147 2.146a.5.5 0 0 0 .707.708l2.147-2.147 2.146 2.147a.5.5 0 0 0 .707-.708L9.39 8l2.146-2.146a.5.5 0 0 0-.707-.708L8.683 7.293 6.536 5.146a.5.5 0 0 0-.707 0z"/>
              </svg> Volver</button></a></br></br>
            
        </div>
    </div>

@endsection
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservaController extends Controller{
    
    public function reservarModulos($rut){

        $data = request()->validate([
            'rutUsuario' => 'required',
            'rutEncargado' => 'required',
            'codigoLab' => 'required',
            'modulosReservados' => 'required'
        ]);

        Reserva::create([
            'rutUsuario' => $rut,
            'rutEncargado' => '123000',
            'codigoLab' => '123000',
            'modulosReservados' => $data['modulosReservados']
        ]);

        return back()->with('mensaje', 'Reserva Exitosa');
    }
}

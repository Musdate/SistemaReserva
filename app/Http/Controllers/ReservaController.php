<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservaController extends Controller{
    
    public function reservarModulos(){

        $data = request()->validate([
            'rutUsuario' => 'required',
            'rutEncargado' => 'required',
            'codigoLab' => 'required',
            'modulosReservados' => 'required'
        ]);

        Reserva::create([
            'rutUsuario' => $data['rutUsuario'],
            'rutEncargado' => $data['rutEncargado'],
            'codigoLab' => $data['codigoLab'],
            'modulosReservados' => $data['modulosReservados']
        ]);
    }
}

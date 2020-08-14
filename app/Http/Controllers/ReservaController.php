<?php

namespace App\Http\Controllers;

use App\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservaController extends Controller{
    
    public function index(){
        $reservas = DB::table('reservas')->get();
        $users = DB::table('users')->get();

        return view('reserva.listado', compact('reservas', 'users'));
    }

    public function create(){

        return view('reserva.agregar');
    }

    public function store(){

        $data = request()->validate([
            'rutUsuario' => 'required',
            'codigoLab' => 'required',
            'moduloReservado' => 'required'
        ]);

        Reserva::create([
            'rutUsuario' => $data['rutUsuario'],
            'codigoLab' => $data['codigoLab'],
            'moduloReservado' => $data['moduloReservado']
        ]);

        return back()->with('mensaje', 'Reserva Exitosa');
    }

}

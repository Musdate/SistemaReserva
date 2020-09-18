<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LaboratorioSeed extends Seeder{

    public function run(){
        DB::table('laboratorios')->insert([
            'codigoLab' => 'A01',
            'nombreSala' => 'Sala 100',
            'capacidadMax' => '50',
            'tipoLab' => 'Informatica',
        ]);

        DB::table('laboratorios')->insert([
            'codigoLab' => 'A02',
            'nombreSala' => 'Sala 101',
            'capacidadMax' => '50',
            'tipoLab' => 'Informatica',
        ]);

        DB::table('laboratorios')->insert([
            'codigoLab' => 'B01',
            'nombreSala' => 'Sala 103',
            'capacidadMax' => '50',
            'tipoLab' => 'Quimica',
        ]);
        
        DB::table('reservas')->insert([
            'rutUsuario' => '19000003',
            'codigoLab' => 'A01',
            'motivoReserva' => 'Reunion Clases Laboratorio',
            'moduloReservado' => '2',
            'fechaInicio' => '2020-08-19',
            'fechaFin' => '2020-09-19',
            'dia' => 'Lunes'
        ]);

        DB::table('reservas')->insert([
            'rutUsuario' => '19000004',
            'codigoLab' => 'A01',
            'motivoReserva' => 'Reunion Profesores',
            'moduloReservado' => '6',
            'fechaInicio' => '2020-08-21',
            'fechaFin' => '2020-09-21',
            'dia' => 'Martes'
        ]);

        DB::table('reservas')->insert([
            'rutUsuario' => '19000003',
            'codigoLab' => 'A02',
            'motivoReserva' => 'Reunion Ayudantia',
            'moduloReservado' => '3',
            'fechaInicio' => '2020-08-25',
            'fechaFin' => '2020-09-26',
            'dia' => 'Miercoles'
        ]);
    }
}
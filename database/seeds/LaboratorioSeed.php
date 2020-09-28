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
            'fechaFin' => '2020-08-19'
        ]);

        DB::table('reservas')->insert([
            'rutUsuario' => '19000004',
            'codigoLab' => 'A01',
            'motivoReserva' => 'Reunion Profesores',
            'moduloReservado' => '6',
            'fechaInicio' => '2020-08-21',
            'fechaFin' => '2020-08-21'
        ]);

        DB::table('reservas')->insert([
            'rutUsuario' => '19000003',
            'codigoLab' => 'A02',
            'motivoReserva' => 'Reunion Ayudantia',
            'moduloReservado' => '3',
            'fechaInicio' => '2020-08-25',
            'fechaFin' => '2020-08-25'
        ]);

        DB::table('modulos_reservados')->insert([
            'idReserva' => '1',
            'codigoLab' => 'A01',
            'moduloReservado' => '02',
            'fecha' => '2020-08-19'
        ]);

        DB::table('modulos_reservados')->insert([
            'idReserva' => '2',
            'codigoLab' => 'A01',
            'moduloReservado' => '06',
            'fecha' => '2020-08-21'
        ]);

        DB::table('modulos_reservados')->insert([
            'idReserva' => '3',
            'codigoLab' => 'A02',
            'moduloReservado' => '03',
            'fecha' => '2020-08-25'
        ]);
    }
}
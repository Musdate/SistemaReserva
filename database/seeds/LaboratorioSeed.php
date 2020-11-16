<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LaboratorioSeed extends Seeder{

    public function run(){
        DB::table('laboratorios')->insert([
            'codigoLab' => 'Sala 100',
            'nombreSala' => 'Sala 100',
            'capacidadMax' => '50',
            'tipoLab' => 'Informatica',
        ]);

        DB::table('laboratorios')->insert([
            'codigoLab' => 'Sala 101',
            'nombreSala' => 'Sala 101',
            'capacidadMax' => '50',
            'tipoLab' => 'Informatica',
        ]);

        DB::table('laboratorios')->insert([
            'codigoLab' => 'Sala 102',
            'nombreSala' => 'Sala 102',
            'capacidadMax' => '50',
            'tipoLab' => 'Quimica',
        ]);

    }
}
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
    }
}

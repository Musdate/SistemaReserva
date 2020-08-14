<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoUsuarioSeed extends Seeder{

    public function run(){

        DB::table('tipousuario')->insert([
            'id' => '0',
            'tipoUsuario' => 'admin',
        ]);

        DB::table('tipousuario')->insert([
            'id' => '1',
            'tipoUsuario' => 'encargado',
        ]);

        DB::table('tipousuario')->insert([
            'id' => '2',
            'tipoUsuario' => 'usuario',
        ]);
    }
}

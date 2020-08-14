<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder{
    
    public function run(){

        //Vaciar tablas antes de insertar
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('reservas')->truncate();
        DB::table('users')->truncate();
        DB::table('laboratorios')->truncate();
        DB::table('tipousuario')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        $this->call(TipoUsuarioSeed::class);
        $this->call(CuentasSeed::class);
        $this->call(LaboratorioSeed::class);
    }
}

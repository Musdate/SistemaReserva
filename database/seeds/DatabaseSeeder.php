<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder{
    
    public function run(){

        

        $this->call(TipoUsuarioSeed::class);
        $this->call(CuentasSeed::class);
        $this->call(LaboratorioSeed::class);
    }
}

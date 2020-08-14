<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaboratoriosTable extends Migration{

    public function up(){

        Schema::create('laboratorios', function (Blueprint $table){
            $table->string('codigoLab')->unique();
            $table->string('nombreSala');
            $table->string('capacidadMax');
            $table->string('tipoLab');

            //Clave primaria
            $table->primary('codigoLab');
        });
    }

    public function down(){

        Schema::dropIfExists('laboratorios');
    }
}
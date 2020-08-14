<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipousuarioTable extends Migration{

    public function up(){

        Schema::create('tipousuario', function (Blueprint $table){
            $table->integer('id')->unique();
            $table->string('tipoUsuario');

            //Clave primaria
            $table->primary('id');
        });
    }

    public function down(){

        Schema::dropIfExists('tipousuario');
    }
}
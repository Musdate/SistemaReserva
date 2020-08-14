<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration{

    public function up(){

        Schema::create('users', function (Blueprint $table){
            $table->id();
            $table->integer('tipoUsuarioID')->index();
            $table->string('rut')->unique();
            $table->string('nombre');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('telefono');
            $table->rememberToken();

            //Relaciones
            $table->foreign('tipoUsuarioID')->references('id')->on('tipousuario');
        });
    }

    public function down(){

        Schema::dropIfExists('users');
    }
}
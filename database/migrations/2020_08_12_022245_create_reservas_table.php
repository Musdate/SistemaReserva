<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasTable extends Migration{

    public function up(){

        Schema::create('reservas', function (Blueprint $table){
            $table->id();
            $table->string('rutUsuario')->index();
            $table->string('codigoLab')->index();
            $table->string('moduloReservado', 20);
            $table->timestamps();

            //Relaciones
            $table->foreign('rutUsuario')->references('rut')->on('users');
            $table->foreign('codigoLab')->references('codigoLab')->on('laboratorios');
            
        });
    }

    public function down(){

        Schema::dropIfExists('reservas');
    }
}
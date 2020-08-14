<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasTable extends Migration{

    public function up(){

        Schema::create('reservas', function (Blueprint $table){
            $table->string('codigoReserva')->unique();
            $table->string('rutUsuario')->index();
            $table->string('rutEncargado')->index();
            $table->string('codigoLab')->index();
            $table->string('modulosReservados', 20);
            $table->timestamps();

            //Clave primaria
            $table->primary('codigoReserva');

            //Relaciones
            $table->foreign('rutUsuario')->references('rut')->on('users');
            $table->foreign('rutEncargado')->references('rut')->on('users');
            $table->foreign('codigoLab')->references('codigoLab')->on('laboratorios');
            
        });
    }

    public function down(){

        Schema::dropIfExists('reservas');
    }
}
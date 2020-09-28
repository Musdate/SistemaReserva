<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModulosReservadosTable extends Migration{

    public function up(){

        Schema::create('modulos_reservados', function (Blueprint $table) {
            $table->id()->unique();
            $table->bigInteger('idReserva')->unsigned();
            $table->string('codigoLab')->index();
            $table->string('moduloReservado', 20);
            $table->date('fecha', 20);
            $table->timestamps();

            //Relaciones
            $table->foreign('codigoLab')->references('codigoLab')->on('laboratorios');
            $table->foreign('idReserva')->references('id')->on('reservas')->onDelete('cascade'); 
        });
    }

    public function down(){

        Schema::dropIfExists('modulos_reservados');
    }
}
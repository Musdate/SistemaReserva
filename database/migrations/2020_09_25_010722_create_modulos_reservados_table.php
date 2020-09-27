<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModulosReservadosTable extends Migration{

    public function up(){

        Schema::create('modulos_reservados', function (Blueprint $table) {
            $table->id();
            $table->integer('idReserva')->index();
            $table->string('codigoLab')->index();
            $table->string('moduloReservado', 20);
            $table->date('fecha', 20);
            $table->timestamps();
            
        });
    }

    public function down(){

        Schema::dropIfExists('modulos_reservados');
    }
}
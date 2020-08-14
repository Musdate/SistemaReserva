<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventoTable extends Migration{

    public function up(){

        Schema::create('evento', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('descripcion');
            $table->date('fecha');
            $table->timestamps();
        });
    }

    public function down(){

        Schema::dropIfExists('evento');
    }
}
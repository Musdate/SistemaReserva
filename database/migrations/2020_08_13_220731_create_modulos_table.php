<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModulosTable extends Migration{

    public function up(){

        Schema::create('modulos', function (Blueprint $table){
            $table->string('numeroModulo');
            $table->string('horarioModulo');
        });
    }

    public function down(){

        Schema::dropIfExists('modulos');
    }
}
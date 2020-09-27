<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModuloReservado extends Model{

    public $table = "modulos_reservados";

    protected $fillable = ['idReserva', 'codigoLab', 'moduloReservado', 'fecha', ];
}

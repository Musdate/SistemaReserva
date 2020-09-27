<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model{

    protected $fillable = ['rutUsuario','codigoLab', 'motivoReserva', 'moduloReservado', 'fechaInicio', 'fechaFin', ];
}
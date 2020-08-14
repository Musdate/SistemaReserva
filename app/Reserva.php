<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model{

    protected $fillable = ['codigoReserva','rutUsuario','rutEncargado','codigoLab', 'modulosReservados'];
}

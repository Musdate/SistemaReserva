<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laboratorio extends Model{

    protected $fillable = ['codigoLab','nombreSala','capacidadMax','tipoLab'];

    protected $primaryKey = 'codigoLab';

    protected $casts = ['codigoLab' => 'string', ];
    
    public $timestamps = false;

    public static function findByCode($codigoLab){

        return static::where(compact('codigoLab'))->first();
    }
}
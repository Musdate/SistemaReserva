<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable{

    use Notifiable;

    protected $fillable = ['tipoUsuarioID', 'rut', 'nombre', 'email', 'password', 'telefono', ];

    protected $hidden = ['password', 'remember_token', ];

    protected $casts = ['email_verified_at' => 'datetime', ];

    public $timestamps = false;

    public static function findByRut($rut){

        return static::where(compact('rut'))->first();
    }
}

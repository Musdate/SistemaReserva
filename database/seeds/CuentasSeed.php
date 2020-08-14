<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CuentasSeed extends Seeder{

    public function run(){

        //Seed cuenta Admin
        DB::table('users')->insert([
            'tipoUsuarioID' => '0',
            'rut' => '19000000',
            'nombre' => 'nombreAdmin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('1234'),
            'telefono' => '953000000',
            'remember_token' => Str::random(10),
        ]);

        //Seed cuentas encargados
        DB::table('users')->insert([
            'tipoUsuarioID' => '1',
            'rut' => '19000001',
            'nombre' => 'nombreEncargado1',
            'email' => 'encargado1@gmail.com',
            'password' => Hash::make('1234'),
            'telefono' => '953000001',
            'remember_token' => Str::random(10),
        ]);

        DB::table('users')->insert([
            'tipoUsuarioID' => '1',
            'rut' => '19000002',
            'nombre' => 'nombreEncargado2',
            'email' => 'encargado2@gmail.com',
            'password' => Hash::make('1234'),
            'telefono' => '953000002',
            'remember_token' => Str::random(10),
        ]);

        //Seed cuentas usuarios
        factory(User::class, 10)->create();
    }
}
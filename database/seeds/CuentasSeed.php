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
            'nombre' => 'Nombre Admin',
            'telefono' => '953000000',
            'rol' => 'Profesor',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('1234'),
            'remember_token' => Str::random(10),
        ]);

        //Seed cuentas encargados
        DB::table('users')->insert([
            'tipoUsuarioID' => '1',
            'rut' => '19000001',
            'nombre' => 'Nombre Encargado1',
            'telefono' => '953000001',
            'rol' => 'Encargado de Laboratorio',
            'email' => 'encargado1@gmail.com',
            'password' => Hash::make('1234'),
            'remember_token' => Str::random(10),
        ]);

        DB::table('users')->insert([
            'tipoUsuarioID' => '1',
            'rut' => '19000002',
            'nombre' => 'Nombre Encargado2',
            'email' => 'encargado2@gmail.com',
            'telefono' => '953000002',
            'rol' => 'Encargado de Laboratorio',
            'password' => Hash::make('1234'),
            'remember_token' => Str::random(10),
        ]);

        DB::table('users')->insert([
            'tipoUsuarioID' => '2',
            'rut' => '19000003',
            'nombre' => 'Nombre Usuario1',
            'email' => 'usuario1@gmail.com',
            'telefono' => '953000003',
            'rol' => 'Estudiante',
            'password' => Hash::make('1234'),
            'remember_token' => Str::random(10),
        ]);

        DB::table('users')->insert([
            'tipoUsuarioID' => '2',
            'rut' => '19000004',
            'nombre' => 'Nombre Usuario2',
            'email' => 'usuario2@gmail.com',
            'telefono' => '953000003',
            'rol' => 'Profesor',
            'password' => Hash::make('1234'),
            'remember_token' => Str::random(10),
        ]);

        //Seed cuentas usuarios
        factory(User::class, 30)->create();
    }
}
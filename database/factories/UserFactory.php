<?php

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(User::class, function (Faker $faker){
    return [
        'tipoUsuarioID' => '2',
        'rut' => $faker->randomNumber(8,true),
        'nombre' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => Hash::make('1234'),
        'telefono' => $faker->randomNumber(9,true),
        'remember_token' => Str::random(10),
    ];
});

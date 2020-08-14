<?php

use Illuminate\Support\Facades\Route;

//Ruta Inicial
Route::get('/', function () {
    return view('welcome');
});

//Rutas Laboratorios
Route::get('/Laboratorios', 'LabController@index');
Route::get('/AgregarLaboratorio', 'LabController@create');
Route::post('/AgregarLaboratorio', 'LabController@store');
Route::get('/EliminarLaboratorio/{lab}', 'LabController@delete')->name('laboratorio.delete.route');
Route::get('/EditarLaboratorio/{lab}', 'LabController@details')->name('laboratorio.details.route');
Route::put('/EditarLaboratorio/{lab}', 'LabController@update')->name('laboratorio.update.route');
Route::get('/DetallesLaboratorio/{lab}', 'LabController@show')->name('laboratorio.show.route');

//Rutas Encargados
Route::get('/Encargados', 'UserController@showEncargados');
Route::get('/AgregarEncargado', 'UserController@createEncargado');
Route::post('/AgregarEncargado', 'UserController@storeEncargado');
Route::get('/EliminarEncargado{user}', 'UserController@deleteEncargado')->name('encargado.delete.route');
Route::get('/EditarEncargado/{user}', 'UserController@detailsEncargado')->name('encargado.details.route');
Route::put('/EditarEncargado/{user}', 'UserController@updateEncargado')->name('encargado.update.route');


//Rutas Usuarios
Route::get('/Usuarios', 'UserController@showUsers');
Route::get('/AgregarUsuario', 'UserController@createUser');
Route::post('/AgregarUsuario', 'UserController@storeUser');
Route::get('/EliminarUsuario/{user}', 'UserController@deleteUser')->name('user.delete.route');
Route::get('/EditarUsuario/{user}', 'UserController@detailsUser')->name('user.details.route');
Route::put('/EditarUsuario/{user}', 'UserController@updateUser')->name('user.update.route');

//Rutas Admins
Route::get('/Admins', 'UserController@showAdmins');
Route::get('/AgregarAdmin', 'UserController@createAdmin');
Route::post('/AgregarAdmin', 'UserController@storeAdmin');
Route::get('/EliminarAdmin/{user}', 'UserController@deleteAdmin')->name('admin.delete.route');
Route::get('/EditarAdmin/{user}', 'UserController@detailsAdmin')->name('admin.details.route');
Route::put('/EditarAdmin/{user}', 'UserController@updateAdmin')->name('admin.update.route');

//Rutas Reservas
//Route::post('/ReservarModulos/{user1}/{user2}/{lab}', 'ReservaController@reservarModulos');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
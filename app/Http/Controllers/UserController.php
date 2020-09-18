<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller{

    //Controladores del Usuario
    public function showUsers(){

        $users = DB::table('users')->get();

        return view('user.listado', compact('users'));
    }

    public function createUser(){

        return view('user.agregar');
    }

    public function storeUser(){

        $data = request()->validate([
            'tipoUsuarioID' => '',
            'rut'           => 'required',
            'nombre'        => 'required',
            'rol'           => 'required',
            'email'         => 'required|email',
            'password'      => 'required',
            'telefono'      => 'required'            
        ]);

        User::create([
            'tipoUsuarioID' => '2',
            'rut'           => $data['rut'],
            'nombre'        => $data['nombre'],
            'rol'           => $data['rol'],
            'email'         => $data['email'],
            'password'      => Hash::make($data['password']),
            'telefono'      => $data['telefono']   
        ]);

        return back()->with('mensaje', 'Se ha añadido un nuevo Usuario');
    }

    public function deleteUser($rut){

        $user = User::findByRut($rut);
        $user->delete();

        $users = DB::table('users')->get();

        return view('user.listado', compact('users'));
    }

    public function detailsUser($rut){

        $user = User::findByRut($rut);

        return view('user.editar', compact('user'));
    }
    
    public function updateUser($rut){

        $user = User::findByRut($rut);

        $mensaje = 'Se ha actualizado correctamente';
        
        $data = request()->validate([
            'rut'       => 'required',
            'nombre'    => 'required',
            'rol'       => 'required',
            'email'     => 'required|email',
            'password'  => 'required',
            'telefono'  => 'required'            
        ]);

        $user->update($data);

        return back()->with(compact('user', 'mensaje'));
    }

    //Controladores del Encargado
    public function showEncargados(){

        $users = DB::table('users')->get();

        return view('encargado.listado', compact('users'));
    }

    public function createEncargado(){

        return view('encargado.agregar');
    }

    public function storeEncargado(){

        $data = request()->validate([
            'tipoUsuarioID' => '',
            'rut'           => 'required',
            'nombre'        => 'required',
            'rol'           => 'required',
            'email'         => 'required|email',
            'password'      => 'required',
            'telefono'      => 'required'            
        ]);

        User::create([
            'tipoUsuarioID' => '1',
            'rut'           => $data['rut'],
            'nombre'        => $data['nombre'],
            'rol'           => $data['rol'],
            'email'         => $data['email'],
            'password'      => Hash::make($data['password']),
            'telefono'      => $data['telefono']   
        ]);

        return back()->with('mensaje', 'Se ha añadido un nuevo Encargado');
    }

    public function deleteEncargado($rut){

        $user = User::findByRut($rut);
        $user->delete();

        $users = DB::table('users')->get();

        return view('encargado.listado', compact('users'));
    }

    public function detailsEncargado($rut){

        $user = User::findByRut($rut);

        return view('encargado.editar', compact('user'));
    }
    
    public function updateEncargado($rut){

        $user = User::findByRut($rut);

        $mensaje = 'Se ha actualizado correctamente';
        
        $data = request()->validate([
            'rut'       => 'required',
            'nombre'    => 'required',
            'rol'       => 'required',
            'email'     => 'required|email',
            'password'  => 'required',
            'telefono'  => 'required'            
        ]);

        $user->update($data);

        return back()->with(compact('user', 'mensaje'));
    }

    //Controladores del Admin
    public function showAdmins(){

        $users = DB::table('users')->get();

        return view('admin.listado', compact('users'));
    }

    public function createAdmin(){

        return view('admin.agregar');
    }

    public function storeAdmin(){

        $data = request()->validate([
            'tipoUsuarioID' => '',
            'rut'           => 'required',
            'nombre'        => 'required',
            'rol'           => 'required',
            'email'         => 'required|email',
            'password'      => 'required',
            'telefono'      => 'required'            
        ]);

        User::create([
            'tipoUsuarioID' => '0',
            'rut'           => $data['rut'],
            'nombre'        => $data['nombre'],
            'rol'           => $data['rol'],
            'email'         => $data['email'],
            'password'      => Hash::make($data['password']),
            'telefono'      => $data['telefono']   
        ]);

        return back()->with('mensaje', 'Se ha añadido un nuevo Admin');
    }

    public function deleteAdmin($rut){

        $user = User::findByRut($rut);
        $user->delete();

        $users = DB::table('users')->get();

        return view('admin.listado', compact('users'));
    }

    public function detailsAdmin($rut){

        $user = User::findByRut($rut);

        return view('admin.editar', compact('user'));
    }
    
    public function updateAdmin($rut){

        $user = User::findByRut($rut);

        $mensaje = 'Se ha actualizado correctamente';
        
        $data = request()->validate([
            'rut'       => 'required',
            'nombre'    => 'required',
            'rol'       => 'required',
            'email'     => 'required|email',
            'password'  => 'required',
            'telefono'  => 'required'            
        ]);

        $user->update($data);

        return back()->with(compact('user', 'mensaje'));
    }
}
<?php

namespace App\Http\Controllers;

use App\Laboratorio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LabController extends Controller{
    
    public function index(){
        $labs = DB::table('laboratorios')->get();

        return view('laboratorio.listado', compact('labs'));
    }

    public function create(){

        return view('laboratorio.agregar');
    }

    public function store(){

        $data = request()->validate([
            'codigoLab' => 'required',
            'nombreSala' => 'required',
            'capacidadMax' => 'required',
            'tipoLab' => 'required'
        ]);

        Laboratorio::create([
            'codigoLab' => $data['codigoLab'],
            'nombreSala' => $data['nombreSala'],
            'capacidadMax' => $data['capacidadMax'],
            'tipoLab' => $data['tipoLab']
        ]);

        return back()->with('mensaje', 'Se ha añadido un nuevo Laboratorio');
    }

    public function delete($codigoLab){

        $lab = Laboratorio::findByCode($codigoLab);
        $lab->delete();

        $labs = DB::table('laboratorios')->get();

        return view('laboratorio.listado', compact('labs'));
    }

    public function details($codigoLab){

        $lab = Laboratorio::findByCode($codigoLab);

        return view('laboratorio.editar', compact('lab'));
    }
    
    public function update($codigoLab){

        $lab = Laboratorio::findByCode($codigoLab);

        $mensaje = 'Se ha actualizado correctamente';
        
        $data = request()->validate([
            'codigoLab' => 'required',
            'nombreSala' => 'required',
            'capacidadMax' => 'required',
            'tipoLab' => 'required'           
        ]);

        $lab->update($data);

        return back()->with(compact('lab', 'mensaje'));
    }

    public function show($codigoLab){

        $lab = Laboratorio::findByCode($codigoLab);

        return view('laboratorio.detalles', compact('lab'));
    }
}
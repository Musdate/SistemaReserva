<?php

namespace App\Http\Controllers;

use App\Reserva;
use Carbon\Carbon;
use App\ModuloReservado;
use App\Mail\AvisoDeEliminacion; 
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservaController extends Controller{

  // ==================== RESERVAS ====================

  public function index_listado(){

      $reservas = DB::table('reservas')->get();
      $users = DB::table('users')->get();

      return view('reserva.listado', compact('reservas', 'users'));
  }

  public function form(){
    
    $labs = DB::table('laboratorios')->get();

    return view("evento.form", compact('labs'));
  }

  public function create(Request $request){

    $this->validate($request, [
      'rutUsuario'      => 'required',
      'codigoLab'       => 'required',
      'motivoReserva'   => '',
      'moduloReservado' => 'required',
      'semanaReservada' => 'required',
      'fechaInicio'     => 'required',
      'fechaFin'        => 'required',
      'checkAtomico'    => '',
      'checkReserva'    => '',
    ]);

    $rutUsuario       = $request->input("rutUsuario");
    $codigoLab        = $request->input("codigoLab");
    $motivoReserva    = $request->input("motivoReserva");
    $moduloReservado  = implode(",", $request->input("moduloReservado"));
    $semanaReservada  = implode(",", $request->input("semanaReservada"));
    $fechaInicio      = $request->input("fechaInicio");
    $fechaFin         = $request->input("fechaFin");
    $arrayModulos     = $request->input("moduloReservado");
    $arraySemanas     = $request->input("semanaReservada");
    $checkAtomico     = $request->input("checkAtomico");
    $checkReserva     = $request->input("checkReserva");
    $labs = DB::table('laboratorios')->get();

    $verificador = $this->verificarReserva($codigoLab, $arrayModulos, $arraySemanas, $fechaInicio, $fechaFin);

    //RESTRICCIONES DE FECHAS
    $date1 = Carbon::create($fechaInicio);
    $date2 = Carbon::create($fechaFin);
    $dias = $date1->diffInDays($date2);

    if ($fechaInicio > $fechaFin){
      return back()->with('failure', 'Por favor, Ingrese una Fecha Valida.');
    }
    elseif (Carbon::now('-03:00')->subDays(3) > $fechaInicio){
      return back()->with('failure', 'Por favor, Ingrese una Fecha Valida.');
    }
    elseif ($dias < 6){
      for ($iModulos = 0; $iModulos < count($arrayModulos); $iModulos++){
        $aux=0;
        $dateAux = Carbon::create($fechaInicio);
        for($iDias = 0; $iDias < $dias+1; $iDias++){
          if ($arrayModulos[$iModulos] > 0 && $arrayModulos[$iModulos] < 11 && $dateAux->dayOfWeek == 1){
            $aux=1;
          }
          if ($arrayModulos[$iModulos] > 10 && $arrayModulos[$iModulos] < 21 && $dateAux->dayOfWeek == 2){
            $aux=1;
          }
          if ($arrayModulos[$iModulos] > 20 && $arrayModulos[$iModulos] < 31 && $dateAux->dayOfWeek == 3){
            $aux=1;
          }
          if ($arrayModulos[$iModulos] > 30 && $arrayModulos[$iModulos] < 41 && $dateAux->dayOfWeek == 4){
            $aux=1;
          }
          if ($arrayModulos[$iModulos] > 40 && $arrayModulos[$iModulos] < 51 && $dateAux->dayOfWeek == 5){
            $aux=1;
          }
          if ($arrayModulos[$iModulos] > 50 && $arrayModulos[$iModulos] < 61 && $dateAux->dayOfWeek == 6){
            $aux=1;
          }
          if ($arrayModulos[$iModulos] > 60 && $arrayModulos[$iModulos] < 71 && $dateAux->dayOfWeek == 0){
            $aux=1;
          }
          $dateAux->addDay();
        }
        if ($aux == 0){
          return back()->with('failure', 'Por favor, Ingrese una Fecha Valida.');
        }
      }
      
    }//FIN DE RESTRICCIONES

    //SI TODOS LOS MODULOS ESTAN DISPONIBLES
    if (!$verificador[0]){

      Reserva::insert([
        'rutUsuario'      => $rutUsuario,
        'codigoLab'       => $codigoLab,
        'motivoReserva'   => $motivoReserva,
        'moduloReservado' => $moduloReservado,
        'semanaReservada' => $semanaReservada,
        'fechaInicio'     => $fechaInicio,
        'fechaFin'        => $fechaFin,
      ]);
      
      $reservaID =  Reserva::where([
                      ["rutUsuario",$rutUsuario],
                      ["codigoLab",$codigoLab],
                      ["motivoReserva",$motivoReserva],
                      ["moduloReservado",$moduloReservado],
                      ["semanaReservada",$semanaReservada],
                      ["fechaInicio",$fechaInicio],
                      ["fechaFin",$fechaFin],
                    ])->first();
  
      for ($iSem = 0; $iSem < count($arraySemanas); $iSem++){
        for ($i = 0; $i < count($arrayModulos); $i++){

          $date1 = Carbon::create($fechaInicio);
          $date2 = Carbon::create($fechaFin);
          $dias = $date1->diffInDays($date2);

          for($iDias = 0; $iDias < $dias+1; $iDias++){

            //AGREGAR MODULOS DIA LUNES
            if ($arrayModulos[$i] > 0 && $arrayModulos[$i] < 11 && $date1->dayOfWeek == 1){

              if ($arraySemanas[$iSem] == $date1->weekOfMonth){
                ModuloReservado::insert([
                  'idReserva'       => $reservaID->id,
                  'codigoLab'       => $codigoLab,
                  'moduloReservado' => $arrayModulos[$i],
                  'fecha'           => $date1,
                ]);
              }
            }
        
            //AGREGAR MODULOS DIA MARTES
            elseif ($arrayModulos[$i] > 10 && $arrayModulos[$i] < 21 && $date1->dayOfWeek == 2){

              if ($arraySemanas[$iSem] == $date1->weekOfMonth){
                ModuloReservado::insert([
                  'idReserva'       => $reservaID->id,
                  'codigoLab'       => $codigoLab,
                  'moduloReservado' => $arrayModulos[$i],
                  'fecha'           => $date1,
                ]);
              }
            }

            //AGREGAR MODULOS DIA MIERCOLES
            elseif ($arrayModulos[$i] > 20 && $arrayModulos[$i] < 31 && $date1->dayOfWeek == 3){

              if ($arraySemanas[$iSem] == $date1->weekOfMonth){
                ModuloReservado::insert([
                  'idReserva'       => $reservaID->id,
                  'codigoLab'       => $codigoLab,
                  'moduloReservado' => $arrayModulos[$i],
                  'fecha'           => $date1,
                ]);
              }
            }

            //AGREGAR MODULOS DIA JUEVES
            elseif ($arrayModulos[$i] > 30 && $arrayModulos[$i] < 41 && $date1->dayOfWeek == 4){

              if ($arraySemanas[$iSem] == $date1->weekOfMonth){
                ModuloReservado::insert([
                  'idReserva'       => $reservaID->id,
                  'codigoLab'       => $codigoLab,
                  'moduloReservado' => $arrayModulos[$i],
                  'fecha'           => $date1,
                ]);
              }
            }

            //AGREGAR MODULOS DIA VIERNES
            elseif ($arrayModulos[$i] > 40 && $arrayModulos[$i] < 51 && $date1->dayOfWeek == 5){

              if ($arraySemanas[$iSem] == $date1->weekOfMonth){
                ModuloReservado::insert([
                  'idReserva'       => $reservaID->id,
                  'codigoLab'       => $codigoLab,
                  'moduloReservado' => $arrayModulos[$i],
                  'fecha'           => $date1,
                ]);
              }
            }

            //AGREGAR MODULOS DIA SABADO
            elseif ($arrayModulos[$i] > 50 && $arrayModulos[$i] < 61 && $date1->dayOfWeek == 6){

              if ($arraySemanas[$iSem] == $date1->weekOfMonth){
                ModuloReservado::insert([
                  'idReserva'       => $reservaID->id,
                  'codigoLab'       => $codigoLab,
                  'moduloReservado' => $arrayModulos[$i],
                  'fecha'           => $date1,
                ]);
              }
            }

            //AGREGAR MODULOS DIA DOMINGO
            elseif ($arrayModulos[$i] > 60 && $arrayModulos[$i] < 71 && $date1->dayOfWeek == 0){

              if ($arraySemanas[$iSem] == $date1->weekOfMonth){
                ModuloReservado::insert([
                  'idReserva'       => $reservaID->id,
                  'codigoLab'       => $codigoLab,
                  'moduloReservado' => $arrayModulos[$i],
                  'fecha'           => $date1,
                ]);
              }
            }

            $date1->addDay();
          }
        }
      }
      return back()->with('success', 'Reserva Exitosa!');
    }
    else{
      //SI QUIERE RESERVAR SOLO DISPONIBLES
      if ($checkReserva){
        //SI TIENE ALMENOS 1 MODULO QUE RESERVAR
        if (count($verificador[1]) > 0){
          Reserva::insert([
            'rutUsuario'      => $rutUsuario,
            'codigoLab'       => $codigoLab,
            'motivoReserva'   => $motivoReserva,
            'moduloReservado' => $moduloReservado,
            'semanaReservada' => $semanaReservada,
            'fechaInicio'     => $fechaInicio,
            'fechaFin'        => $fechaFin,
          ]);
          
          $reservaID =  Reserva::where([
                          ["rutUsuario",$rutUsuario],
                          ["codigoLab",$codigoLab],
                          ["motivoReserva",$motivoReserva],
                          ["moduloReservado",$moduloReservado],
                          ["semanaReservada",$semanaReservada],
                          ["fechaInicio",$fechaInicio],
                          ["fechaFin",$fechaFin],
                        ])->first();
      
          for ($iSem = 0; $iSem < count($arraySemanas); $iSem++){
            for ($i = 0; $i < count($arrayModulos); $i++){
    
              $date1 = Carbon::create($fechaInicio);
              $date2 = Carbon::create($fechaFin);
              $dias = $date1->diffInDays($date2);
    
              for($iDias = 0; $iDias < $dias+1; $iDias++){
    
                //AGREGAR MODULOS DIA LUNES
                if ($arrayModulos[$i] > 0 && $arrayModulos[$i] < 11 && $date1->dayOfWeek == 1){
                  $auxReserva=1;
                  for ($iOcupados = 0; $iOcupados < count($verificador[0]); $iOcupados++){
                    $dateAux = Carbon::create($verificador[0][$iOcupados]->fecha);
                    if ($verificador[0][$iOcupados]->moduloReservado == $arrayModulos[$i] && $dateAux == $date1){
                      $auxReserva=0;
                    }
                  }
                  if ($auxReserva == 1){
                    if ($arraySemanas[$iSem] == $date1->weekOfMonth){
                      ModuloReservado::insert([
                        'idReserva'       => $reservaID->id,
                        'codigoLab'       => $codigoLab,
                        'moduloReservado' => $arrayModulos[$i],
                        'fecha'           => $date1,
                      ]);
                    }
                  }
                }
            
                //AGREGAR MODULOS DIA MARTES
                elseif ($arrayModulos[$i] > 10 && $arrayModulos[$i] < 21 && $date1->dayOfWeek == 2){
                  $auxReserva=1;
                  for ($iOcupados = 0; $iOcupados < count($verificador[0]); $iOcupados++){
                    $dateAux = Carbon::create($verificador[0][$iOcupados]->fecha);
                    if ($verificador[0][$iOcupados]->moduloReservado == $arrayModulos[$i] && $dateAux == $date1){
                      $auxReserva=0;
                    }
                  }
                  if ($auxReserva == 1){
                    if ($arraySemanas[$iSem] == $date1->weekOfMonth){
                      ModuloReservado::insert([
                        'idReserva'       => $reservaID->id,
                        'codigoLab'       => $codigoLab,
                        'moduloReservado' => $arrayModulos[$i],
                        'fecha'           => $date1,
                      ]);
                    }
                  }
                }
    
                //AGREGAR MODULOS DIA MIERCOLES
                elseif ($arrayModulos[$i] > 20 && $arrayModulos[$i] < 31 && $date1->dayOfWeek == 3){
                  $auxReserva=1;
                  for ($iOcupados = 0; $iOcupados < count($verificador[0]); $iOcupados++){
                    $dateAux = Carbon::create($verificador[0][$iOcupados]->fecha);
                    if ($verificador[0][$iOcupados]->moduloReservado == $arrayModulos[$i] && $dateAux == $date1){
                      $auxReserva=0;
                    }
                  }
                  if ($auxReserva == 1){
                    if ($arraySemanas[$iSem] == $date1->weekOfMonth){
                      ModuloReservado::insert([
                        'idReserva'       => $reservaID->id,
                        'codigoLab'       => $codigoLab,
                        'moduloReservado' => $arrayModulos[$i],
                        'fecha'           => $date1,
                      ]);
                    }
                  }
                }
    
                //AGREGAR MODULOS DIA JUEVES
                elseif ($arrayModulos[$i] > 30 && $arrayModulos[$i] < 41 && $date1->dayOfWeek == 4){
                  $auxReserva=1;
                  for ($iOcupados = 0; $iOcupados < count($verificador[0]); $iOcupados++){
                    $dateAux = Carbon::create($verificador[0][$iOcupados]->fecha);
                    if ($verificador[0][$iOcupados]->moduloReservado == $arrayModulos[$i] && $dateAux == $date1){
                      $auxReserva=0;
                    }
                  }
                  if ($auxReserva == 1){
                    if ($arraySemanas[$iSem] == $date1->weekOfMonth){
                      ModuloReservado::insert([
                        'idReserva'       => $reservaID->id,
                        'codigoLab'       => $codigoLab,
                        'moduloReservado' => $arrayModulos[$i],
                        'fecha'           => $date1,
                      ]);
                    }
                  }
                }
    
                //AGREGAR MODULOS DIA VIERNES
                elseif ($arrayModulos[$i] > 40 && $arrayModulos[$i] < 51 && $date1->dayOfWeek == 5){
                  $auxReserva=1;
                  for ($iOcupados = 0; $iOcupados < count($verificador[0]); $iOcupados++){
                    $dateAux = Carbon::create($verificador[0][$iOcupados]->fecha);
                    if ($verificador[0][$iOcupados]->moduloReservado == $arrayModulos[$i] && $dateAux == $date1){
                      $auxReserva=0;
                    }
                  }
                  if ($auxReserva == 1){
                    if ($arraySemanas[$iSem] == $date1->weekOfMonth){
                      ModuloReservado::insert([
                        'idReserva'       => $reservaID->id,
                        'codigoLab'       => $codigoLab,
                        'moduloReservado' => $arrayModulos[$i],
                        'fecha'           => $date1,
                      ]);
                    }
                  }
                }
    
                //AGREGAR MODULOS DIA SABADO
                elseif ($arrayModulos[$i] > 50 && $arrayModulos[$i] < 61 && $date1->dayOfWeek == 6){
                  $auxReserva=1;
                  for ($iOcupados = 0; $iOcupados < count($verificador[0]); $iOcupados++){
                    $dateAux = Carbon::create($verificador[0][$iOcupados]->fecha);
                    if ($verificador[0][$iOcupados]->moduloReservado == $arrayModulos[$i] && $dateAux == $date1){
                      $auxReserva=0;
                    }
                  }
                  if ($auxReserva == 1){
                    if ($arraySemanas[$iSem] == $date1->weekOfMonth){
                      ModuloReservado::insert([
                        'idReserva'       => $reservaID->id,
                        'codigoLab'       => $codigoLab,
                        'moduloReservado' => $arrayModulos[$i],
                        'fecha'           => $date1,
                      ]);
                    }
                  }
                }
    
                //AGREGAR MODULOS DIA DOMINGO
                elseif ($arrayModulos[$i] > 60 && $arrayModulos[$i] < 71 && $date1->dayOfWeek == 0){
                  $auxReserva=1;
                  for ($iOcupados = 0; $iOcupados < count($verificador[0]); $iOcupados++){
                    $dateAux = Carbon::create($verificador[0][$iOcupados]->fecha);
                    if ($verificador[0][$iOcupados]->moduloReservado == $arrayModulos[$i] && $dateAux == $date1){
                      $auxReserva=0;
                    }
                  }
                  if ($auxReserva == 1){
                    if ($arraySemanas[$iSem] == $date1->weekOfMonth){
                      ModuloReservado::insert([
                        'idReserva'       => $reservaID->id,
                        'codigoLab'       => $codigoLab,
                        'moduloReservado' => $arrayModulos[$i],
                        'fecha'           => $date1,
                      ]);
                    }
                  }
                }
    
                $date1->addDay();
              }
            }
          }
          $mensaje = "Reserva Exitosa!";
          $veriVariable = array();
          $modDisponibles = array();
          $datos = $request->all();
          return view("nueva", compact('mensaje', 'veriVariable', 'modDisponibles', 'datos', 'labs'));
        }
        $mensaje = "Ningun Modulo está Disponibles.";
        $veriVariable = array();
        $modDisponibles = array();
        $datos = $request->all();
        return view("nueva", compact('mensaje', 'veriVariable', 'modDisponibles', 'datos', 'labs'));
      }else{
        $datos = $request->all();
        $veriVariable = $verificador[0];
        if ($checkAtomico){
          $mensaje = array();
          $modDisponibles = count($verificador[1]);
          return view("nueva", compact('mensaje', 'veriVariable', 'modDisponibles', 'datos', 'labs'));
        }
        $mensaje = "Uno o más Módulos ya están Reservados.";
        $veriVariable = array();
        $modDisponibles = array();
        return view("nueva", compact('mensaje', 'veriVariable', 'modDisponibles', 'datos', 'labs'));
      }
    }
  }

  public function verificarReserva($codigoLab, $arrayModulos, $arraySemanas, $fechaInicio, $fechaFin){

    $checkList = array();
    $modulosDisponibles = array();

    for ($iSem = 0; $iSem < count($arraySemanas); $iSem++){
      for ($i = 0; $i < count($arrayModulos); $i++){

        $date1 = Carbon::create($fechaInicio);
        $date2 = Carbon::create($fechaFin);
        $dias = $date1->diffInDays($date2);

        for($iDias = 0; $iDias < $dias+1; $iDias++){

          //BUSCA MODULOS DIA LUNES
          if ($arrayModulos[$i] > 0 && $arrayModulos[$i] < 11 && $date1->dayOfWeek == 1){
            if ($arraySemanas[$iSem] == $date1->weekOfMonth){

              $check = ModuloReservado::where([
                ["fecha",$date1],
                ["codigoLab",$codigoLab],
                ["moduloReservado",$arrayModulos[$i]]
                ])->first();

              if ($check){
                array_push($checkList,$check);
              }
              else{
                array_push($modulosDisponibles,$arrayModulos[$i]);
              }
            }
          }

          //BUSCA MODULOS DIA MARTES
          elseif ($arrayModulos[$i] > 10 && $arrayModulos[$i] < 21 && $date1->dayOfWeek == 2){
            if ($arraySemanas[$iSem] == $date1->weekOfMonth){

              $check = ModuloReservado::where([
                ["fecha",$date1],
                ["codigoLab",$codigoLab],
                ["moduloReservado",$arrayModulos[$i]]
                ])->first();

              if ($check){
                array_push($checkList,$check);
              }
              else{
                array_push($modulosDisponibles,$arrayModulos[$i]);
              }
            }
          }

          //BUSCA MODULOS DIA MIERCOLES
          elseif ($arrayModulos[$i] > 20 && $arrayModulos[$i] < 31 && $date1->dayOfWeek == 3){
            if ($arraySemanas[$iSem] == $date1->weekOfMonth){

              $check = ModuloReservado::where([
                ["fecha",$date1],
                ["codigoLab",$codigoLab],
                ["moduloReservado",$arrayModulos[$i]]
                ])->first();

              if ($check){
                array_push($checkList,$check);
              }
              else{
                array_push($modulosDisponibles,$arrayModulos[$i]);
              }
            }
          }

          //BUSCA MODULOS DIA JUEVES
          elseif ($arrayModulos[$i] > 30 && $arrayModulos[$i] < 41 && $date1->dayOfWeek == 4){
            if ($arraySemanas[$iSem] == $date1->weekOfMonth){

              $check = ModuloReservado::where([
                ["fecha",$date1],
                ["codigoLab",$codigoLab],
                ["moduloReservado",$arrayModulos[$i]]
                ])->first();

              if ($check){
                array_push($checkList,$check);
              }
              else{
                array_push($modulosDisponibles,$arrayModulos[$i]);
              }
            }
          }

          //BUSCA MODULOS DIA VIERNES
          elseif ($arrayModulos[$i] > 40 && $arrayModulos[$i] < 51 && $date1->dayOfWeek == 5){
            if ($arraySemanas[$iSem] == $date1->weekOfMonth){

              $check = ModuloReservado::where([
                ["fecha",$date1],
                ["codigoLab",$codigoLab],
                ["moduloReservado",$arrayModulos[$i]]
                ])->first();

              if ($check){
                array_push($checkList,$check);
              }
              else{
                array_push($modulosDisponibles,$arrayModulos[$i]);
              }
            }
          }

          //BUSCA MODULOS DIA SABADO
          elseif ($arrayModulos[$i] > 50 && $arrayModulos[$i] < 61 && $date1->dayOfWeek == 6){
            if ($arraySemanas[$iSem] == $date1->weekOfMonth){

              $check = ModuloReservado::where([
                ["fecha",$date1],
                ["codigoLab",$codigoLab],
                ["moduloReservado",$arrayModulos[$i]]
                ])->first();

              if ($check){
                array_push($checkList,$check);
              }
              else{
                array_push($modulosDisponibles,$arrayModulos[$i]);
              }
            }
          }

          //BUSCA MODULOS DIA DOMINGO
          elseif ($arrayModulos[$i] > 60 && $arrayModulos[$i] < 71 && $date1->dayOfWeek == 0){
            if ($arraySemanas[$iSem] == $date1->weekOfMonth){

              $check = ModuloReservado::where([
                ["fecha",$date1],
                ["codigoLab",$codigoLab],
                ["moduloReservado",$arrayModulos[$i]]
                ])->first();

              if ($check){
                array_push($checkList,$check);
              }
              else{
                array_push($modulosDisponibles,$arrayModulos[$i]);
              }
            }
          }

          $date1->addDay();
        }
      }
    }
    $arrayReturn = array($checkList,$modulosDisponibles);
    return $arrayReturn;
  }

  public function update($id){

    $event = Reserva::find($id);

    $data = request()->validate([
      'rutUsuario'            => 'required',
      'codigoLab'             => 'required',
      'motivoReserva'         => 'required',
      'moduloReservado'       => 'required',
      'semanaReservada'       => 'required',
      'fechaInicio'           => 'required',
      'fechaFin'              => 'required',
      'intervaloFechaInicio'  => '',
      'intervaloFechaFin'     => ''
    ]);

    $modulosAgregados = array();
    for ($i = 0; $i < count($data['moduloReservado']); $i++){
      if ( !in_array($data['moduloReservado'][$i], explode(',',$event->moduloReservado))){
        array_push($modulosAgregados, $data['moduloReservado'][$i]);
      }
    }
    $modulosEliminados = array();
    for ($i = 0; $i < count(explode(',',$event->moduloReservado)); $i++){
      if ( !in_array(explode(',',$event->moduloReservado)[$i],$data['moduloReservado'])){
        array_push($modulosEliminados, explode(',',$event->moduloReservado)[$i]);
      }
    }

    //Si traslada toda la fecha para atras
    if ($data['fechaInicio'] < $event->fechaInicio && $data['fechaFin'] < $event->fechaInicio && $data['fechaInicio'] < $data['fechaFin']){
      $verificador = $this->verificarReserva($data['codigoLab'], $data['moduloReservado'], $data['semanaReservada'], $data['fechaInicio'], $data['fechaFin']);
      if($verificador[0]) return back()->with('failure', 'Uno o más Módulos ya están Reservados.');

      //Eliminar modulos antiguos
      if ($event->moduloReservado){
        for ($i = 0; $i < count(explode(',',$event->moduloReservado)); $i++){
          $buscaModulos = ModuloReservado::where([
            ["idReserva",$id],
            ["moduloReservado",explode(',',$event->moduloReservado)[$i]]
            ])->get();
          foreach ($buscaModulos as $buscaModulo){
            $buscaModulo->delete();
          }
        }
      }

      //Agregar modulos nuevos
      if ($data['moduloReservado']){

        for ($iSem = 0; $iSem < count($data['semanaReservada']); $iSem++){
          for ($i = 0; $i < count($data['moduloReservado']); $i++){

            $date1 = Carbon::create($data['fechaInicio']);
            $date2 = Carbon::create($data['fechaFin']);
            $dias = $date1->diffInDays($date2);

            for($iDias = 0; $iDias < $dias+1; $iDias++){

              //AGREGAR MODULOS DIA LUNES
              if ($data['moduloReservado'][$i] > 0 && $data['moduloReservado'][$i] < 11 && $date1->dayOfWeek == 1){

                if ($data['semanaReservada'][$iSem] == $date1->weekOfMonth){
                  ModuloReservado::insert([
                    'idReserva'       => $id,
                    'codigoLab'       => $data['codigoLab'],
                    'moduloReservado' => $data['moduloReservado'][$i],
                    'fecha'           => $date1,
                  ]);
                }
              }
          
              //AGREGAR MODULOS DIA MARTES
              elseif ($data['moduloReservado'][$i] > 10 && $data['moduloReservado'][$i] < 21 && $date1->dayOfWeek == 2){

                if ($data['semanaReservada'][$iSem] == $date1->weekOfMonth){
                  ModuloReservado::insert([
                    'idReserva'       => $id,
                    'codigoLab'       => $data['codigoLab'],
                    'moduloReservado' => $data['moduloReservado'][$i],
                    'fecha'           => $date1,
                  ]);
                }
              }

              //AGREGAR MODULOS DIA MIERCOLES
              elseif ($data['moduloReservado'][$i] > 20 && $data['moduloReservado'][$i] < 31 && $date1->dayOfWeek == 3){

                if ($data['semanaReservada'][$iSem] == $date1->weekOfMonth){
                  ModuloReservado::insert([
                    'idReserva'       => $id,
                    'codigoLab'       => $data['codigoLab'],
                    'moduloReservado' => $data['moduloReservado'][$i],
                    'fecha'           => $date1,
                  ]);
                }
              }

              //AGREGAR MODULOS DIA JUEVES
              elseif ($data['moduloReservado'][$i] > 30 && $data['moduloReservado'][$i] < 41 && $date1->dayOfWeek == 4){

                if ($data['semanaReservada'][$iSem] == $date1->weekOfMonth){
                  ModuloReservado::insert([
                    'idReserva'       => $id,
                    'codigoLab'       => $data['codigoLab'],
                    'moduloReservado' => $data['moduloReservado'][$i],
                    'fecha'           => $date1,
                  ]);
                }
              }

              //AGREGAR MODULOS DIA VIERNES
              elseif ($data['moduloReservado'][$i] > 40 && $data['moduloReservado'][$i] < 51 && $date1->dayOfWeek == 5){

                if ($data['semanaReservada'][$iSem] == $date1->weekOfMonth){
                  ModuloReservado::insert([
                    'idReserva'       => $id,
                    'codigoLab'       => $data['codigoLab'],
                    'moduloReservado' => $data['moduloReservado'][$i],
                    'fecha'           => $date1,
                  ]);
                }
              }

              //AGREGAR MODULOS DIA SABADO
              elseif ($data['moduloReservado'][$i] > 50 && $data['moduloReservado'][$i] < 61 && $date1->dayOfWeek == 6){

                if ($data['semanaReservada'][$iSem] == $date1->weekOfMonth){
                  ModuloReservado::insert([
                    'idReserva'       => $id,
                    'codigoLab'       => $data['codigoLab'],
                    'moduloReservado' => $data['moduloReservado'][$i],
                    'fecha'           => $date1,
                  ]);
                }
              }

              //AGREGAR MODULOS DIA DOMINGO
              elseif ($data['moduloReservado'][$i] > 60 && $data['moduloReservado'][$i] < 71 && $date1->dayOfWeek == 0){

                if ($data['semanaReservada'][$iSem] == $date1->weekOfMonth){
                  ModuloReservado::insert([
                    'idReserva'       => $id,
                    'codigoLab'       => $data['codigoLab'],
                    'moduloReservado' => $data['moduloReservado'][$i],
                    'fecha'           => $date1,
                  ]);
                }
              }

              $date1->addDay();
            }
          }
        }
      }

      //Si elimina intervalo de fechas
      if ($data['intervaloFechaInicio'] && $data['intervaloFechaFin']){
        if (($data['fechaInicio'] <= $data['intervaloFechaInicio']) && (($data['fechaFin'] >= $data['intervaloFechaFin']))){
          $date1 = Carbon::create($data['intervaloFechaInicio']);
          $date2 = Carbon::create($data['intervaloFechaFin']);
          $dias = $date1->diffInDays($date2);
          for ($i = 0; $i < $dias+1; $i++){
            $buscaModulos = ModuloReservado::where([
              ["idReserva",$id],
              ["fecha",$date1]
              ])->get();
            foreach ($buscaModulos as $buscaModulo){
              $buscaModulo->delete();
            }
            $date1->addDay();
          }
        }
      }

    }
    //Si traslada toda la fecha para adelante
    elseif ($data['fechaFin'] > $event->fechaFin && $data['fechaInicio'] > $event->fechaFin && $data['fechaFin'] > $data['fechaInicio']){
      $verificador = $this->verificarReserva($data['codigoLab'], $data['moduloReservado'], $data['semanaReservada'], $data['fechaInicio'], $data['fechaFin']);
      if($verificador[0]) return back()->with('failure', 'Uno o más Módulos ya están Reservados.');

      //Eliminar modulos antiguos
      if ($event->moduloReservado){
        for ($i = 0; $i < count(explode(',',$event->moduloReservado)); $i++){
          $buscaModulos = ModuloReservado::where([
            ["idReserva",$id],
            ["moduloReservado",explode(',',$event->moduloReservado)[$i]]
            ])->get();
          foreach ($buscaModulos as $buscaModulo){
            $buscaModulo->delete();
          }
        }
      }

      //Agregar modulos nuevos
      if ($data['moduloReservado']){

        for ($iSem = 0; $iSem < count($data['semanaReservada']); $iSem++){
          for ($i = 0; $i < count($data['moduloReservado']); $i++){

            $date1 = Carbon::create($data['fechaInicio']);
            $date2 = Carbon::create($data['fechaFin']);
            $dias = $date1->diffInDays($date2);

            for($iDias = 0; $iDias < $dias+1; $iDias++){

              //AGREGAR MODULOS DIA LUNES
              if ($data['moduloReservado'][$i] > 0 && $data['moduloReservado'][$i] < 11 && $date1->dayOfWeek == 1){

                if ($data['semanaReservada'][$iSem] == $date1->weekOfMonth){
                  ModuloReservado::insert([
                    'idReserva'       => $id,
                    'codigoLab'       => $data['codigoLab'],
                    'moduloReservado' => $data['moduloReservado'][$i],
                    'fecha'           => $date1,
                  ]);
                }
              }
          
              //AGREGAR MODULOS DIA MARTES
              elseif ($data['moduloReservado'][$i] > 10 && $data['moduloReservado'][$i] < 21 && $date1->dayOfWeek == 2){

                if ($data['semanaReservada'][$iSem] == $date1->weekOfMonth){
                  ModuloReservado::insert([
                    'idReserva'       => $id,
                    'codigoLab'       => $data['codigoLab'],
                    'moduloReservado' => $data['moduloReservado'][$i],
                    'fecha'           => $date1,
                  ]);
                }
              }

              //AGREGAR MODULOS DIA MIERCOLES
              elseif ($data['moduloReservado'][$i] > 20 && $data['moduloReservado'][$i] < 31 && $date1->dayOfWeek == 3){

                if ($data['semanaReservada'][$iSem] == $date1->weekOfMonth){
                  ModuloReservado::insert([
                    'idReserva'       => $id,
                    'codigoLab'       => $data['codigoLab'],
                    'moduloReservado' => $data['moduloReservado'][$i],
                    'fecha'           => $date1,
                  ]);
                }
              }

              //AGREGAR MODULOS DIA JUEVES
              elseif ($data['moduloReservado'][$i] > 30 && $data['moduloReservado'][$i] < 41 && $date1->dayOfWeek == 4){

                if ($data['semanaReservada'][$iSem] == $date1->weekOfMonth){
                  ModuloReservado::insert([
                    'idReserva'       => $id,
                    'codigoLab'       => $data['codigoLab'],
                    'moduloReservado' => $data['moduloReservado'][$i],
                    'fecha'           => $date1,
                  ]);
                }
              }

              //AGREGAR MODULOS DIA VIERNES
              elseif ($data['moduloReservado'][$i] > 40 && $data['moduloReservado'][$i] < 51 && $date1->dayOfWeek == 5){

                if ($data['semanaReservada'][$iSem] == $date1->weekOfMonth){
                  ModuloReservado::insert([
                    'idReserva'       => $id,
                    'codigoLab'       => $data['codigoLab'],
                    'moduloReservado' => $data['moduloReservado'][$i],
                    'fecha'           => $date1,
                  ]);
                }
              }

              //AGREGAR MODULOS DIA SABADO
              elseif ($data['moduloReservado'][$i] > 50 && $data['moduloReservado'][$i] < 61 && $date1->dayOfWeek == 6){

                if ($data['semanaReservada'][$iSem] == $date1->weekOfMonth){
                  ModuloReservado::insert([
                    'idReserva'       => $id,
                    'codigoLab'       => $data['codigoLab'],
                    'moduloReservado' => $data['moduloReservado'][$i],
                    'fecha'           => $date1,
                  ]);
                }
              }

              //AGREGAR MODULOS DIA DOMINGO
              elseif ($data['moduloReservado'][$i] > 60 && $data['moduloReservado'][$i] < 71 && $date1->dayOfWeek == 0){

                if ($data['semanaReservada'][$iSem] == $date1->weekOfMonth){
                  ModuloReservado::insert([
                    'idReserva'       => $id,
                    'codigoLab'       => $data['codigoLab'],
                    'moduloReservado' => $data['moduloReservado'][$i],
                    'fecha'           => $date1,
                  ]);
                }
              }

              $date1->addDay();
            }
          }
        }
      }

      //Si elimina intervalo de fechas
      if ($data['intervaloFechaInicio'] && $data['intervaloFechaFin']){
        if (($data['fechaInicio'] <= $data['intervaloFechaInicio']) && (($data['fechaFin'] >= $data['intervaloFechaFin']))){
          $date1 = Carbon::create($data['intervaloFechaInicio']);
          $date2 = Carbon::create($data['intervaloFechaFin']);
          $dias = $date1->diffInDays($date2);
          for ($i = 0; $i < $dias+1; $i++){
            $buscaModulos = ModuloReservado::where([
              ["idReserva",$id],
              ["fecha",$date1]
              ])->get();
            foreach ($buscaModulos as $buscaModulo){
              $buscaModulo->delete();
            }
            $date1->addDay();
          }
        }
      }

    }
    else{
      //Verificaciones
      if ($data['fechaInicio'] < $event->fechaInicio){
        $dateAux = Carbon::create($event->fechaInicio);
        $dateAux->subDay();
        $dateAux = $dateAux->format('Y-m-d');
        $verificador = $this->verificarReserva($data['codigoLab'], $data['moduloReservado'], $data['semanaReservada'], $data['fechaInicio'], $dateAux);
        if($verificador[0]) return back()->with('failure', 'Uno o más Módulos ya están Reservados.');
      }
      if ($data['fechaFin'] > $event->fechaFin){
        $dateAux = Carbon::create($event->fechaFin);
        $dateAux->addDay();
        $dateAux = $dateAux->format('Y-m-d');
        $verificador = $this->verificarReserva($data['codigoLab'], $data['moduloReservado'], $data['semanaReservada'], $dateAux, $data['fechaFin']);
        if($verificador[0]) return back()->with('failure', 'Uno o más Módulos ya están Reservados.');
      }
      if ($modulosAgregados){
        $verificador = $this->verificarReserva($data['codigoLab'], $modulosAgregados, $data['semanaReservada'], $event->fechaInicio, $event->fechaFin);
        if($verificador[0]) return back()->with('failure', 'Uno o más Módulos ya están Reservados.');
      }

      //Si elimina modulos
      if ($modulosEliminados){
        for ($i = 0; $i < count($modulosEliminados); $i++){
          $buscaModulos = ModuloReservado::where([
            ["idReserva",$id],
            ["moduloReservado",$modulosEliminados[$i]]
            ])->get();
          foreach ($buscaModulos as $buscaModulo){
            $buscaModulo->delete();
          }
        }
      }

      //Si agrega modulos
      if ($modulosAgregados){

        for ($iSem = 0; $iSem < count($data['semanaReservada']); $iSem++){
          for ($i = 0; $i < count($modulosAgregados); $i++){

            $date1 = Carbon::create($event->fechaInicio);
            $date2 = Carbon::create($event->fechaFin);
            $dias = $date1->diffInDays($date2);

            for($iDias = 0; $iDias < $dias+1; $iDias++){

              //AGREGAR MODULOS DIA LUNES
              if ($modulosAgregados[$i] > 0 && $modulosAgregados[$i] < 11 && $date1->dayOfWeek == 1){

                if ($data['semanaReservada'][$iSem] == $date1->weekOfMonth){
                  ModuloReservado::insert([
                    'idReserva'       => $id,
                    'codigoLab'       => $data['codigoLab'],
                    'moduloReservado' => $modulosAgregados[$i],
                    'fecha'           => $date1,
                  ]);
                }
              }
          
              //AGREGAR MODULOS DIA MARTES
              elseif ($modulosAgregados[$i] > 10 && $modulosAgregados[$i] < 21 && $date1->dayOfWeek == 2){

                if ($data['semanaReservada'][$iSem] == $date1->weekOfMonth){
                  ModuloReservado::insert([
                    'idReserva'       => $id,
                    'codigoLab'       => $data['codigoLab'],
                    'moduloReservado' => $modulosAgregados[$i],
                    'fecha'           => $date1,
                  ]);
                }
              }

              //AGREGAR MODULOS DIA MIERCOLES
              elseif ($modulosAgregados[$i] > 20 && $modulosAgregados[$i] < 31 && $date1->dayOfWeek == 3){

                if ($data['semanaReservada'][$iSem] == $date1->weekOfMonth){
                  ModuloReservado::insert([
                    'idReserva'       => $id,
                    'codigoLab'       => $data['codigoLab'],
                    'moduloReservado' => $modulosAgregados[$i],
                    'fecha'           => $date1,
                  ]);
                }
              }

              //AGREGAR MODULOS DIA JUEVES
              elseif ($modulosAgregados[$i] > 30 && $modulosAgregados[$i] < 41 && $date1->dayOfWeek == 4){

                if ($data['semanaReservada'][$iSem] == $date1->weekOfMonth){
                  ModuloReservado::insert([
                    'idReserva'       => $id,
                    'codigoLab'       => $data['codigoLab'],
                    'moduloReservado' => $modulosAgregados[$i],
                    'fecha'           => $date1,
                  ]);
                }
              }

              //AGREGAR MODULOS DIA VIERNES
              elseif ($modulosAgregados[$i] > 40 && $modulosAgregados[$i] < 51 && $date1->dayOfWeek == 5){

                if ($data['semanaReservada'][$iSem] == $date1->weekOfMonth){
                  ModuloReservado::insert([
                    'idReserva'       => $id,
                    'codigoLab'       => $data['codigoLab'],
                    'moduloReservado' => $modulosAgregados[$i],
                    'fecha'           => $date1,
                  ]);
                }
              }

              //AGREGAR MODULOS DIA SABADO
              elseif ($modulosAgregados[$i] > 50 && $modulosAgregados[$i] < 61 && $date1->dayOfWeek == 6){

                if ($data['semanaReservada'][$iSem] == $date1->weekOfMonth){
                  ModuloReservado::insert([
                    'idReserva'       => $id,
                    'codigoLab'       => $data['codigoLab'],
                    'moduloReservado' => $modulosAgregados[$i],
                    'fecha'           => $date1,
                  ]);
                }
              }

              //AGREGAR MODULOS DIA DOMINGO
              elseif ($modulosAgregados[$i] > 60 && $modulosAgregados[$i] < 71 && $date1->dayOfWeek == 0){

                if ($data['semanaReservada'][$iSem] == $date1->weekOfMonth){
                  ModuloReservado::insert([
                    'idReserva'       => $id,
                    'codigoLab'       => $data['codigoLab'],
                    'moduloReservado' => $modulosAgregados[$i],
                    'fecha'           => $date1,
                  ]);
                }
              }

              $date1->addDay();
            }
          }
        }
      }

      //Si aumenta el plazo reservado (FechaInicio)
      if ($data['fechaInicio'] < $event->fechaInicio){
        if (Carbon::now('-03:00')->subDays(3) > $data['fechaInicio']){
          return back()->with('failure', 'Por favor, Ingrese una Fecha Valida.');
        }

        $dateAux = Carbon::create($event->fechaInicio);
        $dateAux->subDay();
        $dateAux = $dateAux->format('Y-m-d');

        //AGREGA MODULOS
        for ($iSem = 0; $iSem < count($data['semanaReservada']); $iSem++){
          for ($i = 0; $i < count($data['moduloReservado']); $i++){

            $date1 = Carbon::create($data['fechaInicio']);
            $date2 = Carbon::create($dateAux);
            $dias = $date1->diffInDays($date2);

            for($iDias = 0; $iDias < $dias+1; $iDias++){

              //AGREGAR MODULOS DIA LUNES
              if ($data['moduloReservado'][$i] > 0 && $data['moduloReservado'][$i] < 11 && $date1->dayOfWeek == 1){

                if ($data['semanaReservada'][$iSem] == $date1->weekOfMonth){
                  ModuloReservado::insert([
                    'idReserva'       => $id,
                    'codigoLab'       => $data['codigoLab'],
                    'moduloReservado' => $data['moduloReservado'][$i],
                    'fecha'           => $date1,
                  ]);
                }
              }

              //AGREGAR MODULOS DIA MARTES
              elseif ($data['moduloReservado'][$i] > 10 && $data['moduloReservado'][$i] < 21 && $date1->dayOfWeek == 2){

                if ($data['semanaReservada'][$iSem] == $date1->weekOfMonth){
                  ModuloReservado::insert([
                    'idReserva'       => $id,
                    'codigoLab'       => $data['codigoLab'],
                    'moduloReservado' => $data['moduloReservado'][$i],
                    'fecha'           => $date1,
                  ]);
                }
              }

              //AGREGAR MODULOS DIA MIERCOLES
              elseif ($data['moduloReservado'][$i] > 20 && $data['moduloReservado'][$i] < 31 && $date1->dayOfWeek == 3){

                if ($data['semanaReservada'][$iSem] == $date1->weekOfMonth){
                  ModuloReservado::insert([
                    'idReserva'       => $id,
                    'codigoLab'       => $data['codigoLab'],
                    'moduloReservado' => $data['moduloReservado'][$i],
                    'fecha'           => $date1,
                  ]);
                }
              }

              //AGREGAR MODULOS DIA JUEVES
              elseif ($data['moduloReservado'][$i] > 30 && $data['moduloReservado'][$i] < 41 && $date1->dayOfWeek == 4){

                if ($data['semanaReservada'][$iSem] == $date1->weekOfMonth){
                  ModuloReservado::insert([
                    'idReserva'       => $id,
                    'codigoLab'       => $data['codigoLab'],
                    'moduloReservado' => $data['moduloReservado'][$i],
                    'fecha'           => $date1,
                  ]);
                }
              }

              //AGREGAR MODULOS DIA VIERNES
              elseif ($data['moduloReservado'][$i] > 40 && $data['moduloReservado'][$i] < 51 && $date1->dayOfWeek == 5){

                if ($data['semanaReservada'][$iSem] == $date1->weekOfMonth){
                  ModuloReservado::insert([
                    'idReserva'       => $id,
                    'codigoLab'       => $data['codigoLab'],
                    'moduloReservado' => $data['moduloReservado'][$i],
                    'fecha'           => $date1,
                  ]);
                }
              }

              //AGREGAR MODULOS DIA SABADO
              elseif ($data['moduloReservado'][$i] > 50 && $data['moduloReservado'][$i] < 61 && $date1->dayOfWeek == 6){

                if ($data['semanaReservada'][$iSem] == $date1->weekOfMonth){
                  ModuloReservado::insert([
                    'idReserva'       => $id,
                    'codigoLab'       => $data['codigoLab'],
                    'moduloReservado' => $data['moduloReservado'][$i],
                    'fecha'           => $date1,
                  ]);
                }
              }

              //AGREGAR MODULOS DIA DOMINGO
              elseif ($data['moduloReservado'][$i] > 60 && $data['moduloReservado'][$i] < 71 && $date1->dayOfWeek == 0){

                if ($data['semanaReservada'][$iSem] == $date1->weekOfMonth){
                  ModuloReservado::insert([
                    'idReserva'       => $id,
                    'codigoLab'       => $data['codigoLab'],
                    'moduloReservado' => $data['moduloReservado'][$i],
                    'fecha'           => $date1,
                  ]);
                }
              }

              $date1->addDay();
            }
          }
        }
      }

      //Si aumenta el plazo reservado (FechaFin)
      if ($data['fechaFin'] > $event->fechaFin){

        $dateAux = Carbon::create($event->fechaFin);
        $dateAux->addDay();
        $dateAux = $dateAux->format('Y-m-d');

        //AGREGA MODULOS
        for ($iSem = 0; $iSem < count($data['semanaReservada']); $iSem++){
          for ($i = 0; $i < count($data['moduloReservado']); $i++){

            $date1 = Carbon::create($dateAux);
            $date2 = Carbon::create($data['fechaFin']);
            $dias = $date1->diffInDays($date2);

            for($iDias = 0; $iDias < $dias+1; $iDias++){

              //AGREGAR MODULOS DIA LUNES
              if ($data['moduloReservado'][$i] > 0 && $data['moduloReservado'][$i] < 11 && $date1->dayOfWeek == 1){

                if ($data['semanaReservada'][$iSem] == $date1->weekOfMonth){
                  ModuloReservado::insert([
                    'idReserva'       => $id,
                    'codigoLab'       => $data['codigoLab'],
                    'moduloReservado' => $data['moduloReservado'][$i],
                    'fecha'           => $date1,
                  ]);
                }
              }

              //AGREGAR MODULOS DIA MARTES
              elseif ($data['moduloReservado'][$i] > 10 && $data['moduloReservado'][$i] < 21 && $date1->dayOfWeek == 2){

                if ($data['semanaReservada'][$iSem] == $date1->weekOfMonth){
                  ModuloReservado::insert([
                    'idReserva'       => $id,
                    'codigoLab'       => $data['codigoLab'],
                    'moduloReservado' => $data['moduloReservado'][$i],
                    'fecha'           => $date1,
                  ]);
                }
              }

              //AGREGAR MODULOS DIA MIERCOLES
              elseif ($data['moduloReservado'][$i] > 20 && $data['moduloReservado'][$i] < 31 && $date1->dayOfWeek == 3){

                if ($data['semanaReservada'][$iSem] == $date1->weekOfMonth){
                  ModuloReservado::insert([
                    'idReserva'       => $id,
                    'codigoLab'       => $data['codigoLab'],
                    'moduloReservado' => $data['moduloReservado'][$i],
                    'fecha'           => $date1,
                  ]);
                }
              }

              //AGREGAR MODULOS DIA JUEVES
              elseif ($data['moduloReservado'][$i] > 30 && $data['moduloReservado'][$i] < 41 && $date1->dayOfWeek == 4){

                if ($data['semanaReservada'][$iSem] == $date1->weekOfMonth){
                  ModuloReservado::insert([
                    'idReserva'       => $id,
                    'codigoLab'       => $data['codigoLab'],
                    'moduloReservado' => $data['moduloReservado'][$i],
                    'fecha'           => $date1,
                  ]);
                }
              }

              //AGREGAR MODULOS DIA VIERNES
              elseif ($data['moduloReservado'][$i] > 40 && $data['moduloReservado'][$i] < 51 && $date1->dayOfWeek == 5){

                if ($data['semanaReservada'][$iSem] == $date1->weekOfMonth){
                  ModuloReservado::insert([
                    'idReserva'       => $id,
                    'codigoLab'       => $data['codigoLab'],
                    'moduloReservado' => $data['moduloReservado'][$i],
                    'fecha'           => $date1,
                  ]);
                }
              }

              //AGREGAR MODULOS DIA SABADO
              elseif ($data['moduloReservado'][$i] > 50 && $data['moduloReservado'][$i] < 61 && $date1->dayOfWeek == 6){

                if ($data['semanaReservada'][$iSem] == $date1->weekOfMonth){
                  ModuloReservado::insert([
                    'idReserva'       => $id,
                    'codigoLab'       => $data['codigoLab'],
                    'moduloReservado' => $data['moduloReservado'][$i],
                    'fecha'           => $date1,
                  ]);
                }
              }

              //AGREGAR MODULOS DIA DOMINGO
              elseif ($data['moduloReservado'][$i] > 60 && $data['moduloReservado'][$i] < 71 && $date1->dayOfWeek == 0){

                if ($data['semanaReservada'][$iSem] == $date1->weekOfMonth){
                  ModuloReservado::insert([
                    'idReserva'       => $id,
                    'codigoLab'       => $data['codigoLab'],
                    'moduloReservado' => $data['moduloReservado'][$i],
                    'fecha'           => $date1,
                  ]);
                }
              }

              $date1->addDay();
            }
          }
        }
      }

      //Si disminuye el plazo reservado (FechaInicio)
      if ($data['fechaInicio'] > $event->fechaInicio){
        if ($data['fechaInicio'] > $data['fechaFin']){
          return back()->with('failure', 'Por favor, Ingrese una Fecha Valida.');
        }

        $date1 = Carbon::create($data['fechaInicio']);
        $date2 = Carbon::create($event->fechaInicio);
        $dias = $date1->diffInDays($date2);

        for ($i = 0; $i < $dias; $i++){
          $buscaModulos = ModuloReservado::where([
            ["idReserva",$id],
            ["fecha",$date2]
            ])->get();
          foreach ($buscaModulos as $buscaModulo){
            $buscaModulo->delete();
          }
          $date2->addDay();
        }
      }

      //Si disminuye el plazo reservado (FechaFin)
      if ($data['fechaFin'] < $event->fechaFin){
        if ($data['fechaInicio'] > $data['fechaFin']){
          return back()->with('failure', 'Por favor, Ingrese una Fecha Valida.');
        }

        $date1 = Carbon::create($event->fechaFin);
        $date2 = Carbon::create($data['fechaFin']);
        $dias = $date2->diffInDays($date1);

        for ($i = 0; $i < $dias; $i++){
          $buscaModulos = ModuloReservado::where([
            ["idReserva",$id],
            ["fecha",$date1]
            ])->get();

          foreach ($buscaModulos as $buscaModulo){
            $buscaModulo->delete();
          }
          $date1->subDay();
        }
      }

      //Si elimina intervalo de fechas
      if ($data['intervaloFechaInicio'] && $data['intervaloFechaFin']){
        if (($data['fechaInicio'] <= $data['intervaloFechaInicio']) && (($data['fechaFin'] >= $data['intervaloFechaFin']))){
          $date1 = Carbon::create($data['intervaloFechaInicio']);
          $date2 = Carbon::create($data['intervaloFechaFin']);
          $dias = $date1->diffInDays($date2);
          for ($i = 0; $i < $dias+1; $i++){
            $buscaModulos = ModuloReservado::where([
              ["idReserva",$id],
              ["fecha",$date1]
              ])->get();
            foreach ($buscaModulos as $buscaModulo){
              $buscaModulo->delete();
            }
            $date1->addDay();
          }
        }
      }

    }

    $data['semanaReservada'] = implode(",", $data['semanaReservada']);
    $data['moduloReservado'] = implode(",", $data['moduloReservado']);
    $event->update($data);
    return back()->with('success', 'Enviado exitosamente!');

  }

  public function delete($id){
    
    $reserva = Reserva::find($id);
    $reservas = DB::table('reservas')->get();
    $users = DB::table('users')->get();

    //Mail de eliminacion
    if(Auth::user()->tipoUsuarioID == '0'){
      if(Auth::user()->rut != $reserva->rutUsuario){
        Mail::to(Auth::user()->email)->queue(new AvisoDeEliminacion);
        return new AvisoDeEliminacion;
        $reserva->delete();
        return redirect('/Reservas')->with('users', 'reservas');
      }
    }
    $reserva->delete();
    return redirect('/Reservas')->with('users', 'reservas');
  }

  public function details($id){

    $event = Reserva::find($id);
    $labs = DB::table('laboratorios')->get();

    return view("evento.evento", compact('event','labs'));
  }

  // ==================== CALENDARIO ====================

  public function index(){

    $month = date("Y-m");
    $data = $this->calendar_month($month);
    $mes = $data['month'];
    // obtener mes en espanol
    $mespanish = $this->spanish_month($mes);
    $mes = $data['month'];

    return view("evento/calendario",[
      'data' => $data,
      'mes' => $mes,
      'mespanish' => $mespanish
    ]);
  }

  public function index_month($month){

    $data = $this->calendar_month($month);
    $mes = $data['month'];
    // obtener mes en espanol
    $mespanish = $this->spanish_month($mes);
    $mes = $data['month'];

    return view("evento/calendario",[
      'data' => $data,
      'mes' => $mes,
      'mespanish' => $mespanish
    ]);

  }

  public static function calendar_month($month){

    //$mes = date("Y-m");
    $mes = $month;
    //sacar el ultimo de dia del mes
    $daylast =  date("Y-m-d", strtotime("last day of ".$mes));
    //sacar el dia de dia del mes
    $fecha      =  date("Y-m-d", strtotime("first day of ".$mes));
    $daysmonth  =  date("d", strtotime($fecha));
    $montmonth  =  date("m", strtotime($fecha));
    $yearmonth  =  date("Y", strtotime($fecha));
    // sacar el lunes de la primera semana
    $nuevaFecha = mktime(0,0,0,$montmonth,$daysmonth,$yearmonth);
    $diaDeLaSemana = date("w", $nuevaFecha);
    if($diaDeLaSemana == 0){
      $diaDeLaSemana = 7;
    }
    $nuevaFecha = $nuevaFecha - ($diaDeLaSemana*24*3600); //Restar los segundos totales de los dias transcurridos de la semana
    $dateini = date ("Y-m-d",$nuevaFecha);
    //$dateini = date("Y-m-d",strtotime($dateini."+ 1 day"));
    // numero de primer semana del mes
    $semana1 = date("W",strtotime($fecha));
    // numero de ultima semana del mes
    $semana2 = date("W",strtotime($daylast));
    // semana todal del mes
    // en caso si es diciembre
    if (date("m", strtotime($mes))==12) {
        $semana = 5;
    }
    else {
      $semana = ($semana2-$semana1)+1;
    }
    if($montmonth == 1){
      if($semana1 > 1){
          $semana = $semana2 + 1;
      }
    }
    // semana todal del mes
    $datafecha = $dateini;
    $calendario = array();
    $iweek = 0;
    while ($iweek < $semana):
        $iweek++;
        //echo "Semana $iweek <br>";
        $weekdata = [];
        for ($iday=0; $iday < 7 ; $iday++){
          $datafecha = date("Y-m-d",strtotime($datafecha."+ 1 day"));
          $datanew['mes'] = date("M", strtotime($datafecha));
          $datanew['dia'] = date("d", strtotime($datafecha));
          $datanew['fecha'] = $datafecha;
          //AGREGAR CONSULTAS EVENTO
          $datanew['evento'] = ModuloReservado::where("fecha",$datafecha)->get();

          array_push($weekdata,$datanew);
        }
        $dataweek['semana'] = $iweek;
        $dataweek['datos'] = $weekdata;
        //$datafecha['horario'] = $datahorario;
        array_push($calendario,$dataweek);
    endwhile;
    $nextmonth = date("Y-M",strtotime($mes."+ 1 month"));
    $lastmonth = date("Y-M",strtotime($mes."- 1 month"));
    $month = date("M",strtotime($mes));
    $yearmonth = date("Y",strtotime($mes));
    //$month = date("M",strtotime("2019-03"));
    $data = array(
      'next' => $nextmonth,
      'month'=> $month,
      'year' => $yearmonth,
      'last' => $lastmonth,
      'calendar' => $calendario,
    );
    return $data;
  }

  public static function spanish_month($month){

    $mes = $month;
    if ($month=="Jan") {
      $mes = "Enero";
    }
    elseif ($month=="Feb")  {
      $mes = "Febrero";
    }
    elseif ($month=="Mar")  {
      $mes = "Marzo";
    }
    elseif ($month=="Apr") {
      $mes = "Abril";
    }
    elseif ($month=="May") {
      $mes = "Mayo";
    }
    elseif ($month=="Jun") {
      $mes = "Junio";
    }
    elseif ($month=="Jul") {
      $mes = "Julio";
    }
    elseif ($month=="Aug") {
      $mes = "Agosto";
    }
    elseif ($month=="Sep") {
      $mes = "Septiembre";
    }
    elseif ($month=="Oct") {
      $mes = "Octubre";
    }
    elseif ($month=="Nov") {
      $mes = "Noviembre";
    }
    elseif ($month=="Dec") {
      $mes = "Diciembre";
    }
    else {
      $mes = $month;
    }
    return $mes;
  }
}
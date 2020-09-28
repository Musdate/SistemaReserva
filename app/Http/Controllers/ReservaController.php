<?php

namespace App\Http\Controllers;

use App\Reserva;
use Carbon\Carbon;
use App\ModuloReservado;
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
    'rutUsuario'      =>  'required',
    'codigoLab'       =>  'required',
    'motivoReserva'   =>  '',
    'moduloReservado' =>  'required',
    'fechaInicio'     =>  'required',
    'fechaFin'        =>  'required'
    ]);

    $rutUsuario       = $request->input("rutUsuario");
    $codigoLab        = $request->input("codigoLab");
    $motivoReserva    = $request->input("motivoReserva");
    $moduloReservado  = implode(",", $request->input("moduloReservado"));
    $fechaInicio      = $request->input("fechaInicio");
    $fechaFin         = $request->input("fechaFin");
    $arrayModulos     = $request->input("moduloReservado");

    $verificador = $this->verificarReserva($codigoLab, $arrayModulos, $fechaInicio, $fechaFin);

    if ($verificador == "SI"){

      Reserva::insert([
        'rutUsuario'      => $rutUsuario,
        'codigoLab'       => $codigoLab,
        'motivoReserva'   => $motivoReserva,
        'moduloReservado' => $moduloReservado,
        'fechaInicio'     => $fechaInicio,
        'fechaFin'        => $fechaFin,
      ]);
      
      $reservaID =  Reserva::where([
                      ["rutUsuario",$rutUsuario],
                      ["codigoLab",$codigoLab],
                      ["motivoReserva",$motivoReserva],
                      ["moduloReservado",$moduloReservado],
                      ["fechaInicio",$fechaInicio],
                      ["fechaFin",$fechaFin],
                    ])->first();
  
      for ($i = 0; $i < count($arrayModulos); $i++){
  
        //AGREGAR MODULOS DIA LUNES
        if ($arrayModulos[$i] > 0 && $arrayModulos[$i] < 11){
  
          $date1 = Carbon::create($fechaInicio);
          $date2 = Carbon::create($fechaFin);
          $semanas = $date1->diffInWeeks($date2);
          
          ModuloReservado::insert([
          'idReserva'       => $reservaID->id,
          'codigoLab'       => $codigoLab,
          'moduloReservado' => $arrayModulos[$i],
          'fecha'           => $date1,
          ]);
  
          for($l = 0; $l < $semanas; $l++){
            ModuloReservado::insert([
              'idReserva'       => $reservaID->id,
              'codigoLab'       => $codigoLab,
              'moduloReservado' => $arrayModulos[$i],
              'fecha'           => $date1->addWeek(),
            ]);
          }
        }
  
        //AGREGAR MODULOS DIA MARTES
        if ($arrayModulos[$i] > 10 && $arrayModulos[$i] < 21){
  
          $date1 = Carbon::create($fechaInicio);
          $date2 = Carbon::create($fechaFin);
          $semanas = $date1->diffInWeeks($date2);
  
          $date1 = $date1->addDay();
          
          ModuloReservado::insert([
          'idReserva'       => $reservaID->id,
          'codigoLab'       => $codigoLab,
          'moduloReservado' => $arrayModulos[$i],
          'fecha'           => $date1,
          ]);
  
          for($l = 0; $l < $semanas; $l++){
            ModuloReservado::insert([
              'idReserva'       => $reservaID->id,
              'codigoLab'       => $codigoLab,
              'moduloReservado' => $arrayModulos[$i],
              'fecha'           => $date1->addWeek(),
            ]);
          }
        }
  
        //AGREGAR MODULOS DIA MIERCOLES
        if ($arrayModulos[$i] > 20 && $arrayModulos[$i] < 31){
  
          $date1 = Carbon::create($fechaInicio);
          $date2 = Carbon::create($fechaFin);
          $semanas = $date1->diffInWeeks($date2);
  
          $date1 = $date1->addDays(2);
          
          ModuloReservado::insert([
          'idReserva'       => $reservaID->id,
          'codigoLab'       => $codigoLab,
          'moduloReservado' => $arrayModulos[$i],
          'fecha'           => $date1,
          ]);
  
          for($l = 0; $l < $semanas; $l++){
            ModuloReservado::insert([
              'idReserva'       => $reservaID->id,
              'codigoLab'       => $codigoLab,
              'moduloReservado' => $arrayModulos[$i],
              'fecha'           => $date1->addWeek(),
            ]);
          }
        }
  
        //AGREGAR MODULOS DIA JUEVES
        if ($arrayModulos[$i] > 30 && $arrayModulos[$i] < 41){
  
          $date1 = Carbon::create($fechaInicio);
          $date2 = Carbon::create($fechaFin);
          $semanas = $date1->diffInWeeks($date2);
  
          $date1 = $date1->addDays(3);
          
          ModuloReservado::insert([
          'idReserva'       => $reservaID->id,
          'codigoLab'       => $codigoLab,
          'moduloReservado' => $arrayModulos[$i],
          'fecha'           => $date1,
          ]);
  
          for($l = 0; $l < $semanas; $l++){
            ModuloReservado::insert([
              'idReserva'       => $reservaID->id,
              'codigoLab'       => $codigoLab,
              'moduloReservado' => $arrayModulos[$i],
              'fecha'           => $date1->addWeek(),
            ]);
          }
        }
  
        //AGREGAR MODULOS DIA VIERNES
        if ($arrayModulos[$i] > 40 && $arrayModulos[$i] < 51){
  
          $date1 = Carbon::create($fechaInicio);
          $date2 = Carbon::create($fechaFin);
          $semanas = $date1->diffInWeeks($date2);
  
          $date1 = $date1->addDays(4);
          
          ModuloReservado::insert([
          'idReserva'       => $reservaID->id,
          'codigoLab'       => $codigoLab,
          'moduloReservado' => $arrayModulos[$i],
          'fecha'           => $date1,
          ]);
  
          for($l = 0; $l < $semanas; $l++){
            ModuloReservado::insert([
              'idReserva'       => $reservaID->id,
              'codigoLab'       => $codigoLab,
              'moduloReservado' => $arrayModulos[$i],
              'fecha'           => $date1->addWeek(),
            ]);
          }
        }
  
        //AGREGAR MODULOS DIA SABADO
        if ($arrayModulos[$i] > 50 && $arrayModulos[$i] < 61){
  
          $date1 = Carbon::create($fechaInicio);
          $date2 = Carbon::create($fechaFin);
          $semanas = $date1->diffInWeeks($date2);
  
          $date1 = $date1->addDays(5);
          
          ModuloReservado::insert([
          'idReserva'       => $reservaID->id,
          'codigoLab'       => $codigoLab,
          'moduloReservado' => $arrayModulos[$i],
          'fecha'           => $date1,
          ]);
  
          for($l = 0; $l < $semanas; $l++){
            ModuloReservado::insert([
              'idReserva'       => $reservaID->id,
              'codigoLab'       => $codigoLab,
              'moduloReservado' => $arrayModulos[$i],
              'fecha'           => $date1->addWeek(),
            ]);
          }
        }
  
        //AGREGAR MODULOS DIA DOMINGO
        if ($arrayModulos[$i] > 60 && $arrayModulos[$i] < 71){
  
          $date1 = Carbon::create($fechaInicio);
          $date2 = Carbon::create($fechaFin);
          $semanas = $date1->diffInWeeks($date2);
  
          $date1 = $date1->addDays(6);
  
          ModuloReservado::insert([
          'idReserva'       => $reservaID->id,
          'codigoLab'       => $codigoLab,
          'moduloReservado' => $arrayModulos[$i],
          'fecha'           => $date1,
          ]);
  
          for($l = 0; $l < $semanas; $l++){
            ModuloReservado::insert([
              'idReserva'       => $reservaID->id,
              'codigoLab'       => $codigoLab,
              'moduloReservado' => $arrayModulos[$i],
              'fecha'           => $date1->addWeek(),
            ]);
          }
        }

      }
      return back()->with('success', 'Reserva Exitosa!');
    }
    return back()->with('failure', 'Uno o más Módulos ya están Reservados.');
  }

  public function verificarReserva($codigoLab, $arrayModulos, $fechaInicio, $fechaFin){
    
    $respuesta = "SI";

    for ($i = 0; $i < count($arrayModulos); $i++){

      $date1 = Carbon::create($fechaInicio);
      $date2 = Carbon::create($fechaFin);
      $semanas = $date1->diffInWeeks($date2);

      for ($j = 0; $j < 61; $j = $j + 10){

        if ($arrayModulos[$i] > $j && $arrayModulos[$i] < $j + 11){

          $check = ModuloReservado::where([
                  ["fecha",$date1],
                  ["codigoLab",$codigoLab],
                  ["moduloReservado",$arrayModulos[$i]]
                  ])->first();

          if ($check){
            $respuesta = "NO";
            return $respuesta;
          }

          for($l = 0; $l < $semanas; $l++){
            $check = ModuloReservado::where([
              ["fecha",$date1->addWeek()],
              ["codigoLab",$codigoLab],
              ["moduloReservado",$arrayModulos[$i]]
              ])->first();
            if ($check){
              $respuesta = "NO";
              return $respuesta;
            }
          }
        }
        $date1 = $date1->addDay();
      }
    }
    return $respuesta;
  }

  public function update($id){

    $event = Reserva::find($id);

    $data = request()->validate([
      'rutUsuario'      => 'required',
      'codigoLab'       => 'required',
      'motivoReserva'   => 'required',
      'moduloReservado' => 'required',
      'fechaInicio'     => 'required',
      'fechaFin'        => 'required'           
    ]);

    $modulosAgregados = array();
    for ($i = 0; $i < count($data['moduloReservado']); $i++){
      if ( !in_array($data['moduloReservado'][$i], explode(',',$event->moduloReservado))){
        array_push($modulosAgregados, $data['moduloReservado'][$i]);
      }
    }
    $modulosEliminados = array();
    for ($i = 0; $i < count(explode(',',$event->moduloReservado)); $i++){
      if ( !in_array(explode(',',$event->moduloReservado)[$i],$data['moduloReservado'] )){
        array_push($modulosEliminados, explode(',',$event->moduloReservado)[$i]);
      }
    }

    $verificador = $this->verificarReserva($data['codigoLab'], $modulosAgregados, $data['fechaInicio'], $data['fechaFin']);

    if ($verificador == "SI"){

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

        for ($i = 0; $i < count($modulosAgregados); $i++){

          $date1 = Carbon::create($data['fechaInicio']);
          $date2 = Carbon::create($data['fechaFin']);
          $semanas = $date1->diffInWeeks($date2);
    
          for ($j = 0; $j < 61; $j = $j + 10){
    
            if ($modulosAgregados[$i] > $j && $modulosAgregados[$i] < $j + 11){

              ModuloReservado::insert([
              'idReserva'       => $id,
              'codigoLab'       => $data['codigoLab'],
              'moduloReservado' => $modulosAgregados[$i],
              'fecha'           => $date1,
              ]);

              for($l = 0; $l < $semanas; $l++){
                ModuloReservado::insert([
                  'idReserva'       => $id,
                  'codigoLab'       => $data['codigoLab'],
                  'moduloReservado' => $modulosAgregados[$i],
                  'fecha'           => $date1->addWeek(),
                ]);
              }
            }
            $date1 = $date1->addDay();
          }
        }
      }

      $data['moduloReservado'] = implode(',',$data['moduloReservado']);
      $event->update($data);
      return back()->with('success', 'Enviado exitosamente!');

    }else{
      return back()->with('failure', 'Uno o más Módulos ya están Reservados.');
    }
  }

  public function delete($id){

    $reserva = Reserva::find($id);
    $reserva->delete();

    $reservas = DB::table('reservas')->get();
    $users = DB::table('users')->get();

    return view('reserva.listado', compact('reservas', 'users'));
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
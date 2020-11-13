<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;
use App\Periodo;
use App\Sector;
use DB;
use Auth;

class RatioController extends Controller
{
    public function individual_padre(){
        $empresa = Empresa::where('user_id', Auth::user()->id)->first();
        $periodos = Periodo::where('empresa_id', $empresa->id)->get();
        return view('finanzasViews.ratios.individual_padre', [
            'periodos' => $periodos
        ]);
    }

/*------------------------------ FUNCIÓN QUE DEVUELVE LOS RATIOS INDIVIDUALES ---------------------------------*/

    public function individual($periodo_id){
        //Consultando empresa en base al usuario
        $empresa = Empresa::where('user_id', Auth::user()->id)->first();
        $sector = Sector::findOrFail($empresa->sector_id)->nombre;
        $periodos = Periodo::where('empresa_id', $empresa->id)->get();
        $periodo = Periodo::findOrFail($periodo_id);

        $rri = $this->calcular_rri($periodo, $empresa, $sector);
        $rdi = $this->calcular_rdi($periodo, $empresa, $sector);
        $rrcc = $this->calcular_rrcc($periodo, $empresa, $sector);
        $rpa = $this->calcular_rpa($periodo, $empresa, $sector);

        return view('finanzasViews.ratios.individual', [
            'periodos' => $periodos,
            'rri' => [$rri[0], $rri[1]],
            'rdi' => [$rdi[0], $rdi[1]],
            'rpa' => [$rpa[0], $rpa[1]],
            //'rrcc' => [$rrcc[0], $rrcc[1]],
        ]);
    }
    
/*-------------------------------------- FUNCIÓN PARA CALCULAR EL RRI -----------------------------------------*/

    public function calcular_rri($periodo, $empresa, $sector){   
        $inventario_promedio = $this->get_promedio($periodo, $empresa, 5);

        $costo_ventas = $this->select_from_er("costo_ventas", $periodo);

        $razon_rotacion_inventario = number_format($costo_ventas/$inventario_promedio, 2);

        $analisis = DB::select("SELECT * FROM analisis WHERE parametro_id = 5")[0]->individual;
        $analisis = str_replace("<nombre de la empresa>", $empresa->nombre, $analisis);
        $analisis = str_replace("<nombre del sector>", $sector, $analisis);
        $analisis = str_replace("<año del período>", $periodo->year, $analisis);
        $analisis = str_replace("<resultado>", $razon_rotacion_inventario, $analisis);

        return [$razon_rotacion_inventario, $analisis];
    }

/*-------------------------------------------------------------------------------------------------------------*/

/*-------------------------------------- FUNCIÓN PARA CALCULAR EL RDI -----------------------------------------*/

    public function calcular_rdi($periodo, $empresa, $sector){
        $inventario_promedio = $this->get_promedio($periodo, $empresa, 5);
        $costo_ventas = $this->select_from_er("costo_ventas", $periodo);

        $razon_dias_inventario = number_format($inventario_promedio/($costo_ventas/365));

        $analisis = DB::select("SELECT * FROM analisis WHERE parametro_id = 6")[0]->individual;
        $analisis = str_replace("<nombre de la empresa>", $empresa->nombre, $analisis);
        $analisis = str_replace("<nombre del sector>", $sector, $analisis);
        $analisis = str_replace("<año del período>", $periodo->year, $analisis);
        $analisis = str_replace("<resultado>", $razon_dias_inventario, $analisis);

        return [$razon_dias_inventario, $analisis];
    }

/*-------------------------------------------------------------------------------------------------------------*/

/*-------------------------------------- FUNCIÓN PARA CALCULAR EL RRCC -----------------------------------------*/

    public function calcular_rrcc($periodo, $empresa, $sector){
        $promedio_cuentas_cobrar = $this->get_promedio($periodo, $empresa, 9);
        $ventas_netas = $this->select_from_er("ventas_netas", $periodo);

        $rrcc = number_format($ventas_netas/$promedio_cuentas_cobrar, 2);
        $analisis = DB::select("SELECT * FROM analisis WHERE parametro_id = 7")[0]->individual;
        $analisis = str_replace("<nombre de la empresa>", $empresa->nombre, $analisis);
        $analisis = str_replace("<nombre del sector>", $sector, $analisis);
        $analisis = str_replace("<año del período>", $periodo->year, $analisis);
        $analisis = str_replace("<resultado>", $rrcc, $analisis);

        return [$rrcc, $analisis];
    }


/*-------------------------------------------------------------------------------------------------------------*/

/*-------------------------------------- FUNCIÓN PARA CALCULAR EL RPA -----------------------------------------*/

    public function calcular_rpa($periodo, $empresa, $sector){
        $utilidad_neta = $this->select_from_er("utilidad_neta", $periodo);
        $numero_acciones = $periodo->acciones;
        $rpa = number_format($utilidad_neta/$numero_acciones, 2);

        $analisis = DB::select("SELECT * FROM analisis WHERE parametro_id = 20")[0]->individual;
        $analisis = str_replace("<nombre de la empresa>", $empresa->nombre, $analisis);
        $analisis = str_replace("<nombre del sector>", $sector, $analisis);
        $analisis = str_replace("<año del periodo>", $periodo->year, $analisis);
        $analisis = str_replace("<resultado>", $rpa, $analisis);

        return [$rpa, $analisis];
    }

/*-------------------------------------------------------------------------------------------------------------*/

/*----------------------------- FUNCIÓN PARA OBTENER EL MONTO DE UNA CUENTA -----------------------------------*/

    public function get_total($periodo, $cuenta){
        $resultado = DB::select(
            "SELECT CP.total AS total FROM cuenta_sistema CS 
            JOIN vinculacion_cuenta VC ON CS.id = VC.id_cuenta_sistema 
            JOIN cuenta C ON c.id = VC.id_cuenta 
            JOIN cuenta_periodo CP ON C.id = CP.cuenta_id 
            WHERE CP.periodo_id = ? AND CS.id = ?", 
            [$periodo, $cuenta]
        );
        if(count($resultado)>0){
            return $resultado[0]->total;
        }
        return null;
    }

/*-------------------------------------------------------------------------------------------------------------*/

/*----------------------------- FUNCIÓN PARA OBTENER EL INVENTARIO PROMEDIO -----------------------------------*/

    public function get_promedio($periodo, $empresa, $cuenta){
        $periodos_anteriores = DB::Select(
            "SELECT * FROM periodo WHERE empresa_id = ? AND id < ? ORDER BY id DESC",
            [$empresa->id, $periodo->id]
        );
        $periodo_anterior = $periodo;
        if(count($periodos_anteriores) > 0){
            $periodo_anterior = $periodos_anteriores[0];
        }
        
        $inventario = $this->get_total($periodo->id, $cuenta);
        $inventario_anterior = $this->get_total($periodo_anterior->id, $cuenta);
        if($inventario_anterior == null){
            $inventario_anterior = $inventario;
        }

        return ($inventario + $inventario_anterior)/2;
    }
/*-------------------------------------------------------------------------------------------------------------*/

/*---------------------- FUNCIÓN PARA OBTENER UN VALOR DEL ESTADO DE RESULTADOS -------------------------------*/

    public function select_from_er($columna, $periodo){
        $resultado = DB::select(
            "SELECT " . $columna . " AS total FROM estado_resultado WHERE periodo_id = " . $periodo->id
        )[0]->total;

        return $resultado;
    }
/*-------------------------------------------------------------------------------------------------------------*/

/*-------------------------------------- FUNCIÓN PARA CALCULAR EL RDI -----------------------------------------*/

    

/*-------------------------------------------------------------------------------------------------------------*/
 
}

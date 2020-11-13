<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RatioController extends Controller
{
    public function analisis_individual_padre(){
        $empresa = Empresa::where('user_id', Auth::user()->id)->first();
        $periodos = Periodo::where('empresa_id', $empresa->id);
        return view('finanzasViews.ratios.individual', [
            'periodos' => $periodos
        ])
    }

    public function analisis_individual($year){
        //Consultando empresa en base al usuario
        $empresa = Empresa::where('user_id', Auth::user()->id)->first();

        //Consultando periodos en base al año y a la empresa
        $periodo = Periodo::where([
            ['year', ($year)],
            ['empresa_id', $empresa->id]
        ])->first();

        $periodo_anterior = Periodo::where([
            ['year', ($year-1)],
            ['empresa_id', $empresa->id]
        ])->first();

        //Consultando inventarios en base a los periodos
        $inventario = DB::select(
            "SELECT CP.total AS total FROM cuenta_sistema CS
            JOIN vinculacion_cuenta VC ON CS.id = VC.id_cuenta_sistema
            JOIN cuenta C ON c.id = VC.id_cuenta
            JOIN cuenta_periodo CP ON C.id = CP.cuenta_id
            WHERE CP.periodo_id = " + $periodo +
            "AND CS.id = 5"
        )->first()->total;

        $inventario_anterior = DB::select(
            "SELECT CP.total AS total FROM cuenta_sistema CS
            JOIN vinculacion_cuenta VC ON CS.id = VC.id_cuenta_sistema
            JOIN cuenta C ON C.id = VC.id_cuenta
            JOIN cuenta_periodo CP ON C.id = CP.cuenta_id
            WHERE CP.periodo_id = " + $periodo_anterior +
            "AND CS.id = 5"
        )->first()->total();

        $inventario_promedio = $inventario;
        if($inventario_anterior != null){
            $inventario_promedio = ($inventario + $inventario_anterior)/2;
        }

        $costo_ventas = DB::select(
            "SELECT costo_ventas FROM estado_resultado
            WHERE periodo_id = " + $periodo->id
        )->first()->total;

        $razon_rotacion_inventario = $costo_ventas/$inventario_promedio;

        
    }
}

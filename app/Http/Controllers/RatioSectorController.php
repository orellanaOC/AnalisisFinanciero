<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;
use App\Periodo;
use App\Sector;
use App\Razon;
use DB;
use Auth;

class RatioSectorController extends Controller
{
/*------------------------------ FUNCIÓN QUE CALCULA LOS RATIOS ---------------------------------------------*/

    public function calcular_ratios($periodo_id){
        $empresa = Empresa::where('user_id', Auth::user()->id)->first();
        $sector = Sector::findOrFail($empresa->sector_id)->nombre;
        $periodos = Periodo::where('empresa_id', $empresa->id)->get();
        $periodo = Periodo::findOrFail($periodo_id);

        $instancia = new MetodosRatioController();

        $rdc = $instancia->calcular_rdc($periodo, $empresa, $sector);
        $pa = $instancia->calcular_pa($periodo, $empresa, $sector);
        $rct = $instancia->calcular_rct($periodo, $empresa, $sector);
        $rde = $instancia->calcular_rde($periodo, $empresa, $sector);
        $rrcc = $instancia->calcular_rrcc($periodo, $empresa, $sector);
        $rpmc = $instancia->calcular_rpmc($periodo, $empresa, $sector);
        $rrcp = $instancia->calcular_rrcp($periodo, $empresa, $sector);
        $rpmp = $instancia->calcular_rpmp($periodo, $empresa, $sector);  
        $irat = $instancia->calcular_irat($periodo, $empresa, $sector);   
        $iraf = $instancia->calcular_iraf($periodo, $empresa, $sector);                
        $imb = $instancia->calcular_imb($periodo, $empresa, $sector);                
        $imo = $instancia->calcular_imo($periodo, $empresa, $sector);  
        $ge = $instancia->calcular_ge($periodo, $empresa, $sector);  
        $gp = $instancia->calcular_gp($periodo, $empresa, $sector);  
        $rep = $instancia->calcular_rep($periodo, $empresa, $sector);  
        $rcgf = $instancia->calcular_rcgf($periodo, $empresa, $sector); 
        $roe = $instancia->calcular_roe($periodo, $empresa, $sector); 
        $roa = $instancia->calcular_roa($periodo, $empresa, $sector); 
        $rsv = $instancia->calcular_rsv($periodo, $empresa, $sector); 
        $rsi = $instancia->calcular_rsi($periodo, $empresa, $sector); 

        $ratios = Razon::where('periodo_id', $periodo_id)->get();
        if(count($ratios)==0){

            DB::table('razon')->insert([
                'double'         => $rdc,
                'parametro_id'  => 1,
                'periodo_id'    => $periodo_id,
            ]);
            DB::table('razon')->insert([
                'double'         => $pa,
                'parametro_id'  => 2,
                'periodo_id'    => $periodo_id,
            ]);
            DB::table('razon')->insert([
                'double'         => $rct,
                'parametro_id'  => 3,
                'periodo_id'    => $periodo_id,
            ]);
            DB::table('razon')->insert([
                'double'         => $rde,
                'parametro_id'  => 4,
                'periodo_id'    => $periodo_id,
            ]);
            DB::table('razon')->insert([
                'double'         => $rrcc,
                'parametro_id'  => 7,
                'periodo_id'    => $periodo_id,
            ]);
            DB::table('razon')->insert([
                'double'         => $rpmc,
                'parametro_id'  => 8,
                'periodo_id'    => $periodo_id,
            ]);
            DB::table('razon')->insert([
                'double'         => $rrcp,
                'parametro_id'  => 9,
                'periodo_id'    => $periodo_id,
            ]);
            DB::table('razon')->insert([
                'double'         => $rpmp,
                'parametro_id'  => 10,
                'periodo_id'    => $periodo_id,
            ]);
            DB::table('razon')->insert([
                'double'         => $irat,
                'parametro_id'  => 11,
                'periodo_id'    => $periodo_id,
            ]);
            DB::table('razon')->insert([
                'double'         => $iraf,
                'parametro_id'  => 12,
                'periodo_id'    => $periodo_id,
            ]);
            DB::table('razon')->insert([
                'double'         => $imb,
                'parametro_id'  => 13,
                'periodo_id'    => $periodo_id,
            ]);
            DB::table('razon')->insert([
                'double'         => $imo,
                'parametro_id'  => 14,
                'periodo_id'    => $periodo_id,
            ]);
            DB::table('razon')->insert([
                'double'         => $ge,
                'parametro_id'  => 15,
                'periodo_id'    => $periodo_id,
            ]);
            DB::table('razon')->insert([
                'double'         => $gp,
                'parametro_id'  => 16,
                'periodo_id'    => $periodo_id,
            ]);
            DB::table('razon')->insert([
                'double'         => $rep,
                'parametro_id'  => 17,
                'periodo_id'    => $periodo_id,
            ]);
            DB::table('razon')->insert([
                'double'         => $rcgf,
                'parametro_id'  => 18,
                'periodo_id'    => $periodo_id,
            ]);
            DB::table('razon')->insert([
                'double'         => $roe,
                'parametro_id'  => 19,
                'periodo_id'    => $periodo_id,
            ]);
            DB::table('razon')->insert([
                'double'         => $roa,
                'parametro_id'  => 21,
                'periodo_id'    => $periodo_id,
            ]);
            DB::table('razon')->insert([
                'double'         => $rsv,
                'parametro_id'  => 22,
                'periodo_id'    => $periodo_id,
            ]);
            DB::table('razon')->insert([
                'double'         => $rsi,
                'parametro_id'  => 23,
                'periodo_id'    => $periodo_id,
            ]);
        }
        return redirect()->back();
    }

/*------------------------------------------------------------------------------------------------------------*/

/*------------------------------------------ VISTA PADRE ------------------------------------------------------*/

    public function sector_padre(){
        $empresa = Empresa::where('user_id', Auth::user()->id)->first();
        $periodos = Periodo::where('empresa_id', $empresa->id)->get();
        return view('finanzasViews.ratios.sector_padre', [
            'periodos' => $periodos,
        ]);
    }

/*------------------------------------------------------------------------------------------------------------*/

/*------------------------------ FUNCIÓN QUE DEVUELVE LOS RATIOS POR SECTOR -----------------------------------*/

    public function sector($periodo_id){
        $periodo = Periodo::findOrFail($periodo_id);
        $empresa = Empresa::findOrFail($periodo->empresa_id);
        $sector = Sector::findOrFail($empresa->sector_id);

        $ratios = DB::select(
            "SELECT R.parametro_id, R.id, P.parametro, R.double FROM razon R
            JOIN parametro P ON R.parametro_id = P.id
            WHERE periodo_id = ? ORDER BY P.id", [$periodo_id]
        );
        $promedios = DB::select(
            "SELECT AVG(R.double) FROM razon R
            JOIN periodo P ON R.periodo_id = P.id
            WHERE P.year = ? GROUP BY parametro_id ORDER BY parametro_id",
            [$periodo->year]
        );

        $empresa = Empresa::where('user_id', Auth::user()->id)->first();
        $periodos = Periodo::where('empresa_id', $empresa->id)->get();

        $calculados = false;
        if(count($ratios)>0){
            $calculados = true;
        }

        $instancia = new MetodosAnalisisController();
        $analisis = $instancia->get_analisis($ratios, $empresa->nombre, $sector->nombre, $periodo->year, $calculados);
        return view('finanzasViews.ratios.sector', [
            'periodos'      => $periodos,
            'calculados'    => $calculados,
            'periodo_id'    => $periodo_id,
            'ratios'        => $ratios,
            'promedios'     => $promedios,
            'analisis'      => $analisis
        ]);
    }
    
/*------------------------------------------------------------------------------------------------------------*/

/*-------------------------------------- FUNCIÓN PARA CALCULAR EL RRI -----------------------------------------*/
}

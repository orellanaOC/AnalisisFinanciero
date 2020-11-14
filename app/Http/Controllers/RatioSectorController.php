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

        dd($rdc, $pa, $rct, $rde, $rrcc, $rpmc, $rrcp, $rpmp, $irat, $iraf, $imb, $imo, $ge, $gp, $rep, $rcgf, $roe, $roa, $rsv, $rsi);

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
        $ratios = Razon::where('periodo_id', $periodo_id)->get();
        $empresa = Empresa::where('user_id', Auth::user()->id)->first();
        $periodos = Periodo::where('empresa_id', $empresa->id)->get();

        $calculados = false;
        if(count($ratios)>0){
            $calculados = true;
        }
        return view('finanzasViews.ratios.sector', [
            'periodos' => $periodos,
            'calculados' => $calculados,
            'periodo_id' => $periodo_id,
        ]);
    }
    
/*------------------------------------------------------------------------------------------------------------*/

/*-------------------------------------- FUNCIÓN PARA CALCULAR EL RRI -----------------------------------------*/
}

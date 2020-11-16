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

        $instancia = new MetodosRatioController();
        $rri = $instancia->calcular_rri($periodo, $empresa, $sector);
        $rdi = $instancia->calcular_rdi($periodo, $empresa, $sector);
        $rrcc = $instancia->calcular_rrcc($periodo, $empresa, $sector);
        $rpa = $instancia->calcular_rpa($periodo, $empresa, $sector);

        return view('finanzasViews.ratios.individual', [
            'periodos' => $periodos,
            'rri' => [$rri[0], $rri[1]],
            'rdi' => [$rdi[0], $rdi[1]],
            'rpa' => [$rpa[0], $rpa[1]],
            //'rrcc' => [$rrcc[0], $rrcc[1]],
        ]);
    }
/*-------------------------------------------------------------------------------------------------------------*/
    


/*-------------------------------------- FUNCIÓN PARA CALCULAR EL RDI -----------------------------------------*/

    

/*-------------------------------------------------------------------------------------------------------------*/
 
}

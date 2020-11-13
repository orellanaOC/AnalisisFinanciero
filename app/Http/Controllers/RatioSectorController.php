<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;
use App\Periodo;
use App\Sector;
use DB;
use Auth;

class RatioSectorController extends Controller
{
    public function calcular_ratios(){
         return redirect()->back();
    }

    public function sector_padre(){
        $empresa = Empresa::where('user_id', Auth::user()->id)->first();
        $periodos = Periodo::where('empresa_id', $empresa->id)->get();
        return view('finanzasViews.ratios.sector_padre', [
            'periodos' => $periodos
        ]);
    }

/*------------------------------ FUNCIÓN QUE DEVUELVE LOS RATIOS INDIVIDUALES ---------------------------------*/

    public function sector($periodo_id){
        $empresa = Empresa::where('user_id', Auth::user()->id)->first();
        $periodos = Periodo::where('empresa_id', $empresa->id)->get();
        return view('finanzasViews.ratios.sector', [
            'periodos' => $periodos
        ]);
    }
    
/*-------------------------------------- FUNCIÓN PARA CALCULAR EL RRI -----------------------------------------*/
}

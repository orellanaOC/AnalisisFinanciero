<?php

namespace App\Http\Controllers;

use App\Empresa;
use Illuminate\Http\Request;
use App\Periodo;

class PeriodoController extends Controller
{
    //
    public function index(){
        $periodos= Periodo::orderBy('id','desc')->get();

        return view('finanzasViews.periodo.index',['periodos'=>$periodos]);
    }
    public function store(Request $request){

        $periodo= new Periodo();
        $idUsuarioLogeado=auth()->user()->id;
        $empresa= Empresa::where('user_id', $idUsuarioLogeado)->first();
        $periodo->year=$request->anio;
        $periodo->empresa_id=$empresa->id;
        $periodo->save();
        return redirect()->route('periodo.index');
    }
}

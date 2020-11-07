<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CuentaSistema;
use App\Cuenta;
use App\Empresa;

class CuentaSistemaController extends Controller
{
    public function index()
    {
        $cuentas= CuentaSistema::all();

        $idUsuarioLogeado=auth()->user()->id;
        $empresa= Empresa::where('user_id', $idUsuarioLogeado)->first();
        //Cuentas de primer nivel (Que no tienen padre)
        $cuentasEmpresa=Cuenta::with('tipo')->where('empresa_id',$empresa->id)->orderBy('codigo', 'asc')->get();
        if(!($empresa->catalogo_listo)){
            return redirect()->route('catalogo_prueba');
        }
        //Vista con catalogo_listo= falso
        //dd($cuentasEmpresa);
        return view('simpleViews.empresa.cuentas', ['cuentas'=>$cuentas, 'cuentasEmpresa'=>$cuentasEmpresa,'empresa'=>$empresa]);
    }

    public function confirmarVinculacion(){
        $idUsuarioLogeado=auth()->user()->id;
        $empresa= Empresa::where('user_id', $idUsuarioLogeado)->first();
        $empresa->vinculacion_listo=TRUE;
        $empresa->save();
        return redirect()->route('home');
    }

}

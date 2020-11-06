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

        //Vista con catalogo_listo= falso
        return view('simpleViews.empresa.cuentas', ['cuentas'=>$cuentas, 'cuentasEmpresa'=>$cuentasEmpresa]);
    }
}

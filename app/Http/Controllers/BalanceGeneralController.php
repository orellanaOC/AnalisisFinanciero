<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cuenta;
use App\Empresa;
use App\CuentaSistema;
use App\VinculacionCuenta;
use Illuminate\Support\Facades\DB;

class BalanceGeneralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_periodo)
    {   
        //TODO Validacion del periodo para la empresa
        /*
        select c.id, c.codigo, c.nombre, c.padre_id, cp.total from
        cuenta as c
        left join (select * from cuenta_periodo where periodo_id=1) as cp
        on c.id = cp.cuenta_id
        where c.empresa_id=1
        order by c.codigo asc
         */
        $idUsuarioLogeado=auth()->user()->id;
        $empresa= Empresa::where('user_id', $idUsuarioLogeado)->first();
        //Traer las cuentas (Activo, Pasivo y Patrimonio) del catalogo de usuario, vinculadas a nuestras cuentas
        $activo=DB::select('select * from cuenta 
        where id=(select id_cuenta from vinculacion_cuenta where id_empresa=? and id_cuenta_sistema=?)',[$empresa->id,1]);
        //dd($activo[0]->id);
        $pasivo=DB::select('select * from cuenta 
        where id=(select id_cuenta from vinculacion_cuenta where id_empresa=? and id_cuenta_sistema=?)',[$empresa->id,2]);
        $capital=DB::select('select * from cuenta 
        where id=(select id_cuenta from vinculacion_cuenta where id_empresa=? and id_cuenta_sistema=?)',[$empresa->id,12]);
        if(!$activo || !$pasivo || !$capital){
            //dd('nulos');
            return redirect()->route('cuenta_sistema.index')->withErrors(['msg'=>'No ha vinculado las cuentas de Activo, Pasivo o Patrimonio']);
        }
        $cuentasEmpresa=Cuenta::with('tipo')->where('empresa_id',$empresa->id)->orderBy('codigo', 'desc')->get();
        //dd([$activo, $pasivo, $capital, $cuentasEmpresa]);     
        return view('finanzasViews.balanceGeneral.create',['activo'=>$activo, 'pasivo'=>$pasivo, 'capital'=>$capital, 'cuentasEmpresa'=>$cuentasEmpresa]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

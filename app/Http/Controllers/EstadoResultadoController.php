<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cuenta;
use App\Empresa;
use Illuminate\Support\Facades\DB;

class EstadoResultadoController extends Controller
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
        $idUsuarioLogeado=auth()->user()->id;
        $empresa= Empresa::where('user_id', $idUsuarioLogeado)->first();
        $ventas=DB::select('select * from cuenta 
        where id=(select id_cuenta from vinculacion_cuenta where id_empresa=? and id_cuenta_sistema=?)',[$empresa->id,18]);
        $costoVentas=DB::select('select * from cuenta 
        where id=(select id_cuenta from vinculacion_cuenta where id_empresa=? and id_cuenta_sistema=?)',[$empresa->id,8]);
        $gastosOperacion=DB::select('select * from cuenta 
        where id=(select id_cuenta from vinculacion_cuenta where id_empresa=? and id_cuenta_sistema=?)',[$empresa->id,17]);
        $GastosVentas=DB::select('select * from cuenta 
        where id=(select id_cuenta from vinculacion_cuenta where id_empresa=? and id_cuenta_sistema=?)',[$empresa->id,19]);
        $IngresosNoOperativos=DB::select('select * from cuenta 
        where id=(select id_cuenta from vinculacion_cuenta where id_empresa=? and id_cuenta_sistema=?)',[$empresa->id,20]);
        $GastosNoOperativos=DB::select('select * from cuenta 
        where id=(select id_cuenta from vinculacion_cuenta where id_empresa=? and id_cuenta_sistema=?)',[$empresa->id,21]);
        $DevolucionVentas=DB::select('select * from cuenta 
        where id=(select id_cuenta from vinculacion_cuenta where id_empresa=? and id_cuenta_sistema=?)',[$empresa->id,22]);
        $DescuentoVentas=DB::select('select * from cuenta 
        where id=(select id_cuenta from vinculacion_cuenta where id_empresa=? and id_cuenta_sistema=?)',[$empresa->id,23]);
        //dd($activo[0]->id);
        if(!$ventas || !$costoVentas || !$gastosOperacion || !$GastosVentas || !$IngresosNoOperativos || !$GastosNoOperativos
        || !$DevolucionVentas || !$DescuentoVentas){
            //dd('nulos');
            return redirect()->route('cuenta_sistema.index')->withErrors(['msg'=>'No ha vinculado las cuentas necesarias para el Estado de Resultado']);
        }
        $vinculos= array($ventas, $costoVentas, $gastosOperacion, $GastosVentas, $IngresosNoOperativos, 
        $GastosNoOperativos, $DevolucionVentas, $DescuentoVentas);
        //  dd($vinculos);
        //dd($vinculos[0][0]->nombre);
        //$cuentasEmpresa=Cuenta::with('tipo')->where('empresa_id',$empresa->id)->orderBy('codigo', 'desc')->get();
        return view('finanzasViews.estadoResultados.create', ['vinculos'=>$vinculos]);
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

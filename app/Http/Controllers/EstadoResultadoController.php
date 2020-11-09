<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cuenta;
use App\Empresa;
use App\EstadoResultado;
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
        $ventas=DB::select('select c.*, cp.total from (select * from cuenta 
        where id=(select id_cuenta from vinculacion_cuenta where id_empresa=? 
		and id_cuenta_sistema=(select id from cuenta_sistema where nombre=?))) as c
        left join (select * from cuenta_periodo where periodo_id=?) as cp
        on c.id= cp.cuenta_id',[$empresa->id,'Ventas', $id_periodo]);
        $DevolucionVentas=DB::select('select c.*, cp.total from (select * from cuenta 
        where id=(select id_cuenta from vinculacion_cuenta where id_empresa=? 
		and id_cuenta_sistema=(select id from cuenta_sistema where nombre=?))) as c
        left join (select * from cuenta_periodo where periodo_id=?) as cp
        on c.id= cp.cuenta_id',[$empresa->id,'Devolución sobre ventas', $id_periodo]);
        $DescuentoVentas=DB::select('select c.*, cp.total from (select * from cuenta 
        where id=(select id_cuenta from vinculacion_cuenta where id_empresa=? 
		and id_cuenta_sistema=(select id from cuenta_sistema where nombre=?))) as c
        left join (select * from cuenta_periodo where periodo_id=?) as cp
        on c.id= cp.cuenta_id',[$empresa->id,'Descuento sobre ventas', $id_periodo]);
        $costoVentas=DB::select('select c.*, cp.total from (select * from cuenta 
        where id=(select id_cuenta from vinculacion_cuenta where id_empresa=? 
		and id_cuenta_sistema=(select id from cuenta_sistema where nombre=?))) as c
        left join (select * from cuenta_periodo where periodo_id=?) as cp
        on c.id= cp.cuenta_id',[$empresa->id,'Costos de ventas', $id_periodo]);
        $gastosOperacion=DB::select('select c.*, cp.total from (select * from cuenta 
        where id=(select id_cuenta from vinculacion_cuenta where id_empresa=? 
		and id_cuenta_sistema=(select id from cuenta_sistema where nombre=?))) as c
        left join (select * from cuenta_periodo where periodo_id=?) as cp
        on c.id= cp.cuenta_id',[$empresa->id,'Gastos de operación', $id_periodo]);
        /*  $GastosVentas=DB::select('select c.*, cp.total from (select * from cuenta 
        where id=(select id_cuenta from vinculacion_cuenta where id_empresa=? and id_cuenta_sistema=?)) as c
        left join (select * from cuenta_periodo where periodo_id=?) as cp
        on c.id= cp.cuenta_id',[$empresa->id,19, $id_periodo]);*/
        $IngresosNoOperativos=DB::select('select c.*, cp.total from (select * from cuenta 
        where id=(select id_cuenta from vinculacion_cuenta where id_empresa=? 
		and id_cuenta_sistema=(select id from cuenta_sistema where nombre=?))) as c
        left join (select * from cuenta_periodo where periodo_id=?) as cp
        on c.id= cp.cuenta_id',[$empresa->id,'Ingresos no operativos', $id_periodo]);
        $GastosNoOperativos=DB::select('select c.*, cp.total from (select * from cuenta 
        where id=(select id_cuenta from vinculacion_cuenta where id_empresa=? 
		and id_cuenta_sistema=(select id from cuenta_sistema where nombre=?))) as c
        left join (select * from cuenta_periodo where periodo_id=?) as cp
        on c.id= cp.cuenta_id',[$empresa->id,'Gastos no operativos', $id_periodo]);                
        //dd($activo[0]->id);
        if(!$ventas || !$costoVentas || !$gastosOperacion || !$IngresosNoOperativos || !$GastosNoOperativos
        || !$DevolucionVentas || !$DescuentoVentas){
            //dd('nulos');
            return redirect()->route('cuenta_sistema.index')->withErrors(['msg'=>'No ha vinculado las cuentas necesarias para el Estado de Resultado']);
        }
        $vinculos= array($ventas, $DevolucionVentas, $DescuentoVentas, $costoVentas, $gastosOperacion, $IngresosNoOperativos, 
        $GastosNoOperativos);
        $EstadoResultado= EstadoResultado::Where('periodo_id',$id_periodo)->first();
        //  dd($vinculos);
        //dd($vinculos[0][0]->nombre);
        //$cuentasEmpresa=Cuenta::with('tipo')->where('empresa_id',$empresa->id)->orderBy('codigo', 'desc')->get();
        return view('finanzasViews.estadoResultados.create', ['vinculos'=>$vinculos, 'ER'=>$EstadoResultado]);
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

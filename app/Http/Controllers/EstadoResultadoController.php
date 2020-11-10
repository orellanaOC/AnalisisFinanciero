<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cuenta;
use App\Empresa;
use App\EstadoResultado;
use App\Periodo;
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
        //Validacion de periodo
        $idUsuarioLogeado=auth()->user()->id;
        $empresa= Empresa::where('user_id', $idUsuarioLogeado)->first();
        if(!$periodo= Periodo::Where('id',$id_periodo)->Where('empresa_id',$empresa->id)->first()){
            abort(403);
        }
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
        if(!$ventas || !$costoVentas || !$gastosOperacion || !$GastosNoOperativos){
            //dd('nulos');            
            return redirect()->route('cuenta_sistema.index')->withErrors(['msg'=>'No ha vinculado las cuentas necesarias para el Estado de Resultado']);
        }
        $vinculos= array($ventas, $DevolucionVentas, $DescuentoVentas, $costoVentas, $gastosOperacion, $IngresosNoOperativos, 
        $GastosNoOperativos);
        //dd($vinculos);
        $EstadoResultado= EstadoResultado::Where('periodo_id',$id_periodo)->first();
        //  dd($vinculos);
        //dd($vinculos[0][0]->nombre);
        //$cuentasEmpresa=Cuenta::with('tipo')->where('empresa_id',$empresa->id)->orderBy('codigo', 'desc')->get();
        return view('finanzasViews.estadoResultados.create', ['vinculos'=>$vinculos, 'ER'=>$EstadoResultado, 'periodo'=>$id_periodo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id_periodo)
    {
        //Validacion de periodo
        $idUsuarioLogeado=auth()->user()->id;
        $empresa= Empresa::where('user_id', $idUsuarioLogeado)->first();
        if(!$periodo= Periodo::Where('id',$id_periodo)->Where('empresa_id',$empresa->id)->first()){
            abort(403);
        }
        //Validación de campos
        if($request->ventas==null || $request->devolucion_venta==null || $request->descuento_venta==null
        || $request->costos_venta==null || $request->gastos_operacion==null 
        || $request->otros_ingresos==null || $request->otros_gastos==null || $request->impuestos==null){
            return back()->withErrors('Todos los campos son obligatorios');
        }
        if($EstadoResultado= EstadoResultado::Where('periodo_id',$id_periodo)->first()){
            $EstadoResultado= $this->calculosER($request, $EstadoResultado, $id_periodo);
        }else{
            $EstadoResultado= new EstadoResultado();
            $EstadoResultado= $this->calculosER($request, $EstadoResultado, $id_periodo);
        }
        $EstadoResultado->save();
        return redirect()->route('estado_resultado_create', $id_periodo)->with('status', 'Cuenta '.$request->nombre.' creada exitosamente');        
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

    public function calculosER($valoresER, $ER, $id_periodo){
        $ER->ventas_netas=$valoresER->ventas-$valoresER->devolucion_venta-$valoresER->descuento_venta;
        $ER->utilidad_bruta=$ER->ventas_netas-$valoresER->costos_venta;
        $ER->utilidad_operativa=$ER->utilidad_bruta-$valoresER->gastos_operacion;
        $ER->utilidad_antes_de_i=$ER->utilidad_operativa+$valoresER->otros_ingresos-$valoresER->otros_gastos;
        $ER->impuestos=$valoresER->impuestos;
        $ER->utilidad_neta=$ER->utilidad_antes_de_i-$ER->impuestos;
        $ER->ventas=$valoresER->ventas;
        $ER->devolucion_ventas=$valoresER->devolucion_venta;
        $ER->descuento_ventas=$valoresER->descuento_venta;
        $ER->costo_ventas=$valoresER->costos_venta;
        $ER->gastos_operacion=$valoresER->gastos_operacion;
        $ER->otros_ingresos=$valoresER->otros_ingresos;
        $ER->otros_gastos= $valoresER->otros_gastos;
        $ER->periodo_id=$id_periodo;          
        return $ER;
    }
}

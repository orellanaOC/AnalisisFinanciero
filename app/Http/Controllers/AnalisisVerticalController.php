<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cuenta;
use App\Empresa;
use App\CuentaSistema;
use App\VinculacionCuenta;
use App\Periodo;
use Illuminate\Support\Facades\DB;

class AnalisisVerticalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Validacion del periodo para la empresa
        $idUsuarioLogeado=auth()->user()->id;
        $empresa= Empresa::where('user_id', $idUsuarioLogeado)->first();        
        $periodos=Periodo::Where('empresa_id',$empresa->id)->get();
        return view('finanzasViews.analisisSector.analisis_vertical',['periodos'=>$periodos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function show($id_periodo)
    {
        // Validacion del periodo para la empresa
        $idUsuarioLogeado=auth()->user()->id;
        $empresa= Empresa::where('user_id', $idUsuarioLogeado)->first();
        if(!$periodo= Periodo::Where('id',$id_periodo)->Where('empresa_id',$empresa->id)->first()){
            abort(403);
        }
        $periodos=Periodo::Where('empresa_id',$empresa->id)->get();
        //Traer las vincuncalicones de Activo, pasivo y capital
        $activo=DB::select('select c.*, cp.total from (select * from cuenta 
        where id=(select id_cuenta from vinculacion_cuenta where id_empresa=? 
		and id_cuenta_sistema=(select id from cuenta_sistema where nombre=?))) as c
        left join (select * from cuenta_periodo where periodo_id=?) as cp
        on c.id= cp.cuenta_id',[$empresa->id, 'Activos', $id_periodo]);
        $pasivo=DB::select('select c.*, cp.total from (select * from cuenta 
        where id=(select id_cuenta from vinculacion_cuenta where id_empresa=? 
		and id_cuenta_sistema=(select id from cuenta_sistema where nombre=?))) as c
        left join (select * from cuenta_periodo where periodo_id=?) as cp
        on c.id= cp.cuenta_id',[$empresa->id, 'Pasivos', $id_periodo]);
        $capital=DB::select('select c.*, cp.total from (select * from cuenta 
        where id=(select id_cuenta from vinculacion_cuenta where id_empresa=? 
		and id_cuenta_sistema=(select id from cuenta_sistema where nombre=?))) as c
        left join (select * from cuenta_periodo where periodo_id=?) as cp
        on c.id= cp.cuenta_id',[$empresa->id, 'Patrimonio', $id_periodo]);

        $total = $activo[0]->total + $pasivo[0]->total + $capital[0]->total;

        if($total != 0){
            $activo[0]->porcentaje = number_format(($activo[0]->total/$total)*100, 2);
            $pasivo[0]->porcentaje = number_format(($pasivo[0]->total/$total)*100, 2);
            $capital[0]->porcentaje = number_format(($capital[0]->total/$total)*100, 2);
        }

        $cuentasVinculadas= array($activo, $pasivo, $capital);
        //Traer las cuentas del catalogo y su total
        $cuentasActivo=DB::select('select c.*, cp.total from
        cuenta as c
        left join (select * from cuenta_periodo where periodo_id=?) as cp
        on c.id = cp.cuenta_id
        where c.empresa_id=?
		and c.codigo like ?
        order by c.codigo asc', [$id_periodo, $empresa->id, $activo[0]->codigo.'%']);

        foreach($cuentasActivo as $ca){
            if($total != 0){
                $ca->porcentaje = number_format(($ca->total/$total)*100, 2);
            } 
        }
        
        $cuentasPasivo=DB::select('select c.*, cp.total from
        cuenta as c
        left join (select * from cuenta_periodo where periodo_id=?) as cp
        on c.id = cp.cuenta_id
        where c.empresa_id=?
		and c.codigo like ?
        order by c.codigo asc', [$id_periodo, $empresa->id, $pasivo[0]->codigo.'%']);

        foreach($cuentasPasivo as $cp){
            if($total != 0){
                $cp->porcentaje = number_format(($cp->total/$total)*100, 2);
            } 
        }
        
        $cuentasCapital=DB::select('select c.*, cp.total from
        cuenta as c
        left join (select * from cuenta_periodo where periodo_id=?) as cp
        on c.id = cp.cuenta_id
        where c.empresa_id=?
		and c.codigo like ?
        order by c.codigo asc', [$id_periodo, $empresa->id, $capital[0]->codigo.'%']);

        foreach($cuentasCapital as $cc){
            if($total != 0){
                $cc->porcentaje = number_format(($cc->total/$total)*100, 2);
            } 
        }
                
        return view('finanzasViews.analisisSector.analisis_vertical_hijo', [
            'cuentasActivo'=>$cuentasActivo, 
            'cuentasPasivo'=>$cuentasPasivo, 
            'cuentasCapital'=>$cuentasCapital, 
            'vinculaciones'=>$cuentasVinculadas,   
            'periodos'=>$periodos
        ]);
    }

}

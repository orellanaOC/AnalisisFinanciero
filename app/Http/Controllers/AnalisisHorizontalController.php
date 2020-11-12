<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cuenta;
use App\Empresa;
use App\CuentaSistema;
use App\VinculacionCuenta;
use App\Periodo;
use Illuminate\Support\Facades\DB;

class AnalisisHorizontalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $idUsuarioLogeado=auth()->user()->id;
        $empresa= Empresa::where('user_id', $idUsuarioLogeado)->first();        
        $periodos=Periodo::Where('empresa_id',$empresa->id)->get();        
        return view('finanzasViews.analisisSector.analisis_horizontal',['periodos'=>$periodos]);
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
    public function show($id_periodo1, $id_periodo2)
    {
        //dd([$id_periodo1, $id_periodo2]);
        // Validacion del periodo para la empresa
        $idUsuarioLogeado=auth()->user()->id;
        $empresa= Empresa::where('user_id', $idUsuarioLogeado)->first();
        if(!$periodo1= Periodo::Where('id',$id_periodo1)->Where('empresa_id',$empresa->id)->first()){
            abort(403);
        }
        if(!$periodo2= Periodo::Where('id',$id_periodo2)->Where('empresa_id',$empresa->id)->first()){
            abort(403);
        }
        $periodos=Periodo::Where('empresa_id',$empresa->id)->get();
        //Traer las vincuncalicones de Activo, pasivo y capital
        $activo=DB::select('select c.*, cp.total from (select * from cuenta 
        where id=(select id_cuenta from vinculacion_cuenta where id_empresa=? 
		and id_cuenta_sistema=(select id from cuenta_sistema where nombre=?))) as c
        left join (select * from cuenta_periodo where periodo_id=?) as cp
        on c.id= cp.cuenta_id',[$empresa->id, 'Activos', $id_periodo1]);
        $pasivo=DB::select('select c.*, cp.total from (select * from cuenta 
        where id=(select id_cuenta from vinculacion_cuenta where id_empresa=? 
		and id_cuenta_sistema=(select id from cuenta_sistema where nombre=?))) as c
        left join (select * from cuenta_periodo where periodo_id=?) as cp
        on c.id= cp.cuenta_id',[$empresa->id, 'Pasivos', $id_periodo1]);
        $capital=DB::select('select c.*, cp.total from (select * from cuenta 
        where id=(select id_cuenta from vinculacion_cuenta where id_empresa=? 
		and id_cuenta_sistema=(select id from cuenta_sistema where nombre=?))) as c
        left join (select * from cuenta_periodo where periodo_id=?) as cp
        on c.id= cp.cuenta_id',[$empresa->id, 'Patrimonio', $id_periodo1]);
        $cuentasVinculadas= array($activo, $pasivo, $capital);
        //Traer las cuentas del catalogo y el total de los 2 periodos
        $cuentasEmpresa=DB::select('select c.*, cp.total as total1, cp2.total as total2 from
        cuenta as c
        left join (select * from cuenta_periodo where periodo_id=?) as cp
        on c.id = cp.cuenta_id
		left join (select * from cuenta_periodo where periodo_id=?) as cp2
		on c.id = cp2.cuenta_id
        where c.empresa_id=?		
        order by c.codigo asc', [$id_periodo1, $id_periodo2, $empresa->id]);

        foreach ($cuentasEmpresa as $cuenta) {
            $cuenta->resta= $cuenta->total2-$cuenta->total1;
            if($cuenta->total1!=null && $cuenta->total1!=0){
                $cuenta->porcentaje= number_format(($cuenta->resta/$cuenta->total1)*100, 2);
            }
            else{
                $cuenta->porcentaje= 0;
            }
        }        
        return view('finanzasViews.analisisSector.analisis_horizontal_hijo',[
            'periodos'=>$periodos, 
            'cuentas'=>$cuentasEmpresa,
            'vinculos'=>$cuentasVinculadas
        ]);
    }

}

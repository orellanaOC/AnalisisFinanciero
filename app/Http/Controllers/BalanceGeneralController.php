<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cuenta;
use App\Empresa;
use App\CuentaSistema;
use App\VinculacionCuenta;
use App\Periodo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
        // Validacion del periodo para la empresa
        $idUsuarioLogeado=auth()->user()->id;
        $empresa= Empresa::where('user_id', $idUsuarioLogeado)->first();
        if(!$periodo= Periodo::Where('id',$id_periodo)->Where('empresa_id',$empresa->id)->first()){
            abort(403);
        }
        /*
        select c.id, c.codigo, c.nombre, c.padre_id, cp.total from
        cuenta as c
        left join (select * from cuenta_periodo where periodo_id=1) as cp
        on c.id = cp.cuenta_id
        where c.empresa_id=1
        order by c.codigo asc
         */
        //Traer las cuentas (Activo, Pasivo y Patrimonio) del catalogo de usuario, vinculadas a nuestras cuentas
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
        if(!$activo || !$pasivo || !$capital){
            //dd('nulos');
            return redirect()->route('cuenta_sistema.index')->withErrors(['msg'=>'No ha vinculado las cuentas de Activo, Pasivo o Patrimonio']);
        }
        //$cuentasEmpresa=Cuenta::with('tipo')->where('empresa_id',$empresa->id)->orderBy('codigo', 'desc')->get();
        $cuentasEmpresa=DB::select('select c.*, cp.total from
        cuenta as c
        left join (select * from cuenta_periodo where periodo_id=?) as cp
        on c.id = cp.cuenta_id
        where c.empresa_id=?
        order by c.codigo asc',[$id_periodo, $empresa->id]);
        //dd($cuentasEmpresa);
        $año_periodo=Periodo::find($id_periodo);
        return view('finanzasViews.balanceGeneral.create',['activo'=>$activo, 'pasivo'=>$pasivo, 'capital'=>$capital, 'cuentasEmpresa'=>$cuentasEmpresa, 'periodo'=>$id_periodo,'periodo_anio'=>$año_periodo]);
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    //Para descargar el excel
    public function dowloadExcel(Request $request){
        $idUsuarioLogeado=auth()->user()->id;
        $nombre_descarga=$idUsuarioLogeado."-"."Plantilla-Balance-General.xlsx";
        $ruta='plantillasExcel/Plantilla-Balance-General.xlsx';
        return Storage::download($ruta,$nombre_descarga);
    }
}

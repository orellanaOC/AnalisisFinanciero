<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cuenta;
use App\Empresa;
use App\EstadoResultado;
use App\Periodo;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;

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
        if(!$ventas || !$costoVentas || !$gastosOperacion){
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
    //Para descargar el excel
    public function dowloadExcel(Request $request){
        $idUsuarioLogeado=auth()->user()->id;
        $nombre_descarga=$idUsuarioLogeado."-"."Plantilla-Estado-Resultado.xlsx";
        $ruta='plantillasExcel/Plantilla-Estado-Resultado.xlsx';
        return Storage::download($ruta,$nombre_descarga);
    }
    public function uploadExcel(Request $request,$id_periodo){

        $id_user = auth()->user()->id;
        //Guardamos el archivo en una ruta temporal
        $ruta=Storage::putFileAs('importExcel',$request->file('archivo'),$id_user.Carbon::now()->format('His')."Excel.xlsx");

        //$ruta='plantillasExcel/Plantilla-Catalogo-Cuentas.xlsx';
        $spreadsheet=null;
        $data=null;

        $message=['tipo'=>1,'error'=>'Hubo un error en la importacion. Verifique que sea el formato adecuado.'];
        try{
            //Se carga el archivo que subio el archivo para poder acceder a los datos
            $path = "app/".$ruta;
            $spreadsheet = IOFactory::load(storage_path($path));
            //Todas las filas se convierten en un array que puede ser accedido por las letras de las columnas de archivo excel
            $data = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);



        }catch(Exception $e){
           Storage::delete($ruta);
           return response()->json($message.$e);
        }
        //return $data;
        //Validacion de la plantilla
        if($spreadsheet->getActiveSheet()->getCell('D2')==""){
            Storage::delete($ruta);
            return redirect()->route('estado_resultado_create', $id_periodo)->with('status', 'En la celda "D2" debera ingresar el año del periodo');
        }
        else{
            if(strlen($spreadsheet->getActiveSheet()->getCell('D2'))==4){
                $idUsuarioLogeado=auth()->user()->id;
                $empresa= Empresa::where('user_id', $idUsuarioLogeado)->first();
                //$periodo_valido=Periodo::where('id',$id_periodo)->where('empresa_id',$empresa->id)->first();
                $periodo_año=Periodo::find($id_periodo);
                //return $spreadsheet->getActiveSheet()->getCell('D2');
                if(!($spreadsheet->getActiveSheet()->getCell('D2')==strval($periodo_año->year))){
                    Storage::delete($ruta);
                    return redirect()->route('estado_resultado_create', $id_periodo)->with('status', 'El año del estado de resultado selecionado no es igual al balance que se pretende subir');
                }
                else{
                    $ventas=0;$dev_sobre_ventas=0;$des_sobre_ventas=0;
                    $costo_de_ventas=0;$gast_de_operacion=0;$otros_ingresos=0;
                    $otros_gastos=0;$impuesto_sobre_renta=0;

                    for ($i=2; $i < count($data); $i++) {
                        if($data[$i]["A"]!=null){
                            switch ($data[$i]["A"])
                            {

                                case "VEN":
                                    $ventas=intval($data[$i]["C"]);
                                    break;
                                case "DVV":
                                    $dev_sobre_ventas=intval($data[$i]["C"]);
                                    break;
                                case "DSV":
                                    $des_sobre_ventas=intval($data[$i]["C"]);
                                    break;
                                case "CDV":
                                    $costo_de_ventas=intval($data[$i]["C"]);
                                    break;
                                case "GDO":
                                    $gast_de_operacion=intval($data[$i]["C"]);
                                    break;
                                case "OIS":
                                    $otros_ingresos=intval($data[$i]["C"]);
                                    break;
                                case "OGS":
                                    $otros_gastos=intval($data[$i]["C"]);
                                    break;
                                case "ISR":
                                    $impuesto_sobre_renta=intval($data[$i]["C"]);
                                    break;
                            }
                        }
                    }
                    //Parte de calculos
                    $ventas_netas=$ventas-$dev_sobre_ventas-$des_sobre_ventas;
                    $utilidad_bruta=$ventas_netas-$costo_de_ventas;
                    $utilidad_operativa=$utilidad_bruta-$gast_de_operacion;
                    $utilidad_operativa_antes_de_impuesto=$utilidad_operativa+($otros_ingresos-$otros_gastos);
                    $utilidad_neta=$utilidad_operativa_antes_de_impuesto-$impuesto_sobre_renta;

                    $estado_viejo=EstadoResultado::where('periodo_id',intval($id_periodo))->delete();


                    $estado_resultado= new EstadoResultado();
                    $estado_resultado->ventas_netas=$ventas_netas;
                    $estado_resultado->utilidad_bruta=$utilidad_bruta;
                    $estado_resultado->utilidad_operativa=$utilidad_operativa;
                    $estado_resultado->utilidad_antes_de_i=$utilidad_operativa_antes_de_impuesto;
                    $estado_resultado->impuestos=$impuesto_sobre_renta;
                    $estado_resultado->utilidad_neta=$utilidad_neta;
                    $estado_resultado->ventas=$ventas;
                    $estado_resultado->devolucion_ventas=$dev_sobre_ventas;
                    $estado_resultado->descuento_ventas=$des_sobre_ventas;
                    $estado_resultado->costo_ventas=$costo_de_ventas;
                    $estado_resultado->gastos_operacion=$gast_de_operacion;
                    $estado_resultado->otros_ingresos=$otros_ingresos;
                    $estado_resultado->otros_gastos=$otros_gastos;
                    $estado_resultado->periodo_id=intval($id_periodo);
                    //return $estado_resultado;
                    $estado_resultado->save();

                    //Eliminar el archivo subido, solo se utiliza para la importacion y luego de desecha
                    Storage::delete($ruta);
                    return redirect()->route('estado_resultado_create', $id_periodo)->with('status', 'Archivo procesado correctamente, revise los valores');

                }

            }
            else{
                Storage::delete($ruta);
                return redirect()->route('estado_resultado_create', $id_periodo)->with('status', 'Debe de tener un formato valido YYYY');

            }


        }




    }
}

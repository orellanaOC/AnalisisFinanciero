<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoCuenta;
use App\Cuenta;
use App\Empresa;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;

class CatalogoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoCuenta= TipoCuenta::all();
        return view('simpleViews.catalogo.index', ['tipoCuenta'=> $tipoCuenta]);
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
        //dd($request->request);
        //Validación de campos
        request()->validate([
            'codigo'=> 'required',
            'nombre'=> 'required',
            'tipoCuenta'=> 'required',
            //'padre'=> 'required',
        ],
        [
            'codigo.required' => "El campo 'codigo' es obligatorio.",
            'nombre.required' => "El campo 'nombre' es obligatorio.",
            'tipoCuenta.required' => "Seleccione un tipo de cuenta.",
        ]);
        //Creando la nueva cuenta y asignando sus valors
        $cuenta= new Cuenta();
        $cuenta->codigo= $request->codigo;
        $cuenta->nombre= $request->nombre;
        //La empresa sera tomada directamente de la empresa del usuario logeado
        $idUsuarioLogeado=auth()->user()->id;
        $empresa= Empresa::where('user_id', $idUsuarioLogeado);
        $cuenta->empresa_id= $empresa->id;
        $cuenta->tipo_id= $request->tipoCuenta;
        $cuenta->padre_id=$request->padre;
        return redirect()->route('catalogo_prueba');
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

    public function dowloadExcel(Request $request){
        $idUsuarioLogeado=auth()->user()->id;
        $nombre_descarga=$idUsuarioLogeado."-"."Plantilla.xlsx";
        $ruta='plantillasExcel/Plantilla-Catalogo-Cuentas.xlsx';
        return Storage::download($ruta,$nombre_descarga);
    }
    public function uploadExcel(Request $request){
        //Buscamos el usuario logueado
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
            //return $spreadsheet;
            //Todas las filas se convierten en un array que puede ser accedido por las letras de las columnas de archivo excel
            $data = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
            //return $data;


        }catch(Exception $e){
           return response()->json($message.$e);
        }
        //$variable=[];
        for ($i=2; $i < count($data); $i++) {
            if($data[$i]["A"]!=null)
            {
                //En caso de ser nula es una cuenta padre
                if($data[$i]["C"]==null){
                    //$variable[$i]="Cod_cuenta: ".$data[$i]["A"]." Nombre: ".$data[$i]["B"]." Cuenta padre: "."CUENTA PADRE"." Tipo Cuenta: ".$data[$i]["D"];
                    //Creando la nueva cuenta y asignando sus valores
                    $cuenta= new Cuenta();
                    $cuenta->codigo= $data[$i]["A"];
                    $cuenta->nombre= $data[$i]["B"];
                    //La empresa sera tomada directamente de la empresa del usuario logeado
                    $idUsuarioLogeado=auth()->user()->id;
                    $empresa= Empresa::where('user_id', $idUsuarioLogeado)->get();
                    $cuenta->empresa_id= $empresa[0]->id;
                    if(strtoupper($data[$i]["D"])=="A"){
                        $cuenta->tipo_id= 1;
                    }
                    else{
                        $cuenta->tipo_id= 2;
                    }
                    $cuenta->padre_id=null;
                    $cuenta->save();
                }
                else{
                    $padre=$data[$i]["C"];
                    $existe=0;
                    for ($j=2; $j < count($data); $j++) {
                        if($padre==$data[$j]["A"]){
                            $existe=1;
                        }
                    }
                    //Si existe el codigo se crea
                    if($existe){

                        //Creando la nueva cuenta y asignando sus valores
                        $cuenta= new Cuenta();
                        $cuenta->codigo= $data[$i]["A"];
                        $cuenta->nombre= $data[$i]["B"];
                        //La empresa sera tomada directamente de la empresa del usuario logeado
                        $idUsuarioLogeado=auth()->user()->id;
                        $empresa= Empresa::where('user_id', $idUsuarioLogeado)->get();
                        $cuenta->empresa_id= $empresa[0]->id;
                        if(strtoupper($data[$i]["D"])=="A"){
                            $cuenta->tipo_id= 1;
                        }
                        else{
                            $cuenta->tipo_id= 2;
                        }
                        $busqueda_padre2=Cuenta::where('codigo', $data[$i]["C"])->where('empresa_id',$cuenta->empresa_id)->first();
                        $cuenta->padre_id=$busqueda_padre2->id;
                        $cuenta->created_at=now();
                        $cuenta->updated_at=now();
                        $cuenta->save();
                    }
                    //Si no existe el codigo no se crea
                    else{

                    }

                }

            }
        }
        return redirect()->route('catalogo_prueba');


    }
}

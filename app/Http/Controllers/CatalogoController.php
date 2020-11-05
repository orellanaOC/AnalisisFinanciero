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
        //return PHP_OS;
        $tipoCuenta= TipoCuenta::all();

        $idUsuarioLogeado=auth()->user()->id;
        $empresa= Empresa::where('user_id', $idUsuarioLogeado)->first();
        //Cuentas de primer nivel (Que no tienen padre)
        $cuentas=Cuenta::with('tipo')->where('empresa_id',$empresa->id)->orderBy('codigo', 'asc')->get();

        return view('simpleViews.catalogo.index', ['tipoCuenta'=> $tipoCuenta,'cuentas'=>$cuentas]);
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
        //La empresa sera tomada directamente de la empresa del usuario logeado
        $idUsuarioLogeado=auth()->user()->id;
        $empresa= Empresa::where('user_id', $idUsuarioLogeado)->first();        
        //Llamada a la funcion para guardar cuentas
        $respuesta= $this->guardarCuenta($request, $empresa, TRUE);
        if($respuesta===TRUE){
            return redirect()->route('catalogo_prueba')->with('status', 'Cuenta '.$request->nombre.' creada exitosamente');
        }
        else{
            return back()->withErrors(['msg'=>$respuesta]);
        }        
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
        dd([$request->request, $id]);
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
        //La empresa sera tomada directamente de la empresa del usuario logeado
        $idUsuarioLogeado=auth()->user()->id;
        $empresa= Empresa::where('user_id', $idUsuarioLogeado)->first();
        //Llamada a la funcion para guardar cuentas
        $respuesta= $this->guardarCuenta($request, $empresa, FALSE);
        if($respuesta===TRUE){
            return redirect()->route('catalogo_prueba')->with('status', 'Cuenta '.$request->nombre.' creada exitosamente');
        }
        else{
            return back()->withErrors(['msg'=>$respuesta]);
        }   
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
           return response()->json($message.$e);
        }

        for ($i=2; $i < count($data); $i++) {
            if($data[$i]["A"]!=null)
            {
                //En caso de ser nula es una cuenta padre
                if($data[$i]["C"]==null){
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

            $message=['success'=>'La importacion de preguntas se efectuo exitosamente.'];
        }

        //Eliminar el archivo subido, solo se utiliza para la importacion y luego de desecha
        Storage::delete($ruta);
        return redirect()->route('catalogo_prueba');
    }
    
    public function guardarCuenta($request, $empresa, $cuenta, $metodo){
        if($metodo){
            $cuenta= new Cuenta();
            //Validacion de que la cuenta no sea repetida
            if(Cuenta::Where('codigo', $request->codigo)->where('empresa_id', $empresa->id)->first()){
                //dd('Codigo de cuenta repetido');
                //return back()->withErrors(['msg'=>'Codigo de cuenta repetido, vuelva a intentarlo']);
                return 'Codigo de cuenta repetido, vuelva a intentarlo';
            }
        }
        else{
            $cuenta=Cuenta::Where('codigo', $request->codigo)->where('empresa_id', $empresa->id)->first();
        }        
        $cuenta->codigo= $request->codigo;
        $cuenta->nombre= $request->nombre;
        $cuenta->empresa_id= $empresa->id;
        $cuenta->tipo_id= $request->tipoCuenta;
        //Se guardara el id del padre solo si escribio un codigo de cuenta padre
        if ($request->cuenta_padre) {
            //Validación si la cuenta padre que ingreso es correcta
            if($cuentaPadre= Cuenta::Where('codigo', $request->cuenta_padre)->where('empresa_id', $empresa->id)->first()){
                //dd([gettype($cuenta->codigo) , gettype($cuentaPadre->codigo)]);
                if((strpos(strval($cuenta->codigo), strval($cuentaPadre->codigo)))===FALSE){
                    //return back()->withErrors(['msg'=>'El codigo debe iniciar con el codigo de su cuenta padre']);
                    return 'El codigo debe iniciar con el codigo de su cuenta padre';
                }
                $cuenta->padre_id=$cuentaPadre->id;
            }
            else {
                //dd('se escribio cuenta padre pero es incorrecta');
                //return back()->withErrors(['msg'=>'El codigo de cuenta padre es incorrecta, vuelva a intentarlo']);
                return 'El codigo de cuenta padre es incorrecta, vuelva a intentarlo';
            }
        }
        $cuenta->save();
        return TRUE;
    }
}

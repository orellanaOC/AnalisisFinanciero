<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CuentaSistema;
use App\Cuenta;
use App\Empresa;
use App\VinculacionCuenta;
use Illuminate\Support\Facades\DB;

class CuentaSistemaController extends Controller
{
    public function index()
    {
        //$cuentas= CuentaSistema::all();
        $cuentas=CuentaSistema::where('uso',1)->get();
        $idUsuarioLogeado=auth()->user()->id;
        $empresa= Empresa::where('user_id', $idUsuarioLogeado)->first();
        //Join para traer el nombre de la cuenta vinculada
        $vinculaciones=DB::select('select ca.nombre, v.id_cuenta_sistema
        from cuenta as ca
        inner join  vinculacion_cuenta as v
        on ca.id=v.id_cuenta
        where v.id_empresa=?', [$empresa->id]);
        foreach ($cuentas as $cuenta) {
            foreach ($vinculaciones as $vinculacion) {
                if($cuenta->id==$vinculacion->id_cuenta_sistema){
                    $cuenta->vinculada=true;
                    $cuenta->cuentaCatalogo=$vinculacion->nombre;
                }
            }
        }
        $cuentasEmpresa=Cuenta::with('tipo')->where('empresa_id',$empresa->id)->orderBy('codigo', 'asc')->get();
        //Vista con catalogo_listo= falso
        //Cuentas que ya han sido vinculadas en esta empresa

        return view('simpleViews.empresa.cuentas', ['cuentas'=>$cuentas, 'cuentasEmpresa'=>$cuentasEmpresa]);
    }

    public function vinculacion(Request $request, $id){
        //  dd($request->request);
        request()->validate([
            'cuenta'=> 'required',
        ],
        [
            'cuenta.required' => "Debe escribir una cuenta para la vinculación",
        ]);
        $idUsuarioLogeado=auth()->user()->id;
        $empresa= Empresa::where('user_id', $idUsuarioLogeado)->first();
        if(!$cuentaEmpresa=Cuenta::with('tipo')->where('empresa_id',$empresa->id)->Where('nombre',$request->cuenta)->first()){
            //Regresar con error, la cuenta que introdujo no existe
            return back()->withErrors(['msg'=>"La cuenta que introdujo no existe en su catalogo"]);
        }
        //Vinculacion para Balance general y Estado de resultado
        if(!$cuentaSistema=CuentaSistema::Where('id',$id)->first()){
            //Regresar con error, esta cuenta del sistema no existe
            return back()->withErrors(['msg'=>"Esta cuenta del sistema no existe"]);
        }
        if(VinculacionCuenta::Where('id_empresa',$empresa->id)->Where('id_cuenta_sistema', $id)->first()){
            //Regresar con error, esta cuenta ya ha sido vinculada anteriormente
            return back()->withErrors(['msg'=>"La cuenta ".$cuentaSistema->nombre." ya ha sido vinculada con otra cuenta de su catalogo"]);
        }
        $vinculacion = new VinculacionCuenta();
        $vinculacion->id_cuenta=$cuentaEmpresa->id;
        $vinculacion->id_cuenta_sistema=$id;
        $vinculacion->id_empresa=$empresa->id;
        $vinculacion->save();
        return back()->with('status', 'Cuenta '.$request->cuenta.' vinculada exitosamente');

        /*
        if(!($empresa->catalogo_listo)){
            return redirect()->route('catalogo_prueba');
        }
        //Vista con catalogo_listo= falso
        //dd($cuentasEmpresa);
        return view('simpleViews.empresa.cuentas', ['cuentas'=>$cuentas, 'cuentasEmpresa'=>$cuentasEmpresa,'empresa'=>$empresa]);
         */
    }

    public function destroy($id){
        $idUsuarioLogeado=auth()->user()->id;
        $empresa= Empresa::where('user_id', $idUsuarioLogeado)->first();
        if(!$vinculacion= VinculacionCuenta::Where('id_cuenta_sistema',$id)->Where('id_empresa',$empresa->id)->get()){
            return back()->withErrors(['msg'=>"Esta cuenta no esta vinculada"]);
        }
        else{
            $elimacion=DB::select('Delete from vinculacion_cuenta
            where id_empresa=?
            and id_cuenta_sistema=?',[$empresa->id, $id]);
        }

        return back()->with('status', 'Cuenta desvinculada exitosamente');
    }

}

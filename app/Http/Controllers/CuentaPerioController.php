<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CuentaPeriodo;
use App\Empresa;
use App\Periodo;
use App\Cuenta;
use Illuminate\Support\Facades\DB;

class CuentaPerioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id_periodo, $id_cuenta)
    {    
        //Validacion de campos
        if(!$request->cuenta){
            return back();
        }
        //Validacion del periodo    
        $idUsuarioLogeado=auth()->user()->id;
        $empresa= Empresa::where('user_id', $idUsuarioLogeado)->first();
        if(!$periodo= Periodo::Where('id',$id_periodo)->Where('empresa_id',$empresa->id)->first()){
            abort(403);
        }
        //dd([$id_periodo, $id_cuenta, 'Hijo', ($request->cuenta+100)]);
        //Validacion si la cuenta que manda como parametro le pertenece al usuario
        if(!$cuenta=Cuenta::Where('id', $id_cuenta)->Where('empresa_id',$empresa->id)->first()){
            abort(403);
        }
        //Si la cuenta periodo ya existe se actualiza
        if($cuentaP=CuentaPeriodo::Where('cuenta_id',$id_cuenta)->Where('periodo_id',$id_periodo)->first()){
            $respuesta=$this->actualizar($request->cuenta, $cuentaP);
        }
        //Si la cuenta periodo no existe, se crea
        else{            
            $respuesta= $this->insertar($request->cuenta, $id_cuenta, $id_periodo);
        }
        //Actualizacion del total de la cuenta padre
        $cuentaPPadre=$this->modificarPadre($cuenta->padre_id, $id_periodo);
        //Regresar a la vista
        return redirect()->route('balance_general_create', $id_periodo)->with('status', 'Valor agregado exitosamente');
    }


    public function storePadre(Request $request, $id_periodo, $id_cuenta)
    {
        //Validacion de campos
        if(!$request->cuenta){
            return back();
        }
        //Validacion del periodo    
        $idUsuarioLogeado=auth()->user()->id;
        $empresa= Empresa::where('user_id', $idUsuarioLogeado)->first();
        if(!$periodo= Periodo::Where('id',$id_periodo)->Where('empresa_id',$empresa->id)->first()){
            abort(403);
        }
        //dd([$id_periodo, $id_cuenta, 'Hijo', ($request->cuenta+100)]);
        //Validacion si la cuenta que manda como parametro le pertenece al usuario
        if(!$cuenta=Cuenta::Where('id', $id_cuenta)->Where('empresa_id',$empresa->id)->first()){
            abort(403);
        }
        if(DB::select('select c.nombre from cuenta as c
            inner join cuenta_periodo as cp
            on c.id= cp.cuenta_id
            where c.padre_id=?
            and cp.periodo_id=?',[$id_cuenta, $id_periodo])){
            return back();
        }
        //Si la cuenta periodo ya existe se actualiza
        if($cuentaP=CuentaPeriodo::Where('cuenta_id',$id_cuenta)->Where('periodo_id',$id_periodo)->first()){
            $respuesta=$this->actualizar($request->cuenta, $cuentaP);
        }
        //Si la cuenta periodo no existe, se crea
        else{            
            $respuesta= $this->insertar($request->cuenta, $id_cuenta, $id_periodo);
        }
        //Actualizacion del total de la cuenta padre        
        $cuentaPPadre=$this->modificarPadre($cuenta->padre_id, $id_periodo);
        //Regresar a la vista
        return redirect()->route('balance_general_create', $id_periodo)->with('status', 'Valor agregado exitosamente');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_cuenta, $id_periodo)
    {
        //dd([$id_cuenta, $id_periodo]);
        //Validacion del periodo    
        $idUsuarioLogeado=auth()->user()->id;
        $empresa= Empresa::where('user_id', $idUsuarioLogeado)->first();
        if(!$periodo= Periodo::Where('id',$id_periodo)->Where('empresa_id',$empresa->id)->first()){
            abort(403);
        }
        //dd([$id_periodo, $id_cuenta, 'Hijo', ($request->cuenta+100)]);
        //Validacion si la cuenta que manda como parametro le pertenece al usuario
        if(!$cuenta=Cuenta::Where('id', $id_cuenta)->Where('empresa_id',$empresa->id)->first()){
            abort(403);
        }
        //Si la cuenta periodo ya existe se actualiza
        if($cuentaP=CuentaPeriodo::Where('cuenta_id',$id_cuenta)->Where('periodo_id',$id_periodo)->first()){
            $cuentaP=$this->actualizar(0, $cuentaP);
            //Actualizacion del total de la cuenta padre        
            $cuentaPPadre=$this->modificarPadre($cuenta->padre_id, $id_periodo);
            //Regresar a la vista            
            return back()->with('status', 'Valor agregado exitosamente');
        }else{            
            return back();
        }
    }

    public function destroyPadre($id_cuenta, $id_periodo)
    {
        //dd([$id_cuenta, $id_periodo]);
        //Validacion del periodo    
        $idUsuarioLogeado=auth()->user()->id;
        $empresa= Empresa::where('user_id', $idUsuarioLogeado)->first();
        if(!$periodo= Periodo::Where('id',$id_periodo)->Where('empresa_id',$empresa->id)->first()){
            abort(403);
        }
        //dd([$id_periodo, $id_cuenta, 'Hijo', ($request->cuenta+100)]);
        //Validacion si la cuenta que manda como parametro le pertenece al usuario
        if(!$cuenta=Cuenta::Where('id', $id_cuenta)->Where('empresa_id',$empresa->id)->first()){
            abort(403);
        }
        //Si la cuenta periodo ya existe se actualiza
        if($cuentaP=CuentaPeriodo::Where('cuenta_id',$id_cuenta)->Where('periodo_id',$id_periodo)->first()){
            $cuentaP=$this->actualizar(0, $cuentaP);
            //Actualizacion del total de la cuenta padre        
            $cuentaPPadre=$this->modificarPadre($cuenta->padre_id, $id_periodo);
            //Regresar a la vista
            //Actualizar valor de sus hijos
            $cuentasHijos=$this->modificarHijos($cuentaP);            
            return back()->with('status', 'Valor agregado exitosamente');
        }else{
            return back();
        }
    }

    //Funcion para insertar cuentas Periodo
    public function insertar($total, $idCuenta, $idPeriodo){
        $cuentaP= new CuentaPeriodo();
        $cuentaP->total=$total;
        $cuentaP->cuenta_id=$idCuenta;
        $cuentaP->periodo_id=$idPeriodo;
        $cuentaP->save();
        return $cuentaP;
    }

    //Funcion para actualizar cuentas Periodo
    public function actualizar($total, $cuentaPeriodo){
        $cuentaPeriodo->total= $total;
        $cuentaPeriodo->save();
        return $cuentaPeriodo;
    }
    
    //Funcion para modificar el total de la cuenta padre
    public function modificarPadre($id, $id_periodo){
        //Si la cuenta Periodo del padre no existe se crea
        if(!$cuentaPeriodoPadre=CuentaPeriodo::Where('cuenta_id',$id)->Where('periodo_id',$id_periodo)->first()){
            $cuentaPeriodoPadre=$this->insertar(0, $id, $id_periodo);
        } 
        $cuentasPHijos= DB::select('select c.nombre, c.padre_id, cp.total, cp.id as cpid from cuenta as c
        inner join cuenta_periodo as cp
        on c.id= cp.cuenta_id
        where c.padre_id=?
        and cp.periodo_id=?', [$cuentaPeriodoPadre->cuenta_id, $cuentaPeriodoPadre->periodo_id]);
        $cuentaPeriodoPadre->total=0;
        foreach ($cuentasPHijos as $cuentaHijo) {
            $cuentaPeriodoPadre->total= $cuentaPeriodoPadre->total+ $cuentaHijo->total;
        }
        $cuentaPeriodoPadre->save();
        $cuenta=Cuenta::Where('id', $cuentaPeriodoPadre->cuenta_id)->first();
        if($cuenta->padre_id!=null){
            $repeticion=$this->modificarPadre($cuenta->padre_id, $id_periodo);
        }
        return true;
    }

    //Funcion para modificar el total de las cuentas hijas
    public function modificarHijos($cuentaPadre){
        $cuentasPHijos= CuentaPeriodo::whereRaw('  
        cuenta_id in 
        (select id from cuenta where padre_id=?)
        and periodo_id=?', [$cuentaPadre->cuenta_id, $cuentaPadre->periodo_id])->get();
        //dd([$cuentaPadre]);
        foreach ($cuentasPHijos as $cuentaHijo) {                        
            $cuentaHijoM=$this->actualizar(0, $cuentaHijo);
        }
        return true;
    }
}

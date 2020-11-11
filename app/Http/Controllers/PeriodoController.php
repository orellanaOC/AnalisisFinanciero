<?php

namespace App\Http\Controllers;

use App\Empresa;
use Illuminate\Http\Request;
use App\Periodo;

class PeriodoController extends Controller
{
    //
    public function index(){
        $periodos= Periodo::orderBy('id','desc')->get();

        return view('finanzasViews.periodo.index',['periodos'=>$periodos]);
    }
    public function store(Request $request){



        if(strlen($request->anio)==4){
            $idUsuarioLogeado=auth()->user()->id;
            $empresa= Empresa::where('user_id', $idUsuarioLogeado)->first();
            //return Periodo::where('empresa_id',$empresa->id)->get();
            $comprobar= count(Periodo::where('empresa_id',$empresa->id)->get());

            if($comprobar==0){
                $periodo= new Periodo();
                //$idUsuarioLogeado=auth()->user()->id;
                //$empresa= Empresa::where('user_id', $idUsuarioLogeado)->first();
                $periodo->year=$request->anio;
                $periodo->empresa_id=$empresa->id;
                $periodo->acciones =$request->acciones;
                $periodo->save();
                return redirect()->route('periodo.index');

            }
            else{
                $periodoExiste=Periodo::orderBy('year','desc')->where('year', '<=', $request->anio)->where('empresa_id',$empresa->id)->first();
                if($periodoExiste==null){
                    return redirect()->route('periodo.index')->with('error','El año es menor al primer periodo');
                }
                else{
                    if($periodoExiste->year>=$request->anio){
                        return redirect()->route('periodo.index')->with('error','El periodo del año ingresado ya existe');
                    }
                    else{
                        if($request->anio-$periodoExiste->year==1){

                            $periodo= new Periodo();
                            //$idUsuarioLogeado=auth()->user()->id;
                            //$empresa= Empresa::where('user_id', $idUsuarioLogeado)->first();
                            $periodo->year=$request->anio;
                            $periodo->empresa_id=$empresa->id;
                            $periodo->acciones =$request->acciones;
                            $periodo->save();
                            return redirect()->route('periodo.index');
                        }
                        else{
                            return redirect()->route('periodo.index')->with('error','No puede ingresar un periodo con 2 o mas años de diferencia');

                        }
                    }
                }
            }
        }
        else{

            return redirect()->route('periodo.index')->with('error','Debe de tener un formato valido YYYY');
        }
    }

    public function destroy(Request $request,$id)
    {
        $periodo=Periodo::find($id);
        $periodo->delete();
        return redirect()->route('periodo.index');
    }


}

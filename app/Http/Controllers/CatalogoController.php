<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoCuenta;
use App\Cuenta;
use App\Empresa;

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
        dd($request->request);
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
}

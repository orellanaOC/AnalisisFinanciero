<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('dashboard');
    }

    /*voy a usar este controlador para probar vistas y cosas asi*/
    //vista estatica catalogo de cuentas

    public function formulas(){
        return view('simpleViews.formulas.index');
    }
    public function analisis_sector(){
        return view('finanzasViews.analisisSector.index');
    }
    public function empresa_individual(){
        return view('simpleViews.empresa.index');
    }
    public function estado_resultado_index(){
        return view('finanzasViews.estadoResultados.index');
    }
    public function estado_resultado_create(){
        return view('finanzasViews.estadoResultados.create');
    }
    public function balance_general_index(){

        
        return view('finanzasViews.periodo.index');
    }
    public function balance_general_create(){
        return view('finanzasViews.balanceGeneral.create');
    }    
    
    public function ratios(){
        return view('finanzasViews.analisisSector.ratios');
    }
}

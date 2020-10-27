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
    public function catalogo1(){
        return view('simpleViews.catalogo.index');
    }
    public function catalogo2(){
        return view('simpleViews.catalogo.create');
    }

}

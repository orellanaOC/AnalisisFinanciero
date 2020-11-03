@extends('layouts.app', ['pageSlug' => 'empresa'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            <h2 class="card-title">Análisis individual de la empresa</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <h4 class="card-title">Análisis vertical</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <select class="form-control">
                                <option class="selectorCorreccion">--Año del análisis--</option>
                                <option class="selectorCorreccion">2015</option>
                                <option class="selectorCorreccion">2016</option>
                                <option class="selectorCorreccion">2017</option>
                            </select>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p class="text-bold">Análisis:</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in 
                                    reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <h4 class="card-title">Análisis horizontal</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-3">
                            <select class="form-control">
                                <option class="selectorCorreccion">--Año del análisis--</option>
                                <option class="selectorCorreccion">2015</option>
                                <option class="selectorCorreccion">2016</option>
                                <option class="selectorCorreccion">2017</option>
                            </select>
                        </div>
                        vs.
                        <div class="col-md-3">
                            <select class="form-control">
                                <option class="selectorCorreccion">--Año del análisis--</option>
                                <option class="selectorCorreccion">2015</option>
                                <option class="selectorCorreccion">2016</option>
                                <option class="selectorCorreccion">2017</option>
                            </select>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p class="text-bold">Análisis:</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in 
                                    reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>  
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <h4 class="card-title">Ratios</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <select class="form-control">
                                <option class="selectorCorreccion">--Año del análisis--</option>
                                <option class="selectorCorreccion">2015</option>
                                <option class="selectorCorreccion">2016</option>
                                <option class="selectorCorreccion">2017</option>
                            </select>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p class="text-bold">Análisis:</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in 
                                    reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                        </div>
                    </div>
                    <table class="table tablesorter" id="">
                        <thead class=" text-primary">
                            <tr>
                                <th>[Tipo de ratio]</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Ratio 1 con nombre largo</td>
                                <td>00.00</td>
                                <td>
                                    <p class="text-bold">Análisis:</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in 
                                        reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                                    </td>
                            </tr>
                            <tr>
                                <td>Ratio 2 con nombre largo</td>
                                <td>00.00</td>
                                <td>
                                    <p class="text-bold">Análisis:</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in 
                                        reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                                    </td>
                            </tr>
                            <tr>
                                <td>Ratio 3 con nombre largo</td>
                                <td>00.00</td>
                                <td>
                                    <p class="text-bold">Análisis:</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in 
                                        reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                                    </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>        
    </div>   
@endsection

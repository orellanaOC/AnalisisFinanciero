@extends('layouts.app', ['pageSlug' => 'analisis'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            <h2 class="card-title">Análisis del sector</h2>
                        </div>
                        <div class="col-md-2">
                          <a class="btn btn-primary" href="{{ route('catalogo_prueba_create') }}">+ Fórmula</i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <select class="form-control">
                                <option class="selectorCorreccion">--Año del análisis--</option>
                                <option class="selectorCorreccion">2015</option>
                                <option class="selectorCorreccion">2016</option>
                                <option class="selectorCorreccion">2017</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <select class="form-control">
                                <option class="selectorCorreccion">--Sector--</option>
                                <option class="selectorCorreccion">Sector industrial</option>
                                <option class="selectorCorreccion">Sector comercial</option>
                                <option class="selectorCorreccion">Otro sector</option>
                            </select>
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
                    <h4 class="card-title"></h4>
                </div>
                <div class="card-body">
                <!--listado de todas las cuentas registradas-->
                <!--TODO se debe tener un seeder de las cuentas mas basicas, comunes a todas las empresas-->
                    <table class="table tablesorter" id="">
                        <thead class=" text-primary">
                            <tr>
                                <th>[Tipo de ratio]</th>
                                <th>[Empresa A]</th>
                                <th>[Empresa B]</th>
                                <th>&nbsp;</th>
                            </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Ratio 1 con nombre largo</td>
                            <td>00.00</td>
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
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <h4 class="card-title"></h4>
                </div>
                <div class="card-body">
                <!--listado de todas las cuentas registradas-->
                <!--TODO se debe tener un seeder de las cuentas mas basicas, comunes a todas las empresas-->
                    <table class="table tablesorter" id="">
                        <thead class=" text-primary">
                            <tr>
                                <th>[Tipo de ratio]</th>
                                <th>[Empresa A]</th>
                                <th>[Empresa B]</th>
                                <th>&nbsp;</th>
                            </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Ratio 1 con nombre largo</td>
                            <td>00.00</td>
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
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <h4 class="card-title"></h4>
                </div>
                <div class="card-body">
                <!--listado de todas las cuentas registradas-->
                <!--TODO se debe tener un seeder de las cuentas mas basicas, comunes a todas las empresas-->
                    <table class="table tablesorter" id="">
                        <thead class=" text-primary">
                            <tr>
                                <th>[Tipo de ratio]</th>
                                <th>[Empresa A]</th>
                                <th>[Empresa B]</th>
                                <th>&nbsp;</th>
                            </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Ratio 1 con nombre largo</td>
                            <td>00.00</td>
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
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <h4 class="card-title"></h4>
                </div>
                <div class="card-body">
                <!--listado de todas las cuentas registradas-->
                <!--TODO se debe tener un seeder de las cuentas mas basicas, comunes a todas las empresas-->
                    <table class="table tablesorter" id="">
                        <thead class=" text-primary">
                            <tr>
                                <th>[Tipo de ratio]</th>
                                <th>[Empresa A]</th>
                                <th>[Empresa B]</th>
                                <th>&nbsp;</th>
                            </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Ratio 1 con nombre largo</td>
                            <td>00.00</td>
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
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <h4 class="card-title"></h4>
                </div>
                <div class="card-body">
                <!--listado de todas las cuentas registradas-->
                <!--TODO se debe tener un seeder de las cuentas mas basicas, comunes a todas las empresas-->
                    <table class="table tablesorter" id="">
                        <thead class=" text-primary">
                            <tr>
                                <th>[Tipo de ratio]</th>
                                <th>[Empresa A]</th>
                                <th>[Empresa B]</th>
                                <th>&nbsp;</th>
                            </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Ratio 1 con nombre largo</td>
                            <td>00.00</td>
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

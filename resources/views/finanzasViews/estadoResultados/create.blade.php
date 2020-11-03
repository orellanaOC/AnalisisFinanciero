@extends('layouts.app', ['pageSlug' => 'estado_de_resultados_create'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h2 class="card-title">Registrar estado de resultados</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="text-center">Ingresa tu estado de resultados manualmente</p><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <table class="table tablesorter">
                                <tr>
                                    <th>Activo corriente</th>
                                    <td>00.00</td>
                                    <td> 
                                        <select class="form-control">
                                            <option class="selectorCorreccion">--Seleccionar cuenta--</option>
                                            <option class="selectorCorreccion">Inventario</option>
                                            <option class="selectorCorreccion">Activos circulantes</option>
                                            <option class="selectorCorreccion">Capital</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Efectivo y equivalente</th>
                                    <td>00.00</td>
                                    <td> 
                                        <select class="form-control">
                                            <option class="selectorCorreccion">--Seleccionar cuenta--</option>
                                            <option class="selectorCorreccion">Inventario</option>
                                            <option class="selectorCorreccion">Activos circulantes</option>
                                            <option class="selectorCorreccion">Capital</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Activo corriente</th>
                                    <td>00.00</td>
                                    <td> 
                                        <select class="form-control">
                                            <option class="selectorCorreccion">--Seleccionar cuenta--</option>
                                            <option class="selectorCorreccion">Inventario</option>
                                            <option class="selectorCorreccion">Activos circulantes</option>
                                            <option class="selectorCorreccion">Capital</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Efectivo y equivalente</th>
                                    <td>00.00</td>
                                    <td> 
                                        <select class="form-control">
                                            <option class="selectorCorreccion">--Seleccionar cuenta--</option>
                                            <option class="selectorCorreccion">Inventario</option>
                                            <option class="selectorCorreccion">Activos circulantes</option>
                                            <option class="selectorCorreccion">Capital</option>
                                        </select>
                                    </td>
                                </tr><tr>
                                    <th>Total de pasivo de patrimonio</th>
                                    <td>00.00</td>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>                        
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <br><br><p class="text-center">O puedes subir tu archivo .xlsx y cargar de una tu estado de resultados</p><br>
                        </div>
                    </div>
                    <!-- input de archivos normalito feo-->
                    <div class="row">
                        <div class="col-md-12">
                            <input class="form-control-file" type="file">                        
                        </div>
                    </div>

                    <!--input de archivos con estilo>
                    <div-- class="form-group form-file-upload form-file-multiple">
                        <input type="file" multiple="" class="inputFileHidden">
                        <div class="input-group">
                            <input type="text" class="form-control inputFileVisible" placeholder="Seleccionar archivo">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-fab btn-round btn-primary">
                                    <i class="tim-icons icon-attach-87"></i>
                                </button>
                            </span>
                        </div>
                    </div-->


                    <br><br>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8 text-center">
                            <button class="btn btn-primary"> Guardar </button>                          
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

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
                                    <th>{{$vinculos[0][0]->nombre}}</th>
                                    <td><input value="{{0}}" name="ventas"  class="form-control form-control-sm" type="number"></td>
                                </tr>
                                <tr>
                                    <th>{{$vinculos[6][0]->nombre}}</th>
                                    <td><input value="{{0}}" name="devolucion_venta"  class="form-control form-control-sm" type="number"></td>
                                </tr> 
                                <tr>
                                    <th>{{$vinculos[7][0]->nombre}}</th>
                                    <td><input value="{{0}}" name="descuento_venta"  class="form-control form-control-sm" type="number"></td>
                                </tr> 
                                <tr>
                                    <th class="text-primary">Ventas netas</th>
                                    <td><input value="{{$ER->ventas_netas ?? '0'}}" name="ventas_neta"  class="form-control form-control-sm" type="number"></td>
                                </tr> 
                                <tr>
                                    <th>{{$vinculos[1][0]->nombre}}</th>
                                    <td><input value="{{$vinculos[1][0]->total ?? '0'}}" name="costos_venta"  class="form-control form-control-sm" type="number"></td>
                                </tr>
                                <tr>
                                    <th class="text-primary">Utilidad Bruta</th>
                                    <td><input value="{{$ER->utilidad_bruta ?? '0'}}" name="utilidad_bruta"  class="form-control form-control-sm" type="number"></td>
                                </tr>
                                <tr>
                                    <th>Gastos de operacion</th>
                                    <td><input value="{{0}}" name="gastos_operacion"  class="form-control form-control-sm" type="number"></td>
                                </tr>
                                <tr>
                                    <th class="text-primary">Utilidad operativa</th>
                                    <td><input value="{{0}}" name="utilidad_operativa"  class="form-control form-control-sm" type="number"></td>
                                </tr>
                                <tr>
                                    <th>Otros ingresos</th>
                                    <td><input value="{{0}}" name="otros_ingresos"  class="form-control form-control-sm" type="number"></td>
                                </tr>
                                <tr>
                                    <th>Otros gastos</th>
                                    <td><input value="{{0}}" name="otros_gastos"  class="form-control form-control-sm" type="number"></td>
                                </tr>
                                <tr>
                                    <th class="text-primary">Utilidad antes de impuestos</th>
                                    <td><input value="{{$ER->utilidad_antes_de_i ?? '0'}}" name="utilidad_adi"  class="form-control form-control-sm" type="number"></td>
                                </tr> 
                                <tr>
                                    <th>Impuestos sobre la renta</th>
                                    <td><input value="{{$ER->impuestos ?? '0'}}" name="impuestos"  class="form-control form-control-sm" type="number"></td>
                                </tr> 
                                <tr>
                                    <th class="text-primary">Utilida neta</th>
                                    <td><input value="{{$ER->utilidad_neta ?? '0'}}" name="utilidad_neta"  class="form-control form-control-sm" type="number"></td>
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

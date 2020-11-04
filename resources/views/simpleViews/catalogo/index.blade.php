@extends('layouts.app', ['pageSlug' => 'catalogo'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h2 class="card-title">Catálogo de cuentas</h2>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#aniadir_auto">+ Catálogo</i></button>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#aniadir_manual">+ Cuenta</i></button>
                        </div>
                        <!-- Modal de ingreso automatica -->
                        <div class="modal fade" id="aniadir_auto" tabindex="-1" role="dialog" aria-labelledby="auto_label" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="auto_label">Ingresar catálogo completo</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input class="form-control-file" type="file">                        
                                    </div>
                                </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="button" class="btn btn-primary">Guardar</button>
                                </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal de ingreso manual -->
                        <div class="modal fade" id="aniadir_manual" tabindex="-1" role="dialog" aria-labelledby="manual_label" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="manual_label">Registrar una cuenta nueva</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('cuenta_store')}}" method="post">
                                        <div class="row">
                                            <div class="ml-auto col-md-5">
                                                <input class="form-control" placeholder="Código">                        
                                            </div>
                                            <div class="col-md-5 mr-auto">
                                                <input class="form-control" placeholder="Nombre de la cuenta">                        
                                            </div>
                                        </div>
                                        <p><br></p>
                                        <div class="row">    
                                            <div class="ml-auto col-md-5">
                                                <select class="form-control">
                                                    <option value="-1" class="selectorCorreccion">--Seleccionar un tipo--</option>
                                                    @foreach ($tipoCuenta as $tipo)
                                                    <option value="{{$tipo->id}}" class="selectorCorreccion">{{$tipo->nombre}}</option>
                                                    @endforeach
                                                </select>                        
                                            </div>
                                            <div class="mr-auto col-md-5">
                                                <select class="form-control">
                                                    <option value="-1" class="selectorCorreccion">--Seleccionar un padre de cuenta--</option>
                                                    @foreach ($tipoCuenta as $tipo)
                                                    <option value="{{$tipo->id}}" class="selectorCorreccion">{{$tipo->nombre}}</option>
                                                    @endforeach
                                                </select>                        
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <button type="button" class="btn btn-primary">Registrar</button>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <!--listado de todas las cuentas registradas-->
                    <!--TODO se debe tener un seeder de las cuentas mas basicas, comunes a todas las empresas-->
                        <table class="table tablesorter" id="">
                            <thead class=" text-primary">
                                <tr>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Tipo</th>
                                    <!--th class="text-center">
                                        Salary
                                    </th-->
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>activo</td>
                                    <td>activo</td>
                                </tr>
                                <tr>
                                    <td>1.1</td>
                                    <td>activo</td>
                                    <td>activo</td>
                                </tr>
                                <tr>
                                    <td>1.1.1</td>
                                    <td>activo</td>
                                    <td>activo</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>activo</td>
                                    <td>activo</td>
                                </tr>
                                <tr>
                                    <td>2.1</td>
                                    <td>activo</td>
                                    <td>activo</td>
                                </tr>
                                <tr>
                                    <td>2.1.1</td>
                                    <td>activo</td>
                                    <td>activo</td>
                                </tr>
                                <tr>
                                    <td>2.1.2</td>
                                    <td>activo</td>
                                    <td>activo</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app', ['pageSlug' => 'dashboard'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            <h4 class="card-title">Catálogo de cuentas</h4>
                        </div>
                        <div class="col-md-2">
                          <a class="btn btn-primary" href="{{ route('catalogo_prueba_create') }}">+ Cuenta</i></a>
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
                                    <th>
                                        Código
                                    </th>
                                    <th>
                                        Nombre
                                    </th>
                                    <th>
                                        Tipo
                                    </th>
                                    <!--th class="text-center">
                                        Salary
                                    </th-->
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                      1
                                    </td>
                                    <td>
                                      activo
                                    </td>
                                    <td>
                                      activo
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                      1.1
                                    </td>
                                    <td>
                                      activo
                                    </td>
                                    <td>
                                      activo
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                      1.1.1
                                    </td>
                                    <td>
                                      activo
                                    </td>
                                    <td>
                                      activo
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                      2
                                    </td>
                                    <td>
                                      activo
                                    </td>
                                    <td>
                                      activo
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                      2.1
                                    </td>
                                    <td>
                                      activo
                                    </td>
                                    <td>
                                      activo
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                      2.1.1
                                    </td>
                                    <td>
                                      activo
                                    </td>
                                    <td>
                                      activo
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                      2.1.2
                                    </td>
                                    <td>
                                      activo
                                    </td>
                                    <td>
                                      activo
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

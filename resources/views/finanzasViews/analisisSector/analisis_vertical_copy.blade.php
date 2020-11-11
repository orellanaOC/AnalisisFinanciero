@extends('finanzasViews.analisisSector.analisis_vertical')

@section('cuerpo_analisis')

        <div class="table-responsive">
            <table>
                <!--Foreach principal-->
                <tr>
                    <th class="text-center">Codigo</th>
                    <th class=" text-center">Cuenta</th>
                    <th class="text-center">Valor</th>
                    <th class="text-center">Porcentaje</th>
                </tr>
                <!--foreach para Activos -->
                @foreach ($cuentasActivo as $cuenta)
                    @if ($cuenta->id!=$vinculaciones[0][0]->id && $cuenta->padre_id==$vinculaciones[0][0]->id)
                    @foreach ($cuentasActivo as $cuentaHijo2)
                        @if ($cuentaHijo2->padre_id== $cuenta->id)
                        <tr>
                            <td>{{$cuentaHijo2->codigo}}</td>
                            <th>{{$cuentaHijo2->nombre}}</th>
                            <td><input value="{{$cuentaHijo2->total}}" name="cuenta" class="form-control" type="number" disabled></td>
                            <td class=" text-center">xx%</td>
                        </tr>                            
                        @endif
                    @endforeach
                    <tr>
                        <td>{{$cuenta->codigo}}</td>
                        <th>{{$cuenta->nombre}}</th>
                        <td><input value="{{$cuenta->total}}" name="cuenta" class="form-control" type="number" disabled></td>
                        <td class=" text-center">xx%</td>
                    </tr>
                    @endif
                @endforeach
                <tr>
                    <td>{{$vinculaciones[0][0]->codigo}}</td>
                    <th>{{$vinculaciones[0][0]->nombre}}</th>
                    <td><input value="{{$vinculaciones[0][0]->total}}" name="cuenta" class="form-control" type="number" disabled></td>
                    <td class=" text-center">xx%</td>
                </tr>
                <!--foreach para Pasivos -->
                @foreach ($cuentasPasivo as $cuenta)
                    @if ($cuenta->id!=$vinculaciones[1][0]->id && $cuenta->padre_id==$vinculaciones[1][0]->id)
                    @foreach ($cuentasPasivo as $cuentaHijo2)
                        @if ($cuentaHijo2->padre_id== $cuenta->id)
                        <tr>
                            <td>{{$cuentaHijo2->codigo}}</td>
                            <th>{{$cuentaHijo2->nombre}}</th>
                            <td><input value="{{$cuentaHijo2->total}}" name="cuenta" class="form-control" type="number" disabled></td>
                            <td class=" text-center">xx%</td>
                        </tr>                            
                        @endif
                    @endforeach
                    <tr>
                        <td>{{$cuenta->codigo}}</td>
                        <th>{{$cuenta->nombre}}</th>
                        <td><input value="{{$cuenta->total}}" name="cuenta" class="form-control" type="number" disabled></td>
                        <td class=" text-center">xx%</td>
                    </tr>
                    @endif
                @endforeach
                <tr>
                    <td>{{$vinculaciones[1][0]->codigo}}</td>
                    <th>{{$vinculaciones[1][0]->nombre}}</th>
                    <td><input value="{{$vinculaciones[1][0]->total}}" name="cuenta" class="form-control" type="number" disabled></td>
                    <td class=" text-center">xx%</td>
                </tr>
                <!--foreach para Capital -->
                @foreach ($cuentasCapital as $cuenta)
                    @if ($cuenta->id!=$vinculaciones[2][0]->id && $cuenta->padre_id==$vinculaciones[2][0]->id)
                    @foreach ($cuentasCapital as $cuentaHijo2)
                        @if ($cuentaHijo2->padre_id== $cuenta->id)
                        <tr>
                            <td>{{$cuentaHijo2->codigo}}</td>
                            <th>{{$cuentaHijo2->nombre}}</th>
                            <td><input value="{{$cuentaHijo2->total}}" name="cuenta" class="form-control" type="number" disabled></td>
                            <td class=" text-center">xx%</td>
                        </tr>                            
                        @endif
                    @endforeach
                    <tr>
                        <td>{{$cuenta->codigo}}</td>
                        <th>{{$cuenta->nombre}}</th>
                        <td><input value="{{$cuenta->total}}" name="cuenta" class="form-control" type="number" disabled></td>
                        <td class=" text-center">xx%</td>
                    </tr>
                    @endif
                @endforeach
                <tr>
                    <td>{{$vinculaciones[2][0]->codigo}}</td>
                    <th>{{$vinculaciones[2][0]->nombre}}</th>
                    <td><input value="{{$vinculaciones[2][0]->total}}" name="cuenta" class="form-control" type="number" disabled></td>
                    <td class=" text-center">xx%</td>
                </tr>                
            </table>
        </div>

@endsection

@extends('finanzasViews.analisisSector.analisis_vertical')

@section('cuerpo_analisis')
        <div class="table-responsive">
            <table class="table">
                <!--Foreach principal-->
                <tr>
                    <th>Cuenta</th>
                    <th></th>
                    <th class="text-right">Valor</th>
                    <th class="text-right">Porcentaje</th>
                </tr>
                <!--foreach para Activos -->
                @foreach ($cuentasActivo as $cuenta)
                    @if ($cuenta->id!=$vinculaciones[0][0]->id && $cuenta->padre_id==$vinculaciones[0][0]->id)
                        @foreach ($cuentasActivo as $cuentaHijo2)
                            @if ($cuentaHijo2->padre_id== $cuenta->id)
                                @foreach ($cuentasActivo as $cuentaHijo3)
                                    @if ($cuentaHijo3->padre_id == $cuentaHijo2->id)
                                        <tr>
                                            <td>{{$cuentaHijo3->nombre}}</td>
                                            <td class="text-right">$</td>
                                            <td class="text-right">{{$cuentaHijo3->total ?? '0.00'}}</td>
                                            <td class="text-right">{{$cuentaHijo3->porcentaje ?? '0.00'}} %</td>
                                        </tr>
                                    @endif
                                @endforeach
                                <tr>
                                    <th>{{$cuentaHijo2->nombre}}</th>
                                    <td class="text-right">$</td>
                                    <td class="text-right">{{$cuentaHijo2->total ?? '0.00'}}</td>
                                    <td class="text-right">{{$cuentaHijo2->porcentaje ?? '0.00'}} %</td>
                                </tr>                            
                            @endif
                        @endforeach
                        <tr bgcolor="#F5F2F2">
                            <th>{{$cuenta->nombre}}</th>
                            <td class="text-right">$</td>
                            <td class="text-right">{{$cuenta->total ?? '0.00'}}</td>
                            <td class="text-right">{{$cuenta->porcentaje ?? '0.00'}} %</td>
                        </tr>
                    @endif
                @endforeach
                <tr bgcolor="#8D8D8D">
                    <th class="text-white">{{$vinculaciones[0][0]->nombre}}</th>
                    <th class="text-right text-white">$</th>
                    <th class="text-right text-white">{{$vinculaciones[0][0]->total ?? '0.00'}}</th>
                    <th class="text-right text-white">{{$vinculaciones[0][0]->porcentaje ?? '0.00'}} %</th>
                </tr>
                <!--foreach para Pasivos -->
                @foreach ($cuentasPasivo as $cuenta)
                    @if ($cuenta->id!=$vinculaciones[1][0]->id && $cuenta->padre_id==$vinculaciones[1][0]->id)
                        @foreach ($cuentasPasivo as $cuentaHijo2)
                            @if ($cuentaHijo2->padre_id== $cuenta->id)
                                @foreach ($cuentasPasivo as $cuentaHijo3)
                                    @if ($cuentaHijo3->padre_id == $cuentaHijo2->id)
                                        <tr>
                                            <td>{{$cuentaHijo3->nombre}}</td>
                                            <td class="text-right">$</td>
                                            <td class="text-right">{{$cuentaHijo3->total ?? '0.00'}}</td>
                                            <td class="text-right">{{$cuentaHijo3->porcentaje ?? '0.00'}} %</td>
                                        </tr>
                                    @endif
                                @endforeach
                                <tr>
                                    <th>{{$cuentaHijo2->nombre}}</th>
                                    <td class="text-right">$</td>
                                    <td class="text-right">{{$cuentaHijo2->total ?? '0.00'}}</td>
                                    <td class="text-right">{{$cuentaHijo2->porcentaje ?? '0.00'}} %</td>
                                </tr>                            
                            @endif
                        @endforeach
                        <tr bgcolor="#F5F2F2">
                            <th>{{$cuenta->nombre}}</th>
                            <td class="text-right">$</td>
                            <td class="text-right">{{$cuenta->total ?? '0.00'}}</td>
                            <td class="text-right">{{$cuenta->porcentaje ?? '0.00'}} %</td>
                        </tr>
                    @endif
                @endforeach
                <tr bgcolor="#8D8D8D">
                    <th class="text-white">{{$vinculaciones[1][0]->nombre}}</th>
                    <th class="text-right text-white">$</th>
                    <th class="text-right text-white">{{$vinculaciones[1][0]->total ?? '0.00'}}</th>
                    <th class="text-right text-white">{{$vinculaciones[1][0]->porcentaje ?? '0.00'}} %</th>
                </tr>
                <!--foreach para Capital -->
                @foreach ($cuentasCapital as $cuenta)
                    @if ($cuenta->id!=$vinculaciones[2][0]->id && $cuenta->padre_id==$vinculaciones[2][0]->id)
                        @foreach ($cuentasCapital as $cuentaHijo2)
                            @if ($cuentaHijo2->padre_id== $cuenta->id)
                                @foreach ($cuentasCapital as $cuentaHijo3)
                                    @if ($cuentaHijo3->padre_id == $cuentaHijo2->id)
                                        <tr>
                                            <td>{{$cuentaHijo3->nombre}}</td>
                                            <td class="text-right">$</td>
                                            <td class="text-right">{{$cuentaHijo3->total ?? '0.00'}}</td>
                                            <td class="text-right">{{$cuentaHijo3->porcentaje ?? '0.00'}} %</td>
                                        </tr>
                                    @endif
                                @endforeach
                                <tr>
                                    <th>{{$cuentaHijo2->nombre}}</th>
                                    <td class="text-right">$</td>
                                    <td class="text-right">{{$cuentaHijo2->total ?? '0.00'}}</td>
                                    <td class="text-right">{{$cuentaHijo2->porcentaje ?? '0.00'}} %</td>
                                </tr>                            
                            @endif
                        @endforeach
                        <tr bgcolor="#F5F2F2">
                            <th>{{$cuenta->nombre}}</th>
                            <td class="text-right">$</td>
                            <td class="text-right">{{$cuenta->total ?? '0.00'}}</td>
                            <td class="text-right">{{$cuenta->porcentaje ?? '0.00'}} %</td>
                        </tr>
                    @endif
                @endforeach
                <tr bgcolor="#8D8D8D">
                    <th class="text-white">{{$vinculaciones[2][0]->nombre}}</th>
                    <th class="text-right text-white">$</th>
                    <th class="text-right text-white">{{$vinculaciones[2][0]->total ?? '0.00'}}</th>
                    <th class="text-right text-white">{{$vinculaciones[2][0]->porcentaje ?? '0.00'}} %</th>
                </tr>                
            </table>
        </div>

@endsection

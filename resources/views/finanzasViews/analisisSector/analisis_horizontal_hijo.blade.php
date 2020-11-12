@extends('finanzasViews.analisisSector.analisis_horizontal')

@section('cuerpo_analisis')
<div class="table-responsive">
    <table class="table">
        <!--Foreach principal-->
        <tr>
            <th>Cuenta</th>
            <th class="text-right text-white"></th>
            <th class="text-right">Periodo A</th>
            <th class="text-right text-white"></th>
            <th class="text-right">Periodo B</th>
            <th class="text-right text-white"></th>
            <th class="text-right">Resta</th>
            <th class="text-right">Porcentaje</th>
        </tr>
        <!--Foreach para cuentas principales (ACtivo, pasivo, Capital)-->
        @foreach ($cuentas as $cuenta)
        @if ($cuenta->id==$vinculos[0][0]->id || $cuenta->id==$vinculos[1][0]->id || $cuenta->id==$vinculos[2][0]->id)
            <!--Foreach para cuentas de segundo nivel-->
            @foreach ($cuentas as $cuentaHijo2)
            @if ($cuentaHijo2->padre_id==$cuenta->id)
                <!--Foreach para cuentas de tercer nivel-->
                @foreach ($cuentas as $cuentaHijo3)
                @if ($cuentaHijo3->padre_id==$cuentaHijo2->id)
                    <!--Foreach para cuentas de cuarto nivel-->
                    @foreach ($cuentas as $cuentaHijo4)
                    @if ($cuentaHijo4->padre_id==$cuentaHijo3->id)
                    <tr>
                        <td>{{$cuentaHijo4->nombre}}</td>
                        <td class="text-right">$</td>
                        <td class="text-right">{{$cuentaHijo4->total1 ?? '0.00'}}</td>
                        <td class="text-right">$</td>
                        <td class="text-right">{{$cuentaHijo4->total2 ?? '0.00'}}</td>
                        <td class="text-right">$</td>
                        <td class="text-right">{{$cuentaHijo4->resta ?? '0.00'}}</td>
                        <td class="text-right">{{$cuentaHijo4->porcentaje ?? '0.00'}} %</td>                       
                    </tr> 
                    @endif
                    @endforeach
                <tr>
                    <th>{{$cuentaHijo3->nombre}}</th>
                    <td class="text-right">$</td>
                    <td class="text-right">{{$cuentaHijo3->total1 ?? '0.00'}}</td>
                    <td class="text-right">$</td>
                    <td class="text-right">{{$cuentaHijo3->total2 ?? '0.00'}}</td>
                    <td class="text-right">$</td>
                    <td class="text-right">{{$cuentaHijo3->resta ?? '0.00'}}</td>
                    <td class="text-right">{{$cuentaHijo3->porcentaje ?? '0.00'}} %</td>                       
                </tr> 
                @endif
                @endforeach
            <tr bgcolor="#F5F2F2">
                <th>{{$cuentaHijo2->nombre}}</th>
                <td class="text-right">$</td>
                <td class="text-right">{{$cuentaHijo2->total1 ?? '0.00'}}</td>
                <td class="text-right">$</td>
                <td class="text-right">{{$cuentaHijo2->total2 ?? '0.00'}}</td>
                <td class="text-right">$</td>
                <td class="text-right">{{$cuentaHijo2->resta ?? '0.00'}}</td>
                <td class="text-right">{{$cuentaHijo2->porcentaje ?? '0.00'}} %</td>                       
            </tr> 
            @endif
            @endforeach
        <tr bgcolor="#8D8D8D">
            <th class="text-white">{{$cuenta->nombre}}</th>
            <th class="text-right text-white">$</th>
            <th class="text-right text-white">{{$cuenta->total1 ?? '0.00'}}</th>
            <th class="text-right text-white">$</th>
            <th class="text-right text-white">{{$cuenta->total2 ?? '0.00'}}</th>
            <th class="text-right text-white">$</th>
            <th class="text-right text-white">{{$cuenta->resta ?? '0.00'}}</th>
            <th class="text-right text-white">{{$cuenta->porcentaje ?? '0.00'}} %</th>                       
        </tr>                
        @endif
        @endforeach                                     
    </table>
</div>
@endsection

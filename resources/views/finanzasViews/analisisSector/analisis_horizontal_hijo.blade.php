@extends('finanzasViews.analisisSector.analisis_horizontal')

@section('cuerpo_analisis')
<div class="table-responsive">
    <table>
        <!--Foreach principal-->
        <tr>
            <th class="text-center">Codigo</th>
            <th class=" text-center">Cuenta</th>
            <th class="text-center">Periodo A</th>
            <th class="text-center">Periodo B</th>
            <th class="text-center">Resta</th>
            <th class="text-center">Porcentaje</th>
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
                        <td>{{$cuentaHijo4->codigo ?? 'codigo'}}</td>
                        <th>{{$cuentaHijo4->nombre ?? 'nombre de cuenta largoOOOOOOOOOO'}}</th>
                        <td>{{$cuentaHijo4->total1 ?? '0.00'}}</td>
                        <td>{{$cuentaHijo4->total2 ?? '0.00'}}</td>
                        <td>{{$cuentaHijo4->resta ?? '0.00'}}</td>
                        <td>value="{{$cuentaHijo4->porcentaje ?? '0%'}}%</td>                       
                    </tr> 
                    @endif
                    @endforeach
                <tr>
                    <td>{{$cuentaHijo3->codigo ?? 'codigo'}}</td>
                    <th>{{$cuentaHijo3->nombre ?? 'nombre de cuenta largoOOOOOOOOOO'}}</th>
                    <td>{{$cuentaHijo3->total1 ?? '0.00'}}</td>
                    <td>{{$cuentaHijo3->total2 ?? '0.00'}}</td>
                    <td>{{$cuentaHijo3->resta ?? '0.00'}}</td>
                    <td>value="{{$cuentaHijo3->porcentaje ?? '0%'}}%</td>                       
                </tr> 
                @endif
                @endforeach
            <tr>
                <td>{{$cuentaHijo2->codigo ?? 'codigo'}}</td>
                <th>{{$cuentaHijo2->nombre ?? 'nombre de cuenta largoOOOOOOOOOO'}}</th>
                <td>{{$cuentaHijo2->total1 ?? '0.00'}}</td>
                <td>{{$cuentaHijo2->total2 ?? '0.00'}}</td>
                <td>{{$cuentaHijo2->resta ?? '0.00'}}</td>
                <td>value="{{$cuentaHijo2->porcentaje ?? '0%'}}%</td>                       
            </tr> 
            @endif
            @endforeach
        <tr>
            <td>{{$cuenta->codigo ?? 'codigo'}}</td>
            <th>{{$cuenta->nombre ?? 'nombre de cuenta largoOOOOOOOOOO'}}</th>
            <td>{{$cuenta->total1 ?? '0.00'}}</td>
            <td>{{$cuenta->total2 ?? '0.00'}}</td>
            <td>{{$cuenta->resta ?? '0.00'}}</td>
            <td>value="{{$cuenta->porcentaje ?? '0%'}}%</td>                       
        </tr>                
        @endif
        @endforeach                                     
    </table>
</div>
@endsection

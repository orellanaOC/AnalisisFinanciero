@extends('finanzasViews.ratios.individual_padre', ['pageSlug' => 'ratios'])

@section('ratios')
<div class="table-responsive">
    <table class="table">
        <tr>
            <th width = "25%">Razón</th>
            <th width = "25%">Resultado</th>
            <th width = "50%">Análisis</th>
        </tr>
        <tr>
            <th width = "100%">Razones de liquidez</th>
        </tr>
        <tr>
            <th width = "100%">Razones de actividad</th>
        </tr>
        <tr>
            <td>Razón de rotacion de inventario</td>
            <td>{{$rri[0]}}</td>
            <td class="text-justify">{{$rri[1]}}</td>
        </tr>
        <tr>
            <td>Razón de días de inventario</td>
            <td>{{$rdi[0]}}</td>
            <td class="text-justify">{{$rdi[1]}}</td>
        </tr>
        <tr>
            <td>Razón de rotación de cuentas por pagar</td>
            <td>{{$rrcc[0]}}</td>
            <td class="text-justify">{{$rrcc[1]}}</td>
        </tr>
        <tr>
            <td>Razón de período medio de pago</td>
            <td>{{$rri[0]}}</td>
            <td class="text-justify">{{$rri[1]}}</td>
        </tr>
        <tr>
            <td>Razón de período medio de pago</td>
            <td>{{$rri[0]}}</td>
            <td class="text-justify">{{$rri[1]}}</td>
        </tr>
        <tr>
            <td>Razón de rotación de cuentas por cobrar</td>
            <td>{{$rri[0]}}</td>
            <td class="text-justify">{{$rri[1]}}</td>
        </tr>
        <tr>
            <td>Razón de período medio de cobranza</td>
            <td>{{$rri[0]}}</td>
            <td class="text-justify">{{$rri[1]}}</td>
        </tr>
        <tr>
            <td>Índice de rotación de activos totales</td>
            <td>{{$rri[0]}}</td>
            <td class="text-justify">{{$rri[1]}}</td>
        </tr>
        <tr>
            <td>Índice de rotación de activos fijos</td>
            <td>{{$rri[0]}}</td>
            <td class="text-justify">{{$rri[1]}}</td>
        </tr>
        <tr>
            <td>Índice de margen bruto</td>
            <td>{{$rri[0]}}</td>
            <td class="text-justify">{{$rri[1]}}</td>
        </tr>
        <tr>
            <td>Índice de margen operativo</td>
            <td>{{$rri[0]}}</td>
            <td class="text-justify">{{$rri[1]}}</td>
        </tr>
        <tr>
            <th width = "100%">Razones de endeudamiento (apalancamiento)</th>
        </tr>
        <tr>
            <td>Grado de endeudamiento</td>
            <td>{{$rri[0]}}</td>
            <td class="text-justify">{{$rri[1]}}</td>
        </tr>
        <tr>
            <td>Grado de propiedad</td>
            <td>{{$rri[0]}}</td>
            <td class="text-justify">{{$rri[1]}}</td>
        </tr>

        <tr>
            <td>Razón de endeudamiento patrimonial</td>
            <td>{{$rri[0]}}</td>
            <td class="text-justify">{{$rri[1]}}</td>
        </tr>
        <tr>
            <td>Razón de cobertura de gastos financieros</td>
            <td>{{$rri[0]}}</td>
            <td class="text-justify">{{$rri[1]}}</td>
        </tr>
        <tr>
            <th width = "100%">Razones financieras (rentabilidad)</th>
        </tr>
        <tr>
            <td>Rentabilidad Neta del Patrimonio (ROE)</td>
            <td>{{$rri[0]}}</td>
            <td class="text-justify">{{$rri[1]}}</td>
        </tr>
        <tr>
            <td>Rentabilidad por acción</td>
            <td>{{$rri[0]}}</td>
            <td class="text-justify">{{$rri[1]}}</td>
        </tr>
        <tr>
            <td>Rentabilidad de Activos (ROA)</td>
            <td>{{$rri[0]}}</td>
            <td class="text-justify">{{$rri[1]}}</td>
        </tr>
        <tr>
            <td>Rentabilidad sobre ventas</td>
            <td>{{$rri[0]}}</td>
            <td class="text-justify">{{$rri[1]}}</td>
        </tr>
        <tr>
            <td>Rentabilidad sobre inversión</td>
            <td>{{$rri[0]}}</td>
            <td class="text-justify">{{$rri[1]}}</td>
        </tr>
        
    </table>
</div>

@endsection
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
            <td>Razon de Rotacion de Inventario</td>
            <td>{{$rri[0]}}</td>
            <td class="text-justify">{{$rri[1]}}</td>
        </tr>
        <tr>
            <td>Razon de Días de Inventario</td>
            <td>{{$rdi[0]}}</td>
            <td class="text-justify">{{$rdi[1]}}</td>
        </tr>
        <tr>
            <td>Razon de Rotacion de Cuentas por Pagar</td>
            <td>{{$rrcc[0]}}</td>
            <td class="text-justify">{{$rrcc[1]}}</td>
        </tr>
    </table>
</div>

@endsection
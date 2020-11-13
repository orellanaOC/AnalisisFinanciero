@extends('finanzasViews.ratios.individual_padre', ['pageSlug' => 'ratios'])

@section('ratios')
<div class="table-responsive">
    <table class="table">
        <tr>
            <th width = "25%">Razón</th>
            <th width = "25%" class="text-center">Resultado</th>
            <th width = "50%">Análisis</th>
        </tr>
        <tr>
            <th colspan="3">Razones de liquidez</th>
        </tr>
        <tr>
            <th colspan="3">Razones de actividad</th>
        </tr>
        <tr>
            <td>Razón de rotacion de inventario</td>
            <td class="text-center">{{$rri[0]}}</td>
            <td class="text-justify">{{$rri[1]}}</td>
        </tr>
        <tr>
            <td>Razón de días de inventario</td>
            <td class="text-center">{{$rdi[0]}}</td>
            <td class="text-justify">{{$rdi[1]}}</td>
        </tr>
        <tr>
            <td>Rentabilidad por Acción</td>
            <td class="text-center">{{$rpa[0]}}</td>
            <td class="text-justify">{{$rpa[1]}}</td>
        </tr>
        <tr>
            <th colspan="3">Razones de endeudamiento (apalancamiento)</th>
        </tr>
        <tr>
            <th colspan="3">Razones financieras (rentabilidad)</th>
        </tr>
        
    </table>
</div>

@endsection
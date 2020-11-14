@extends('finanzasViews.ratios.sector_padre')

@section('ratios')
<div class="table-responsive">
    <table class="table">
        <tr>
            <th width = "25%">Razón</th>
            <th width = "15%" class="text-right">Resultado</th>
            <th width = "20%" class="text-right">Promedio del sector</th>
            <th width = "5%"></th>
            <th width = "35%"> Análisis</th>
        </tr>
        @foreach ($ratios as $ratio)
        @if ($ratio->double != null)
            <tr>
                <td>{{$ratio->parametro}}</td>
                <td class="text-right">{{$ratio->double}}</th>
                <td class="text-right">00.00</td>
                <td></td>
                <td> Análisis</td>
            </tr>
        @else
            <tr>
                <td>{{$ratio->parametro}}</td>
                <td class="text-right">Indefinido</td>
                <td class="text-right">00.00</td>
                <td></td>
                <td> Análisis</td>
            </tr>
        @endif
            
        @endforeach
        
    </table>
</div>

@endsection
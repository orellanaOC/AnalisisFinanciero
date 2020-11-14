@extends('finanzasViews.ratios.sector_padre')

@section('ratios')
<div class="table-responsive">
    <table class="table">
        <tr>
            <th width = "25%">Razón</th>
            <th width = "14%" class="text-right">Resultado</th>
            <th width = "14%" class="text-right">Promedio</th>
            <th width = "2%"></th>
            <th width = "45%">Análisis</th>
        </tr>
        @for ($i = 0; $i < count($ratios); $i++)
            @if ($ratios[$i]->double != null)
                <tr>
                    <td>{{$ratios[$i]->parametro}}</td>
                    <td class="text-right">{{$ratios[$i]->double}}</th>
                    <td class="text-right">{{number_format($promedios[$i]->avg, 2)}}</td>
                    <td></td>
                    <td class="text-justify">{{$analisis[$i]}}</td>
                </tr>
            @else
                @if($promedios[$i]->avg != null)
                    <tr>
                        <td>{{$ratios[$i]->parametro}}</td>
                        <td class="text-right">Indefinido</td>
                        <td class="text-right">{{number_format($promedios[$i]->avg, 2)}}</td>
                        <td></td>
                        <td class="text-justify">Indefinido</td>
                    </tr>
                @else
                    <tr>
                        <td>{{$ratios[$i]->parametro}}</td>
                        <td class="text-right">Indefinido</td>
                        <td class="text-right">Indefinido</td>
                        <td></td>
                        <td class="text-justify">Indefinido</td>
                    </tr>
                @endif
            @endif
        @endfor        
    </table>
</div>

@endsection
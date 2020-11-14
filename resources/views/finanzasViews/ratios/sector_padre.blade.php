@extends('finanzasViews.analisisSector.layout_analisis', ['pageSlug' => 'ratios_sector'])

@section('contenido_navbar')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h2 class="card-title">Ratios por sector</h2>
            </div>
            <div class="col-md-3 text-right">
                @if (!($calculados ?? true))
                    <a href="{{route('ratio_sector.calcular', $periodo_id)}}" class="btn btn-primary btn-sm" style="color: white">
                        Calcular ratios
                    </a>
                @endif
            </div>

            <div class="col-md-3">
                <select class="form-control" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);" id="ratiosSelector">
                    <option value=-1 hidden disabled selected>Seleccione un período...</option>
                    @foreach ($periodos as $periodo)
                        <option value="{{ route( 'ratio.sector', $periodo->id)}}">{{ $periodo->year }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="card-body">
        @yield('ratios')
    </div>
    <div class="card-footer"></div>
</div>
@endsection
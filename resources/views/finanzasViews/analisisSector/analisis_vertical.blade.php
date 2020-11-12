@extends('finanzasViews.analisisSector.layout_analisis', ['pageSlug' => 'analisis_vertical'])

@section('contenido_navbar')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-8">
                <h2 class="card-title">Análisis Vertical</h2>
            </div>
            <div class="col-md-4">
                    <select onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);" id="AverticalPeriodo" class="form-control">
                        <option value=-1>Seleccione un período...</option>
                        @foreach ($periodos as $periodo)                            
                            <option value="{{ route( 'analisis_vertical.show', $periodo->id)}}">{{$periodo->year}}</option>                            
                        @endforeach
                    </select>
            </div>
        </div>
    </div>
    <div class="card-body">
        @yield('cuerpo_analisis')
    </div>
    <div class="card-footer">

    </div>
</div>
@endsection

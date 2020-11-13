@extends('finanzasViews.analisisSector.layout_analisis', ['pageSlug' => 'ratios'])

@section('contenido_navbar')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-8">
                <h2 class="card-title">Ratios</h2>
            </div>
            <div class="col-md-4">
                <select class="form-control">
                    <option value=-1 hidden disabled selected>Seleccione un período...</option>
                    @foreach ($periodos as $periodo)
                        <option>{{ $periodo->year }}</option>
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
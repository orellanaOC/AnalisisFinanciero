@extends('finanzasViews.analisisSector.layout_analisis', ['pageSlug' => 'analisis_vertical'])

@section('contenido_navbar')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Análisis Vertical</h2>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="ml-auto col-md-4 mr-auto">
                        <select class="form-control">
                            <option value=-1>--Seleccionar un período--</option>
                            <option>fdfdsf</option>
                        </select>
                    </div>
                    @yield('cuerpo_analisis')
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">

    </div>
</div>
@endsection

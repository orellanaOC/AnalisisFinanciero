@extends('layouts.app', ['pageSlug' => 'dashboard'])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="title"><h1>SIAF - Sistema Informático de Análisis Financiero</h1><h3>Preguntas frecuentes</h3></div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h4><b>¿Qué hacer primero?</b></h4>
                            <p>Para poder comenzar a utilizar los servicios de análisis del SIAF, es de vital importancia registrar el catálogo de cuentas de tu empresa. Para ello
                            dirígite a la sección de <a href="{{ route('catalogo_show') }}">Catálogo de cuentas</a>.</p>
                            <br>
                            <h4><b>¿Cómo registrar mi catálogo de cuentas?</b></h4>
                            <p>Tienes dos opciones: Crear tu catálogo de forma manual o subirlo mediante un archivo de extensión .xlsx que siga el formato que te brindamos 
                            en la plantilla de catálogo. Una vez tengas en pantalla todas las cuentas de tu catálogo puede dar clic en el botón 
                            <button class="btn btn-default btn-sm">Confirmar catálogo</button>.</p>
                            <p>Una vez confirmado el registro de tu catálogo, es necesario realizar la vinculación de las cuentas de éste con las cuentas que provee nuestro sistema. 
                            Para así poder realizar los análisis correspondientes, más adelante.</p>
                            <br>
                            <h4><b>¿Por qué crear un período?</b></h4>
                            <p>Para realizar los análisis respectivos al área financiera de tu empresa, es necesario que conozcamos su estado en el tiempo. Para ello
                            puedes dirigirte a la sección de <a href="{{ route('periodo.index') }}">Períodos</a>. Registra período y a continuación, se te presentan 
                            las opciones para el ingreso del balance general y estado de resultados correspondientes a dicho período.</p>
                            <br>
                            <h4><b>¿Qué análisis ofrece SIAF?</b></h4>
                            <p>SIAF ofrece una amplia gama de análisis que solo requieren de que se especifique la información solicitada en las preguntas que anteceden
                            a esta, entre los análisis que ofrecemos están:
                            <ul>
                                <li>Análisis horizontal (requiere del registro de al menos dos períodos)</li>
                                <li>Análisis vertical</li>
                                <li>Razones financieras o ratios</li>

                            </ul>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('black') }}/js/plugins/chartjs.min.js"></script>
    <script>
        $(document).ready(function() {
          demo.initDashboardPageCharts();
        });
    </script>
@endpush

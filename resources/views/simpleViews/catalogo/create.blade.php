@extends('layouts.app', ['pageSlug' => 'dashboard'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="card-title">Registrar cuenta</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="text-center">Ingresa tu cuenta manualmente</p><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <input class="form-control" placeholder="Código">                        
                        </div>
                        <div class="col-md-4">
                            <input class="form-control" placeholder="Nombre de la cuenta">                        
                        </div>
                        <div class="col-md-4">
                            <select class="form-control">
                                <option style="background: black; !important">-Seleccionar un tipo</option>
                                <option style="background: black; !important">Tipo 1</option>
                                <option style="background: black; !important">Tipo 2</option>
                                <option style="background: black; !important">Tipo 3</option>
                            </select>                        
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <br><br><p class="text-center">O puedes subir tu archivo .xlsx y cargar de una vez tu catálogo</p><br>
                        </div>
                    </div>
                    <!-- input de archivos normalito feo-->
                    <div class="row">
                        <div class="col-md-12">
                            <input class="form-control-file" type="file">                        
                        </div>
                    </div>

                    <!--input de archivos con estilo>
                    <div-- class="form-group form-file-upload form-file-multiple">
                        <input type="file" multiple="" class="inputFileHidden">
                        <div class="input-group">
                            <input type="text" class="form-control inputFileVisible" placeholder="Seleccionar archivo">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-fab btn-round btn-primary">
                                    <i class="tim-icons icon-attach-87"></i>
                                </button>
                            </span>
                        </div>
                    </div-->



                </div>
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

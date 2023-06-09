
@extends('brackets/admin-ui::admin.layout.default')


@section('body')

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Cantidad de Usuarios </h5>
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i> {{ $credentialCount}}
                    </div>
                    <div class="card-body">
                        <!-- Tabla para mostrar los registros de Credential -->
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Cantidad de Servicios </h5>
                <p class="card-text">cantidad:</p>    ({{ $serviceCount}}        </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Cantidad de  </h5>
                <p class="card-text">cantidad: </p>            </div>
        </div>
    </div>
</div>
@endsection




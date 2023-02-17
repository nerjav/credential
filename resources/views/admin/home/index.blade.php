@extends('brackets/admin-ui::admin.layout.default')

@section('body')

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Cantidad de Usuarios </h5>
                    <p class="card-text">cantidad:{{ $userCount }} </p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Cantidad de Servicios </h5>
                <p class="card-text">cantidad: </p>            </div>
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

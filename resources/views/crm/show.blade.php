@extends('layouts.principal')

@section('title', 'Ver Servicio Programado')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Servicio Programado</h2>
    <a href="{{ route('crm.index') }}" class="btn btn-secondary">Volver</a>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header"><h5>Datos del Servicio</h5></div>
            <div class="card-body">
                <p><strong>Cliente:</strong> {{ $programado->cliente->nombre ?? 'N/A' }}</p>
                <p><strong>Vehículo:</strong> {{ $programado->vehiculo->placa ?? 'N/A' }}</p>
                <p><strong>Categoría:</strong> {{ $programado->categoria }}</p>
                <p><strong>Servicio:</strong> {{ $programado->servicio }}</p>
                <p><strong>Fecha:</strong> {{ $programado->fecha_programacion->format('d/m/Y') }}</p>
                <p><strong>Estado:</strong> {{ $programado->estado }}</p>
                <p><strong>Observación:</strong> {{ $programado->observacion }}</p>
            </div>
        </div>
    </div>
</div>
@endsection

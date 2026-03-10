@extends('layouts.principal')

@section('title', 'Ver Vehículo')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Vehículo: {{ $vehiculo->placa }}</h2>
    <div>
        <a href="{{ route('vehiculos.edit', $vehiculo) }}" class="btn btn-warning">Editar</a>
        <a href="{{ route('vehiculos.index') }}" class="btn btn-secondary">Volver</a>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header"><h5>Datos del Vehículo</h5></div>
            <div class="card-body">
                <p><strong>Placa:</strong> {{ $vehiculo->placa }}</p>
                <p><strong>Marca:</strong> {{ $vehiculo->marca }}</p>
                <p><strong>Modelo:</strong> {{ $vehiculo->modelo }}</p>
                <p><strong>Año:</strong> {{ $vehiculo->año }}</p>
                <p><strong>Color:</strong> {{ $vehiculo->color }}</p>
                <p><strong>VIN:</strong> {{ $vehiculo->vin }}</p>
                <p><strong>Kilometraje:</strong> {{ number_format($vehiculo->kilometraje) }} km</p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header"><h5>Propietario</h5></div>
            <div class="card-body">
                <p><strong>Nombre:</strong> {{ $vehiculo->cliente->nombre ?? 'N/A' }}</p>
                <p><strong>Cédula:</strong> {{ $vehiculo->cliente->cedula_ruc ?? 'N/A' }}</p>
                <p><strong>Teléfono:</strong> {{ $vehiculo->cliente->telefono ?? 'N/A' }}</p>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header"><h5>Historial de Órdenes de Servicio</h5></div>
    <div class="card-body">
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>Orden</th>
                    <th>Fecha Ingreso</th>
                    <th>Estado</th>
                    <th>Motivo</th>
                </tr>
            </thead>
            <tbody>
                @forelse($vehiculo->ordenServicios as $orden)
                <tr>
                    <td>{{ $orden->id_consecutivo }}</td>
                    <td>{{ $orden->created_at->format('d/m/Y') }}</td>
                    <td>{{ $orden->estado }}</td>
                    <td>{{ $orden->motivo_ingreso }}</td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-muted">No hay órdenes de servicio</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

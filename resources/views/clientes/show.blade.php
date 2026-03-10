@extends('layouts.principal')

@section('title', 'Ver Cliente')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Cliente: {{ $cliente->nombre }}</h2>
    <div>
        <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-warning">Editar</a>
        <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Volver</a>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header"><h5>Datos del Cliente</h5></div>
            <div class="card-body">
                <p><strong>Cédula/RUC:</strong> {{ $cliente->cedula_ruc }}</p>
                <p><strong>Teléfono:</strong> {{ $cliente->telefono }}</p>
                <p><strong>Email:</strong> {{ $cliente->email }}</p>
                <p><strong>Dirección:</strong> {{ $cliente->direccion }}</p>
                <p><strong>Ciudad:</strong> {{ $cliente->ciudad }}</p>
                <p><strong>Observaciones:</strong> {{ $cliente->observaciones }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header"><h5>Vehículos ({{ $cliente->vehiculos->count() }})</h5></div>
            <div class="card-body">
                @forelse($cliente->vehiculos as $vehiculo)
                <p>
                    <strong>{{ $vehiculo->placa }}</strong> - {{ $vehiculo->marca }} {{ $vehiculo->modelo }} ({{ $vehiculo->año }})
                    <a href="{{ route('vehiculos.show', $vehiculo) }}" class="btn btn-sm btn-info">Ver</a>
                </p>
                @empty
                <p class="text-muted">No hay vehículos registrados</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header"><h5>Órdenes de Servicio</h5></div>
    <div class="card-body">
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>Orden</th>
                    <th>Vehículo</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @forelse($cliente->ordenServicios as $orden)
                <tr>
                    <td>{{ $orden->id_consecutivo }}</td>
                    <td>{{ $orden->vehiculo->placa ?? 'N/A' }}</td>
                    <td>{{ $orden->created_at->format('d/m/Y') }}</td>
                    <td>{{ $orden->estado }}</td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-muted">No hay órdenes</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

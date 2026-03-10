@extends('layouts.principal')

@section('title', 'CRM Kanban')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>CRM - Vista Kanban</h2>
    <div>
        <a href="{{ route('crm.index') }}" class="btn btn-secondary">Volver</a>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="card mb-3">
            <div class="card-header bg-primary text-white"><h6>Esta Semana</h6></div>
            <div class="card-body">
                @forelse($pendientes['esta_semana'] ?? [] as $item)
                <div class="card mb-2">
                    <div class="card-body p-2">
                        <strong>{{ $item->vehiculo->placa ?? 'N/A' }}</strong>
                        <p class="mb-0 small">{{ $item->servicio }}</p>
                        <small class="text-muted">{{ $item->fecha_programacion->format('d/m') }}</small>
                    </div>
                </div>
                @empty
                <p class="text-muted small">Sin servicios</p>
                @endforelse
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card mb-3">
            <div class="card-header bg-info text-white"><h6>Próxima Semana</h6></div>
            <div class="card-body">
                @forelse($pendientes['proxima_semana'] ?? [] as $item)
                <div class="card mb-2">
                    <div class="card-body p-2">
                        <strong>{{ $item->vehiculo->placa ?? 'N/A' }}</strong>
                        <p class="mb-0 small">{{ $item->servicio }}</p>
                        <small class="text-muted">{{ $item->fecha_programacion->format('d/m') }}</small>
                    </div>
                </div>
                @empty
                <p class="text-muted small">Sin servicios</p>
                @endforelse
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card mb-3">
            <div class="card-header bg-warning text-dark"><h6>Este Mes</h6></div>
            <div class="card-body">
                @forelse($pendientes['este_mes'] ?? [] as $item)
                <div class="card mb-2">
                    <div class="card-body p-2">
                        <strong>{{ $item->vehiculo->placa ?? 'N/A' }}</strong>
                        <p class="mb-0 small">{{ $item->servicio }}</p>
                        <small class="text-muted">{{ $item->fecha_programacion->format('d/m') }}</small>
                    </div>
                </div>
                @empty
                <p class="text-muted small">Sin servicios</p>
                @endforelse
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card mb-3">
            <div class="card-header bg-secondary text-white"><h6>Próximo Mes</h6></div>
            <div class="card-body">
                @forelse($pendientes['proximo_mes'] ?? [] as $item)
                <div class="card mb-2">
                    <div class="card-body p-2">
                        <strong>{{ $item->vehiculo->placa ?? 'N/A' }}</strong>
                        <p class="mb-0 small">{{ $item->servicio }}</p>
                        <small class="text-muted">{{ $item->fecha_programacion->format('d/m') }}</small>
                    </div>
                </div>
                @empty
                <p class="text-muted small">Sin servicios</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

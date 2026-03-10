@extends('layouts.principal')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Dashboard</h2>
</div>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card card-stat bg-primary text-white">
            <div class="card-body">
                <h5><i class="bi bi-people"></i> Clientes</h5>
                <h2>{{ $clientesCount }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stat bg-info text-white">
            <div class="card-body">
                <h5><i class="bi bi-car-front"></i> Vehículos</h5>
                <h2>{{ $vehiculosCount }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stat bg-warning text-white">
            <div class="card-body">
                <h5><i class="bi bi-wrench"></i> Órdenes Abiertas</h5>
                <h2>{{ $ordenesAbiertas }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stat bg-success text-white">
            <div class="card-body">
                <h5><i class="bi bi-check-circle"></i> Órdenes Terminadas</h5>
                <h2>{{ $ordenesTerminadas }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card card-stat bg-success text-white">
            <div class="card-body">
                <h5><i class="bi bi-cash-stack"></i> Ingresos del Mes</h5>
                <h2>${{ number_format($ingresosMes, 2) }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stat bg-danger text-white">
            <div class="card-body">
                <h5><i class="bi bi-cart"></i> Compras del Mes</h5>
                <h2>${{ number_format($comprasMes, 2) }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-warning text-dark">
                <h5><i class="bi bi-exclamation-triangle"></i> Stock Bajo</h5>
            </div>
            <div class="card-body">
                @if($stockBajo->count() > 0)
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Stock</th>
                            <th>Mínimo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stockBajo as $repuesto)
                        <tr>
                            <td>{{ $repuesto->codigo }}</td>
                            <td>{{ $repuesto->nombre }}</td>
                            <td><span class="badge bg-danger">{{ $repuesto->stock }}</span></td>
                            <td>{{ $repuesto->stock_minimo }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <p class="text-muted">No hay repuestos con stock bajo</p>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>Órden es Recientes</h5>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Orden</th>
                            <th>Cliente</th>
                            <th>Vehículo</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ordenesRecientes as $orden)
                        <tr>
                            <td>{{ $orden->id_consecutivo }}</td>
                            <td>{{ $orden->cliente->nombre ?? 'N/A' }}</td>
                            <td>{{ $orden->vehiculo->placa ?? 'N/A' }}</td>
                            <td>
                                @switch($orden->estado)
                                    @case('recepcion')<span class="badge bg-primary">Recepción</span>@break
                                    @case('diagnostico')<span class="badge bg-info">Diagnóstico</span>@break
                                    @case('repuestos')<span class="badge bg-warning">Repuestos</span>@break
                                    @case('aprobacion')<span class="badge bg-secondary">Aprobación</span>@break
                                    @case('reparacion')<span class="badge bg-warning">Reparación</span>@break
                                    @case('control')<span class="badge bg-info">Control</span>@break
                                    @case('entregado')<span class="badge bg-success">Entregado</span>@break
                                    @default<span class="badge bg-secondary">{{ $orden->estado }}</span>@break
                                @endswitch
                            </td>
                            <td>{{ $orden->created_at->format('d/m/Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>Ingresos por Mes</h5>
            </div>
            <div class="card-body">
                <canvas id="chartIngresos"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
const ctx = document.getElementById('chartIngresos').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: @json($ingresosPorMes->pluck('mes')),
        datasets: [{
            label: 'Ingresos',
            data: @json($ingresosPorMes->pluck('total')),
            backgroundColor: 'rgba(40, 167, 69, 0.7)'
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: { beginAtZero: true }
        }
    }
});
</script>
@endsection

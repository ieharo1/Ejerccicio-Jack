@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h3><i class="fas fa-tachometer-alt"></i> Dashboard</h3>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card stat-card blue p-3">
            <h6 class="text-muted">Clientes Registrados</h6>
            <h2>{{ $stats['clientes'] }}</h2>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card green p-3">
            <h6 class="text-muted">Vehículos</h6>
            <h2>{{ $stats['vehiculos'] }}</h2>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card orange p-3">
            <h6 class="text-muted">Órdenes Abiertas</h6>
            <h2>{{ $stats['ordenes_abiertas'] }}</h2>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card red p-3">
            <h6 class="text-muted">Órdenes Terminadas</h6>
            <h2>{{ $stats['ordenes_terminadas'] }}</h2>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card stat-card blue p-3">
            <h6 class="text-muted">Ingresos del Mes</h6>
            <h2>${{ number_format($stats['ingresos_mes'], 2) }}</h2>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card orange p-3">
            <h6 class="text-muted">Compras del Mes</h6>
            <h2>${{ number_format($stats['compras_mes'], 2) }}</h2>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card red p-3">
            <h6 class="text-muted">Stock Bajo</h6>
            <h2>{{ $stats['repuestos_bajos'] }}</h2>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card p-3">
            <h5>Ingresos vs Gastos</h5>
            <canvas id="chartIngresos"></canvas>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card p-3">
            <h5>Órdenes por Estado</h5>
            <canvas id="chartOrdenes"></canvas>
        </div>
    </div>
</div>

<script>
new Chart(document.getElementById('chartIngresos'), {
    type: 'bar',
    data: {
        labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun'],
        datasets: [{
            label: 'Ingresos',
            data: [12000, 15000, 11000, 18000, 14000, 16000],
            backgroundColor: '#2ecc71'
        }, {
            label: 'Gastos',
            data: [8000, 10000, 7000, 12000, 9000, 11000],
            backgroundColor: '#e74c3c'
        }]
    }
});

new Chart(document.getElementById('chartOrdenes'), {
    type: 'doughnut',
    data: {
        labels: ['Recepción', 'Diagnóstico', 'Repuestos', 'Reparación', 'Entrega'],
        datasets: [{
            data: [12, 8, 15, 10, 20],
            backgroundColor: ['#3498db', '#f39c12', '#9b59b6', '#1abc9c', '#2ecc71']
        }]
    }
});
</script>
@endsection

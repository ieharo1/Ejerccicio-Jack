@extends('layouts.principal')

@section('title', 'Ver Repuesto')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>{{ $repuesto->nombre }}</h2>
    <div>
        <a href="{{ route('repuestos.edit', $repuesto) }}" class="btn btn-warning">Editar</a>
        <a href="{{ route('repuestos.index') }}" class="btn btn-secondary">Volver</a>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header"><h5>Datos del Repuesto</h5></div>
            <div class="card-body">
                <p><strong>Código:</strong> {{ $repuesto->codigo }}</p>
                <p><strong>Nombre:</strong> {{ $repuesto->nombre }}</p>
                <p><strong>Categoría:</strong> {{ $repuesto->categoria->nombre ?? 'N/A' }}</p>
                <p><strong>Marca:</strong> {{ $repuesto->marca }}</p>
                <p><strong>Proveedor:</strong> {{ $repuesto->proveedor->nombre ?? 'N/A' }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header"><h5>Inventario y Precios</h5></div>
            <div class="card-body">
                <p><strong>Stock Actual:</strong> {{ $repuesto->stock }}</p>
                <p><strong>Stock Mínimo:</strong> {{ $repuesto->stock_minimo }}</p>
                <p><strong>Precio Compra:</strong> ${{ number_format($repuesto->precio_compra, 2) }}</p>
                <p><strong>Precio Venta:</strong> ${{ number_format($repuesto->precio_venta, 2) }}</p>
            </div>
        </div>
    </div>
</div>
@endsection

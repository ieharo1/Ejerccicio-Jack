@extends('layouts.principal')

@section('title', 'Ver Compra')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Compra</h2>
    <a href="{{ route('compras.index') }}" class="btn btn-secondary">Volver</a>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header"><h5>Datos de la Compra</h5></div>
            <div class="card-body">
                <p><strong>Fecha:</strong> {{ $compra->fecha->format('d/m/Y') }}</p>
                <p><strong>Proveedor:</strong> {{ $compra->proveedor->nombre ?? 'N/A' }}</p>
                <p><strong>Factura:</strong> {{ $compra->numero_factura }}</p>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header"><h5>Items</h5></div>
    <div class="card-body">
        <table class="table">
            <thead><tr><th>Repuesto</th><th>Cantidad</th><th>Precio</th><th>Subtotal</th></tr></thead>
            <tbody>
                @foreach($compra->items as $item)
                <tr>
                    <td>{{ $item->repuesto->nombre ?? 'N/A' }}</td>
                    <td>{{ $item->cantidad }}</td>
                    <td>${{ number_format($item->precio_unitario, 2) }}</td>
                    <td>${{ number_format($item->subtotal, 2) }}</td>
                </tr>
                @endforeach
                <tr class="table-secondary">
                    <td colspan="3" class="text-end"><strong>Total:</strong></td>
                    <td><strong>${{ number_format($compra->total, 2) }}</strong></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection

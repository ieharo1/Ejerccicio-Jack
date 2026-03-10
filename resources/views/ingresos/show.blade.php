@extends('layouts.principal')

@section('title', 'Ver Ingreso')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Ingreso</h2>
    <a href="{{ route('ingresos.index') }}" class="btn btn-secondary">Volver</a>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header"><h5>Datos del Ingreso</h5></div>
            <div class="card-body">
                <p><strong>Fecha:</strong> {{ $ingreso->fecha->format('d/m/Y') }}</p>
                <p><strong>Orden:</strong> {{ $ingreso->ordenServicio->id_consecutivo ?? 'N/A' }}</p>
                <p><strong>Monto:</strong> ${{ number_format($ingreso->monto, 2) }}</p>
                <p><strong>Impuesto:</strong> ${{ number_format($ingreso->impuesto, 2) }}</p>
                <p><strong>Método de Pago:</strong> {{ $ingreso->metodo_pago }}</p>
                <p><strong>Descripción:</strong> {{ $ingreso->descripcion }}</p>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.principal')

@section('title', 'Nuevo Ingreso')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Nuevo Ingreso</h2>
    <a href="{{ route('ingresos.index') }}" class="btn btn-secondary">Volver</a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('ingresos.store') }}">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Orden de Servicio</label>
                    <select name="orden_servicio_id" class="form-select">
                        <option value="">Seleccionar orden</option>
                        @foreach($ordenes as $orden)
                        <option value="{{ $orden->id }}">{{ $orden->id_consecutivo }} - {{ $orden->cliente->nombre ?? 'N/A' }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Fecha</label>
                    <input type="date" name="fecha" class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Monto</label>
                    <input type="number" name="monto" class="form-control" step="0.01" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Impuesto</label>
                    <input type="number" name="impuesto" class="form-control" step="0.01" value="0">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Método de Pago</label>
                    <select name="metodo_pago" class="form-select" required>
                        <option value="Efectivo">Efectivo</option>
                        <option value="Tarjeta">Tarjeta</option>
                        <option value="Transferencia">Transferencia</option>
                        <option value="Cheque">Cheque</option>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea name="descripcion" class="form-control" rows="2"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</div>
@endsection

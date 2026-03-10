@extends('layouts.principal')

@section('title', 'Ver Orden de Servicio')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Orden: {{ $orden->id_consecutivo }}</h2>
    <div>
        <a href="{{ route('ordenes.index') }}" class="btn btn-secondary">Volver</a>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header"><h5>Datos de la Orden</h5></div>
            <div class="card-body">
                <p><strong>Tipo:</strong> {{ ucfirst($orden->tipo) }}</p>
                <p><strong>Cliente:</strong> {{ $orden->cliente->nombre ?? 'N/A' }}</p>
                <p><strong>Vehículo:</strong> {{ $orden->vehiculo->placa ?? 'N/A' }}</p>
                <p><strong>Técnico:</strong> {{ $orden->tecnico->name ?? 'Sin asignar' }}</p>
                <p><strong>Fecha Ingreso:</strong> {{ $orden->fecha_hora_ingreso->format('d/m/Y H:i') }}</p>
                <p><strong>Garantía:</strong> {{ $orden->garantia ? 'Sí' : 'No' }}</p>
                <p><strong>Prueba Ruta:</strong> {{ $orden->autoriza_prueba_ruta ? 'Sí' : 'No' }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header"><h5>Estado</h5></div>
            <div class="card-body">
                <form method="POST" action="{{ route('ordenes.estado', $orden) }}">
                    @csrf
                    <select name="estado" class="form-select mb-2">
                        <option value="recepcion" {{ $orden->estado == 'recepcion' ? 'selected' : '' }}>Recepción</option>
                        <option value="diagnostico" {{ $orden->estado == 'diagnostico' ? 'selected' : '' }}>Diagnóstico</option>
                        <option value="repuestos" {{ $orden->estado == 'repuestos' ? 'selected' : '' }}>Repuestos</option>
                        <option value="aprobacion" {{ $orden->estado == 'aprobacion' ? 'selected' : '' }}>Aprobación</option>
                        <option value="reparacion" {{ $orden->estado == 'reparacion' ? 'selected' : '' }}>Reparación</option>
                        <option value="control" {{ $orden->estado == 'control' ? 'selected' : '' }}>Control</option>
                        <option value="entregado" {{ $orden->estado == 'entregado' ? 'selected' : '' }}>Entregado</option>
                        <option value="archivado" {{ $orden->estado == 'archivado' ? 'selected' : '' }}>Archivado</option>
                    </select>
                    <button type="submit" class="btn btn-primary">Cambiar Estado</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header"><h5>Motivo de Ingreso</h5></div>
    <div class="card-body">
        {{ $orden->motivo_ingreso ?? 'Sin descripción' }}
    </div>
</div>

<div class="card">
    <div class="card-header"><h5>Items de la Orden</h5></div>
    <div class="card-body">
        <table class="table">
            <thead><tr><th>Tipo</th><th>Item</th><th>Cantidad</th><th>Precio</th><th>Subtotal</th></tr></thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($orden->items as $item)
                <tr>
                    <td>{{ ucfirst($item->tipo) }}</td>
                    <td>{{ $item->item_nombre }}</td>
                    <td>{{ $item->cantidad }}</td>
                    <td>${{ number_format($item->precio, 2) }}</td>
                    <td>${{ number_format($item->cantidad * $item->precio, 2) }}</td>
                </tr>
                @php $total += $item->cantidad * $item->precio; @endphp
                @endforeach
                <tr class="table-secondary">
                    <td colspan="4" class="text-end"><strong>Total:</strong></td>
                    <td><strong>${{ number_format($total, 2) }}</strong></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection

@extends('layouts.principal')

@section('title', 'Resultados Reporte')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Resultados del Reporte</h2>
    <div>
        <form method="POST" action="{{ route('reportes.pdf') }}" class="d-inline">
            @csrf
            @foreach(request()->except('_token') as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach
            <button type="submit" class="btn btn-danger"><i class="bi bi-file-pdf"></i> PDF</button>
        </form>
        <form method="POST" action="{{ route('reportes.excel') }}" class="d-inline">
            @csrf
            @foreach(request()->except('_token') as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach
            <button type="submit" class="btn btn-success"><i class="bi bi-file-excel"></i> Excel</button>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>Orden</th>
                    <th>Cliente</th>
                    <th>Vehículo</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Items</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @php $granTotal = 0; @endphp
                @foreach($ordenes as $orden)
                @php 
                    $totalOrden = $orden->items->sum(function($i) { return $i->cantidad * $i->precio; });
                    $granTotal += $totalOrden;
                @endphp
                <tr>
                    <td>{{ $orden->id_consecutivo }}</td>
                    <td>{{ $orden->cliente->nombre ?? 'N/A' }}</td>
                    <td>{{ $orden->vehiculo->placa ?? 'N/A' }}</td>
                    <td>{{ $orden->created_at->format('d/m/Y') }}</td>
                    <td>{{ $orden->estado }}</td>
                    <td>{{ $orden->items->count() }}</td>
                    <td>${{ number_format($totalOrden, 2) }}</td>
                </tr>
                @endforeach
                <tr class="table-secondary">
                    <td colspan="6" class="text-end"><strong>Gran Total:</strong></td>
                    <td><strong>${{ number_format($granTotal, 2) }}</strong></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection

@extends('layouts.principal')

@section('title', 'Órdenes de Servicio')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Órdenes de Servicio</h2>
    <a href="{{ route('ordenes.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Nueva Orden
    </a>
</div>

<div class="card mb-3">
    <div class="card-body">
        <form method="GET" class="row g-3">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Buscar por número..." value="{{ $search }}">
            </div>
            <div class="col-md-4">
                <select name="estado" class="form-select">
                    <option value="">Todos los estados</option>
                    <option value="recepcion" {{ $estado == 'recepcion' ? 'selected' : '' }}>Recepción</option>
                    <option value="diagnostico" {{ $estado == 'diagnostico' ? 'selected' : '' }}>Diagnóstico</option>
                    <option value="repuestos" {{ $estado == 'repuestos' ? 'selected' : '' }}>Repuestos</option>
                    <option value="aprobacion" {{ $estado == 'aprobacion' ? 'selected' : '' }}>Aprobación</option>
                    <option value="reparacion" {{ $estado == 'reparacion' ? 'selected' : '' }}>Reparación</option>
                    <option value="control" {{ $estado == 'control' ? 'selected' : '' }}>Control</option>
                    <option value="entregado" {{ $estado == 'entregado' ? 'selected' : '' }}>Entregado</option>
                </select>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary w-100">Filtrar</button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Orden</th>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Vehículo</th>
                    <th>Tipo</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ordenes as $orden)
                <tr>
                    <td><strong>{{ $orden->id_consecutivo }}</strong></td>
                    <td>{{ $orden->fecha_hora_ingreso->format('d/m/Y') }}</td>
                    <td>{{ $orden->cliente->nombre ?? 'N/A' }}</td>
                    <td>{{ $orden->vehiculo->placa ?? 'N/A' }}</td>
                    <td>{{ ucfirst($orden->tipo) }}</td>
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
                    <td>
                        <a href="{{ route('ordenes.show', $orden) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                        <a href="{{ route('ordenes.edit', $orden) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('ordenes.destroy', $orden) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar?')"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $ordenes->links() }}
    </div>
</div>
@endsection

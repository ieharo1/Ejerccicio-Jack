@extends('layouts.principal')

@section('title', 'CRM - Servicios Programados')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>CRM - Servicios Programados</h2>
    <div>
        <a href="{{ route('crm.kanban') }}" class="btn btn-info me-2"><i class="bi bi-kanban"></i> Kanban</a>
        <a href="{{ route('crm.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Nuevo</a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead><tr><th>Fecha</th><th>Cliente</th><th>Vehículo</th><th>Servicio</th><th>Estado</th><th>Acciones</th></tr></thead>
            <tbody>
                @foreach($programados as $programado)
                <tr>
                    <td>{{ $programado->fecha_programacion->format('d/m/Y') }}</td>
                    <td>{{ $programado->cliente->nombre ?? 'N/A' }}</td>
                    <td>{{ $programado->vehiculo->placa ?? 'N/A' }}</td>
                    <td>{{ $programado->servicio }}</td>
                    <td>
                        @switch($programado->estado)
                            @case('pendiente')<span class="badge bg-warning">Pendiente</span>@break
                            @case('completado')<span class="badge bg-success">Completado</span>@break
                            @case('cancelado')<span class="badge bg-danger">Cancelado</span>@break
                        @endswitch
                    </td>
                    <td>
                        <a href="{{ route('crm.edit', $programado) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('crm.destroy', $programado) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar?')"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $programados->links() }}
    </div>
</div>
@endsection

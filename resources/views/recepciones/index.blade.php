@extends('layouts.principal')

@section('title', 'Órdenes de Recepción')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Órdenes de Recepción</h2>
    <a href="{{ route('recepciones.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Nueva Recepción
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Consecutivo</th>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Vehículo</th>
                    <th>Técnico</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recepciones as $recepcion)
                <tr>
                    <td><strong>{{ $recepcion->id_consecutivo }}</strong></td>
                    <td>{{ $recepcion->fecha->format('d/m/Y') }}</td>
                    <td>{{ $recepcion->cliente->nombre ?? 'N/A' }}</td>
                    <td>{{ $recepcion->vehiculo->placa ?? 'N/A' }}</td>
                    <td>{{ $recepcion->tecnico }}</td>
                    <td>
                        <a href="{{ route('recepciones.show', $recepcion) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                        <a href="{{ route('recepciones.edit', $recepcion) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('recepciones.destroy', $recepcion) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar?')"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $recepciones->links() }}
    </div>
</div>
@endsection

@extends('layouts.principal')

@section('title', 'Vehículos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Vehículos</h2>
    <a href="{{ route('vehiculos.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Nuevo Vehículo
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form method="GET" class="mb-3">
            <div class="row">
                <div class="col-md-10">
                    <input type="text" name="search" class="form-control" placeholder="Buscar por placa, marca o modelo..." value="{{ $search }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Buscar</button>
                </div>
            </div>
        </form>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Placa</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Año</th>
                    <th>Color</th>
                    <th>Cliente</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($vehiculos as $vehiculo)
                <tr>
                    <td><strong>{{ $vehiculo->placa }}</strong></td>
                    <td>{{ $vehiculo->marca }}</td>
                    <td>{{ $vehiculo->modelo }}</td>
                    <td>{{ $vehiculo->año }}</td>
                    <td>{{ $vehiculo->color }}</td>
                    <td>{{ $vehiculo->cliente->nombre ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('vehiculos.show', $vehiculo) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                        <a href="{{ route('vehiculos.edit', $vehiculo) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('vehiculos.destroy', $vehiculo) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar?')"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        {{ $vehiculos->links() }}
    </div>
</div>
@endsection

@extends('layouts.principal')

@section('title', 'Clientes')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Clientes</h2>
    <a href="{{ route('clientes.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Nuevo Cliente
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form method="GET" class="mb-3">
            <div class="row">
                <div class="col-md-10">
                    <input type="text" name="search" class="form-control" placeholder="Buscar por nombre, cédula o teléfono..." value="{{ $search }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Buscar</button>
                </div>
            </div>
        </form>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Cédula/RUC</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Ciudad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->nombre }}</td>
                    <td>{{ $cliente->cedula_ruc }}</td>
                    <td>{{ $cliente->telefono }}</td>
                    <td>{{ $cliente->email }}</td>
                    <td>{{ $cliente->ciudad }}</td>
                    <td>
                        <a href="{{ route('clientes.show', $cliente) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                        <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar?')"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        {{ $clientes->links() }}
    </div>
</div>
@endsection

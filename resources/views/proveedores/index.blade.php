@extends('layouts.principal')

@section('title', 'Proveedores')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Proveedores</h2>
    <a href="{{ route('proveedores.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Nuevo</a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead><tr><th>Nombre</th><th>Teléfono</th><th>Email</th><th>Contacto</th><th>Acciones</th></tr></thead>
            <tbody>
                @foreach($proveedores as $proveedor)
                <tr>
                    <td>{{ $proveedor->nombre }}</td>
                    <td>{{ $proveedor->telefono }}</td>
                    <td>{{ $proveedor->email }}</td>
                    <td>{{ $proveedor->contacto }}</td>
                    <td>
                        <a href="{{ route('proveedores.edit', $proveedor) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('proveedores.destroy', $proveedor) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar?')"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $proveedores->links() }}
    </div>
</div>
@endsection

@extends('layouts.principal')

@section('title', 'Servicios')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Servicios</h2>
    <a href="{{ route('servicios.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Nuevo</a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead><tr><th>Código</th><th>Nombre</th><th>Precio</th><th>Categoría</th><th>Acciones</th></tr></thead>
            <tbody>
                @foreach($servicios as $servicio)
                <tr>
                    <td>{{ $servicio->codigo }}</td>
                    <td>{{ $servicio->nombre }}</td>
                    <td>${{ number_format($servicio->precio, 2) }}</td>
                    <td>{{ $servicio->categoria }}</td>
                    <td>
                        <a href="{{ route('servicios.edit', $servicio) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('servicios.destroy', $servicio) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar?')"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $servicios->links() }}
    </div>
</div>
@endsection

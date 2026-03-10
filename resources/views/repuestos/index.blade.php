@extends('layouts.principal')

@section('title', 'Repuestos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Inventario de Repuestos</h2>
    <a href="{{ route('repuestos.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Nuevo Repuesto</a>
</div>

@if($stockBajo->count() > 0)
<div class="alert alert-warning">
    <strong>Atención:</strong> {{ $stockBajo->count() }} repuestos tienen stock bajo.
</div>
@endif

<div class="card">
    <div class="card-body">
        <form method="GET" class="mb-3">
            <div class="row">
                <div class="col-md-8">
                    <input type="text" name="search" class="form-control" placeholder="Buscar..." value="{{ $search }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Buscar</button>
                </div>
            </div>
        </form>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Stock</th>
                    <th>Precio Venta</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($repuestos as $repuesto)
                <tr class="{{ $repuesto->stock <= $repuesto->stock_minimo ? 'table-warning' : '' }}">
                    <td>{{ $repuesto->codigo }}</td>
                    <td>{{ $repuesto->nombre }}</td>
                    <td>{{ $repuesto->categoria->nombre ?? 'N/A' }}</td>
                    <td>{{ $repuesto->stock }}</td>
                    <td>${{ number_format($repuesto->precio_venta, 2) }}</td>
                    <td>
                        <a href="{{ route('repuestos.edit', $repuesto) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('repuestos.destroy', $repuesto) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar?')"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $repuestos->links() }}
    </div>
</div>
@endsection

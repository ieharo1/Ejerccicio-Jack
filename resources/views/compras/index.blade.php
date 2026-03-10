@extends('layouts.principal')

@section('title', 'Compras')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Compras</h2>
    <a href="{{ route('compras.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Nueva Compra</a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead><tr><th>Fecha</th><th>Proveedor</th><th>Factura</th><th>Total</th><th>Acciones</th></tr></thead>
            <tbody>
                @foreach($compras as $compra)
                <tr>
                    <td>{{ $compra->fecha->format('d/m/Y') }}</td>
                    <td>{{ $compra->proveedor->nombre ?? 'N/A' }}</td>
                    <td>{{ $compra->numero_factura }}</td>
                    <td>${{ number_format($compra->total, 2) }}</td>
                    <td>
                        <a href="{{ route('compras.show', $compra) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                        <form action="{{ route('compras.destroy', $compra) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar?')"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $compras->links() }}
    </div>
</div>
@endsection

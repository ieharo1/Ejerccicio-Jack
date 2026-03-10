@extends('layouts.principal')

@section('title', 'Ingresos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Ingresos</h2>
    <a href="{{ route('ingresos.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Nuevo Ingreso</a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead><tr><th>Fecha</th><th>Orden</th><th>Monto</th><th>Método Pago</th><th>Acciones</th></tr></thead>
            <tbody>
                @foreach($ingresos as $ingreso)
                <tr>
                    <td>{{ $ingreso->fecha->format('d/m/Y') }}</td>
                    <td>{{ $ingreso->ordenServicio->id_consecutivo ?? 'N/A' }}</td>
                    <td>${{ number_format($ingreso->monto, 2) }}</td>
                    <td>{{ $ingreso->metodo_pago }}</td>
                    <td>
                        <form action="{{ route('ingresos.destroy', $ingreso) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar?')"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $ingresos->links() }}
    </div>
</div>
@endsection

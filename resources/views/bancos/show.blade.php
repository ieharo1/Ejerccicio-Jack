@extends('layouts.principal')

@section('title', 'Movimientos Bancarios')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>{{ $cuenta->nombre }} - Movimientos</h2>
    <a href="{{ route('bancos.index') }}" class="btn btn-secondary">Volver</a>
</div>

<div class="row mb-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header"><h5>Registrar Movimiento</h5></div>
            <div class="card-body">
                <form method="POST" action="{{ route('bancos.movimiento', $cuenta) }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <select name="tipo" class="form-select" required>
                                <option value="ingreso">Ingreso</option>
                                <option value="egreso">Egreso</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="number" name="monto" class="form-control" placeholder="Monto" step="0.01" required>
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="descripcion" class="form-control" placeholder="Descripción">
                        </div>
                        <div class="col-md-2">
                            <input type="date" name="fecha" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-primary w-100">+</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header"><h5>Saldo Actual: ${{ number_format($cuenta->saldo_actual, 2) }}</h5></div>
    <div class="card-body">
        <table class="table">
            <thead><tr><th>Fecha</th><th>Tipo</th><th>Descripción</th><th>Monto</th></tr></thead>
            <tbody>
                @foreach($movimientos as $movimiento)
                <tr class="{{ $movimiento->tipo == 'ingreso' ? 'table-success' : 'table-danger' }}">
                    <td>{{ $movimiento->fecha->format('d/m/Y') }}</td>
                    <td>{{ ucfirst($movimiento->tipo) }}</td>
                    <td>{{ $movimiento->descripcion }}</td>
                    <td>{{ $movimiento->tipo == 'ingreso' ? '+' : '-' }}${{ number_format($movimiento->monto, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $movimientos->links() }}
    </div>
</div>
@endsection

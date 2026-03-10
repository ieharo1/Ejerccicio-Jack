@extends('layouts.principal')

@section('title', 'Bancos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Cuentas Bancarias</h2>
    <a href="{{ route('bancos.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Nueva Cuenta</a>
</div>

<div class="row">
    @foreach($cuentas as $cuenta)
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-header">
                <h5>{{ $cuenta->nombre }}</h5>
            </div>
            <div class="card-body">
                <p><strong>Banco:</strong> {{ $cuenta->banco }}</p>
                <p><strong>Número:</strong> {{ $cuenta->numero_cuenta }}</p>
                <p><strong>Tipo:</strong> {{ ucfirst($cuenta->tipo) }}</p>
                <p><strong>Saldo:</strong> <span class="text-success">${{ number_format($cuenta->saldo_actual, 2) }}</span></p>
            </div>
            <div class="card-footer">
                <a href="{{ route('bancos.show', $cuenta) }}" class="btn btn-sm btn-info">Ver Movimientos</a>
                <a href="{{ route('bancos.edit', $cuenta) }}" class="btn btn-sm btn-warning">Editar</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection

@extends('layouts.principal')

@section('title', 'Nueva Cuenta Bancaria')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Nueva Cuenta Bancaria</h2>
    <a href="{{ route('bancos.index') }}" class="btn btn-secondary">Volver</a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('bancos.store') }}">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Banco</label>
                    <input type="text" name="banco" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Número de Cuenta</label>
                    <input type="text" name="numero_cuenta" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tipo</label>
                    <select name="tipo" class="form-select" required>
                        <option value="ahorro">Ahorro</option>
                        <option value="corriente">Corriente</option>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Saldo Inicial</label>
                <input type="number" name="saldo_inicial" class="form-control" step="0.01" value="0">
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</div>
@endsection

@extends('layouts.principal')

@section('title', 'Editar Cuenta Bancaria')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Editar Cuenta Bancaria</h2>
    <a href="{{ route('bancos.index') }}" class="btn btn-secondary">Volver</a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('bancos.update', $cuenta) }}">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="{{ $cuenta->nombre }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Banco</label>
                    <input type="text" name="banco" class="form-control" value="{{ $cuenta->banco }}">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Número de Cuenta</label>
                    <input type="text" name="numero_cuenta" class="form-control" value="{{ $cuenta->numero_cuenta }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tipo</label>
                    <select name="tipo" class="form-select" required>
                        <option value="ahorro" {{ $cuenta->tipo == 'ahorro' ? 'selected' : '' }}>Ahorro</option>
                        <option value="corriente" {{ $cuenta->tipo == 'corriente' ? 'selected' : '' }}>Corriente</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</div>
@endsection

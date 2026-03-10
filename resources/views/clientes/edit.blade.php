@extends('layouts.principal')

@section('title', 'Editar Cliente')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Editar Cliente</h2>
    <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Volver</a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('clientes.update', $cliente) }}">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="{{ $cliente->nombre }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Cédula/RUC</label>
                    <input type="text" name="cedula_ruc" class="form-control" value="{{ $cliente->cedula_ruc }}" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Teléfono</label>
                    <input type="text" name="telefono" class="form-control" value="{{ $cliente->telefono }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $cliente->email }}">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Dirección</label>
                    <input type="text" name="direccion" class="form-control" value="{{ $cliente->direccion }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Ciudad</label>
                    <input type="text" name="ciudad" class="form-control" value="{{ $cliente->ciudad }}">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Observaciones</label>
                <textarea name="observaciones" class="form-control" rows="3">{{ $cliente->observaciones }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</div>
@endsection

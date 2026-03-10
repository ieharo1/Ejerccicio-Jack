@extends('layouts.principal')

@section('title', 'Editar Recepción')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Editar Recepción</h2>
    <a href="{{ route('recepciones.index') }}" class="btn btn-secondary">Volver</a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('recepciones.update', $recepcion) }}">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Cliente</label>
                    <select name="cliente_id" class="form-select" required>
                        @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}" {{ $recepcion->cliente_id == $cliente->id ? 'selected' : '' }}>{{ $cliente->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Vehículo</label>
                    <select name="vehiculo_id" class="form-select" required>
                        @foreach($clientes->find($recepcion->cliente_id)->vehiculos ?? [] as $vehiculo)
                        <option value="{{ $vehiculo->id }}" {{ $recepcion->vehiculo_id == $vehiculo->id ? 'selected' : '' }}>{{ $vehiculo->placa }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Fecha</label>
                    <input type="date" name="fecha" class="form-control" value="{{ $recepcion->fecha->format('Y-m-d') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Técnico</label>
                    <input type="text" name="tecnico" class="form-control" value="{{ $recepcion->tecnico }}">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Motivo de Ingreso</label>
                <textarea name="motivo_ingreso" class="form-control" required>{{ $recepcion->motivo_ingreso }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</div>
@endsection

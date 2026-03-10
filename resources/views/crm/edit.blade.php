@extends('layouts.principal')

@section('title', 'Editar Servicio Programado')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Editar Servicio Programado</h2>
    <a href="{{ route('crm.index') }}" class="btn btn-secondary">Volver</a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('crm.update', $programado) }}">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Cliente</label>
                    <select name="cliente_id" class="form-select" required>
                        @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}" {{ $programado->cliente_id == $cliente->id ? 'selected' : '' }}>{{ $cliente->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Vehículo</label>
                    <select name="vehiculo_id" class="form-select" required>
                        @foreach($clientes->find($programado->cliente_id)->vehiculos ?? [] as $vehiculo)
                        <option value="{{ $vehiculo->id }}" {{ $programado->vehiculo_id == $vehiculo->id ? 'selected' : '' }}>{{ $vehiculo->placa }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Categoría</label>
                    <input type="text" name="categoria" class="form-control" value="{{ $programado->categoria }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Fecha Programación</label>
                    <input type="date" name="fecha_programacion" class="form-control" value="{{ $programado->fecha_programacion->format('Y-m-d') }}" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Servicio</label>
                    <input type="text" name="servicio" class="form-control" value="{{ $programado->servicio }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Estado</label>
                    <select name="estado" class="form-select" required>
                        <option value="pendiente" {{ $programado->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="completado" {{ $programado->estado == 'completado' ? 'selected' : '' }}>Completado</option>
                        <option value="cancelado" {{ $programado->estado == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Observación</label>
                <textarea name="observacion" class="form-control" rows="2">{{ $programado->observacion }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</div>
@endsection

@extends('layouts.principal')

@section('title', 'Editar Orden de Servicio')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Editar Orden: {{ $orden->id_consecutivo }}</h2>
    <a href="{{ route('ordenes.index') }}" class="btn btn-secondary">Volver</a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('ordenes.update', $orden) }}">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Cliente</label>
                    <select name="cliente_id" class="form-select" required>
                        @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}" {{ $orden->cliente_id == $cliente->id ? 'selected' : '' }}>{{ $cliente->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Vehículo</label>
                    <select name="vehiculo_id" class="form-select" required>
                        @foreach($clientes->find($orden->cliente_id)->vehiculos ?? [] as $vehiculo)
                        <option value="{{ $vehiculo->id }}" {{ $orden->vehiculo_id == $vehiculo->id ? 'selected' : '' }}>{{ $vehiculo->placa }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Tipo de Orden</label>
                    <select name="tipo" class="form-select" required>
                        <option value="normal" {{ $orden->tipo == 'normal' ? 'selected' : '' }}>Normal</option>
                        <option value="avanzada" {{ $orden->tipo == 'avanzada' ? 'selected' : '' }}>Avanzada</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Estado</label>
                    <select name="estado" class="form-select" required>
                        <option value="recepcion" {{ $orden->estado == 'recepcion' ? 'selected' : '' }}>Recepción</option>
                        <option value="diagnostico" {{ $orden->estado == 'diagnostico' ? 'selected' : '' }}>Diagnóstico</option>
                        <option value="repuestos" {{ $orden->estado == 'repuestos' ? 'selected' : '' }}>Repuestos</option>
                        <option value="aprobacion" {{ $orden->estado == 'aprobacion' ? 'selected' : '' }}>Aprobación</option>
                        <option value="reparacion" {{ $orden->estado == 'reparacion' ? 'selected' : '' }}>Reparación</option>
                        <option value="control" {{ $orden->estado == 'control' ? 'selected' : '' }}>Control</option>
                        <option value="entregado" {{ $orden->estado == 'entregado' ? 'selected' : '' }}>Entregado</option>
                        <option value="archivado" {{ $orden->estado == 'archivado' ? 'selected' : '' }}>Archivado</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Técnico</label>
                    <select name="tecnico_id" class="form-select">
                        <option value="">Sin asignar</option>
                        @foreach($tecnicos as $tecnico)
                        <option value="{{ $tecnico->id }}" {{ $orden->tecnico_id == $tecnico->id ? 'selected' : '' }}>{{ $tecnico->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Garantía</label>
                    <select name="garantia" class="form-select" required>
                        <option value="0" {{ !$orden->garantia ? 'selected' : '' }}>No</option>
                        <option value="1" {{ $orden->garantia ? 'selected' : '' }}>Sí</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Autoriza Prueba Ruta</label>
                    <select name="autoriza_prueba_ruta" class="form-select" required>
                        <option value="0" {{ !$orden->autoriza_prueba_ruta ? 'selected' : '' }}>No</option>
                        <option value="1" {{ $orden->autoriza_prueba_ruta ? 'selected' : '' }}>Sí</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Requiere Diagnóstico</label>
                    <select name="requiere_diagnostico" class="form-select" required>
                        <option value="0" {{ !$orden->requiere_diagnostico ? 'selected' : '' }}>No</option>
                        <option value="1" {{ $orden->requiere_diagnostico ? 'selected' : '' }}>Sí</option>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Motivo de Ingreso</label>
                <textarea name="motivo_ingreso" class="form-control" rows="3">{{ $orden->motivo_ingreso }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</div>
@endsection

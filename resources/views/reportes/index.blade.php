@extends('layouts.principal')

@section('title', 'Reportes')

@section('content')
<h2>Reportes</h2>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('reportes.generar') }}">
            @csrf
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label class="form-label">Cliente</label>
                    <select name="cliente_id" class="form-select">
                        <option value="">Todos</option>
                        @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Vehículo</label>
                    <select name="vehiculo_id" class="form-select">
                        <option value="">Todos</option>
                        @foreach($vehiculos as $vehiculo)
                        <option value="{{ $vehiculo->id }}">{{ $vehiculo->placa }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Técnico</label>
                    <select name="tecnico_id" class="form-select">
                        <option value="">Todos</option>
                        @foreach($tecnicos as $tecnico)
                        <option value="{{ $tecnico->id }}">{{ $tecnico->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Estado</label>
                    <select name="estado" class="form-select">
                        <option value="">Todos</option>
                        <option value="recepcion">Recepción</option>
                        <option value="diagnostico">Diagnóstico</option>
                        <option value="repuestos">Repuestos</option>
                        <option value="aprobacion">Aprobación</option>
                        <option value="reparacion">Reparación</option>
                        <option value="control">Control</option>
                        <option value="entregado">Entregado</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Fecha Inicio</label>
                    <input type="date" name="fecha_inicio" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Fecha Fin</label>
                    <input type="date" name="fecha_fin" class="form-control">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Generar Reporte</button>
        </form>
    </div>
</div>
@endsection

@extends('layouts.principal')

@section('title', 'Editar Vehículo')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Editar Vehículo</h2>
    <a href="{{ route('vehiculos.index') }}" class="btn btn-secondary">Volver</a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('vehiculos.update', $vehiculo) }}">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Cliente</label>
                    <select name="cliente_id" class="form-select" required>
                        @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}" {{ $vehiculo->cliente_id == $cliente->id ? 'selected' : '' }}>
                            {{ $cliente->nombre }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Placa</label>
                    <input type="text" name="placa" class="form-control" value="{{ $vehiculo->placa }}" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Marca</label>
                    <input type="text" name="marca" class="form-control" value="{{ $vehiculo->marca }}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Modelo</label>
                    <input type="text" name="modelo" class="form-control" value="{{ $vehiculo->modelo }}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Año</label>
                    <input type="number" name="año" class="form-control" value="{{ $vehiculo->año }}">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Color</label>
                    <input type="text" name="color" class="form-control" value="{{ $vehiculo->color }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">VIN</label>
                    <input type="text" name="vin" class="form-control" value="{{ $vehiculo->vin }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Kilometraje</label>
                    <input type="number" name="kilometraje" class="form-control" value="{{ $vehiculo->kilometraje }}">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</div>
@endsection

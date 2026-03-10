@extends('layouts.principal')

@section('title', 'Nuevo Servicio Programado')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Nuevo Servicio Programado</h2>
    <a href="{{ route('crm.index') }}" class="btn btn-secondary">Volver</a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('crm.store') }}">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Cliente</label>
                    <select name="cliente_id" id="cliente_id" class="form-select" required>
                        <option value="">Seleccionar cliente</option>
                        @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Vehículo</label>
                    <select name="vehiculo_id" id="vehiculo_id" class="form-select" required>
                        <option value="">Seleccionar vehículo</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Categoría</label>
                    <input type="text" name="categoria" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Fecha Programación</label>
                    <input type="date" name="fecha_programacion" class="form-control" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Servicio</label>
                <input type="text" name="servicio" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Observación</label>
                <textarea name="observacion" class="form-control" rows="2"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</div>

<script>
document.getElementById('cliente_id').addEventListener('change', function() {
    const clienteId = this.value;
    const vehiculoSelect = document.getElementById('vehiculo_id');
    vehiculoSelect.innerHTML = '<option value="">Cargando...</option>';
    
    fetch('/vehiculos-por-cliente/' + clienteId)
        .then(response => response.json())
        .then(data => {
            vehiculoSelect.innerHTML = '<option value="">Seleccionar vehículo</option>';
            data.forEach(vehiculo => {
                vehiculoSelect.innerHTML += `<option value="${vehiculo.id}">${vehiculo.placa}</option>`;
            });
        });
});
</script>
@endsection

@extends('layouts.principal')

@section('title', 'Nueva Recepción')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Nueva Orden de Recepción</h2>
    <a href="{{ route('recepciones.index') }}" class="btn btn-secondary">Volver</a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('recepciones.store') }}">
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
                    <label class="form-label">Fecha</label>
                    <input type="date" name="fecha" class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Técnico</label>
                    <input type="text" name="tecnico" class="form-control">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Motivo de Ingreso</label>
                <textarea name="motivo_ingreso" class="form-control" required></textarea>
            </div>
            <hr><h5>Condiciones de Recepción</h5>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Kilometraje</label>
                    <input type="number" name="kilometraje" class="form-control">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Nivel Combustible</label>
                    <select name="nivel_combustible" class="form-select">
                        <option value="1/4">1/4</option>
                        <option value="1/2">1/2</option>
                        <option value="3/4">3/4</option>
                        <option value="full">Full</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Fluidos Adecuados</label>
                    <select name="fluidos_adecuados" class="form-select">
                        <option value="1">Sí</option>
                        <option value="0">No</option>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Objetos de Valor</label>
                <textarea name="objetos_valor" class="form-control" placeholder="Liste objetos de valor reportados"></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Inventario Interior</label>
                <textarea name="inventario_interior" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Daños Visibles</label>
                <textarea name="danos_visibles" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Comentarios</label>
                <textarea name="comentarios" class="form-control"></textarea>
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
                vehiculoSelect.innerHTML += `<option value="${vehiculo.id}">${vehiculo.placa} - ${vehiculo.marca} ${vehiculo.modelo}</option>`;
            });
        });
});
</script>
@endsection

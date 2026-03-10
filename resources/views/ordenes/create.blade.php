@extends('layouts.principal')

@section('title', 'Nueva Orden de Servicio')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Nueva Orden de Servicio</h2>
    <a href="{{ route('ordenes.index') }}" class="btn btn-secondary">Volver</a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('ordenes.store') }}">
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
                <div class="col-md-4 mb-3">
                    <label class="form-label">Tipo de Orden</label>
                    <select name="tipo" class="form-select" required>
                        <option value="normal">Normal</option>
                        <option value="avanzada">Avanzada</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">¿Requiere Diagnóstico?</label>
                    <select name="requiere_diagnostico" class="form-select" required>
                        <option value="1">Sí</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Técnico</label>
                    <select name="tecnico_id" class="form-select">
                        <option value="">Seleccionar</option>
                        @foreach($tecnicos as $tecnico)
                        <option value="{{ $tecnico->id }}">{{ $tecnico->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Garantía</label>
                    <select name="garantia" class="form-select" required>
                        <option value="0">No</option>
                        <option value="1">Sí</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Autoriza Prueba Ruta</label>
                    <select name="autoriza_prueba_ruta" class="form-select" required>
                        <option value="0">No</option>
                        <option value="1">Sí</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Fecha/Hora Ingreso</label>
                    <input type="datetime-local" name="fecha_hora_ingreso" class="form-control" value="{{ date('Y-m-d\TH:i') }}" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Motivo de Ingreso</label>
                <textarea name="motivo_ingreso" class="form-control" rows="3"></textarea>
            </div>
            <hr>
            <h5>Servicios</h5>
            <div class="mb-3">
                <select id="servicio_select" class="form-select mb-2">
                    <option value="">Seleccionar servicio</option>
                    @foreach($servicios as $servicio)
                    <option value="{{ $servicio->id }}" data-nombre="{{ $servicio->nombre }}" data-precio="{{ $servicio->precio }}">{{ $servicio->nombre }} - ${{ $servicio->precio }}</option>
                    @endforeach
                </select>
                <button type="button" class="btn btn-sm btn-primary" onclick="agregarServicio()">Agregar Servicio</button>
            </div>
            <table class="table table-sm" id="servicios_table">
                <thead><tr><th>Servicio</th><th>Precio</th><th></th></tr></thead>
                <tbody></tbody>
            </table>
            <hr>
            <h5>Repuestos</h5>
            <div class="mb-3">
                <select id="repuesto_select" class="form-select mb-2">
                    <option value="">Seleccionar repuesto</option>
                    @foreach($repuestos as $repuesto)
                    <option value="{{ $repuesto->id }}" data-nombre="{{ $repuesto->nombre }}" data-precio="{{ $repuesto->precio_venta }}" data-stock="{{ $repuesto->stock }}">{{ $repuesto->nombre }} ({{ $repuesto->stock }}) - ${{ $repuesto->precio_venta }}</option>
                    @endforeach
                </select>
                <button type="button" class="btn btn-sm btn-primary" onclick="agregarRepuesto()">Agregar Repuesto</button>
            </div>
            <table class="table table-sm" id="repuestos_table">
                <thead><tr><th>Repuesto</th><th>Cantidad</th><th>Precio</th><th></th></tr></thead>
                <tbody></tbody>
            </table>
            <button type="submit" class="btn btn-primary">Guardar Orden</button>
        </form>
    </div>
</div>

<script>
let serviciosData = [];
let repuestosData = [];

function agregarServicio() {
    const select = document.getElementById('servicio_select');
    const option = select.options[select.selectedIndex];
    if (!option.value) return;
    
    const nombre = option.dataset.nombre;
    const precio = parseFloat(option.dataset.precio);
    const id = option.value;
    
    serviciosData.push({id, nombre, precio, cantidad: 1});
    renderServicios();
    select.selectedIndex = 0;
}

function renderServicios() {
    const tbody = document.querySelector('#servicios_table tbody');
    tbody.innerHTML = serviciosData.map((s, i) => `
        <tr>
            <td>${s.nombre}<input type="hidden" name="servicios[${i}][id]" value="${s.id}"><input type="hidden" name="servicios[${i}][nombre]" value="${s.nombre}"></td>
            <td>$${s.precio}<input type="hidden" name="servicios[${i}][precio]" value="${s.precio}"></td>
            <td><button type="button" class="btn btn-sm btn-danger" onclick="eliminarServicio(${i})">×</button></td>
        </tr>
    `).join('');
}

function eliminarServicio(index) {
    serviciosData.splice(index, 1);
    renderServicios();
}

function agregarRepuesto() {
    const select = document.getElementById('repuesto_select');
    const option = select.options[select.selectedIndex];
    if (!option.value) return;
    
    const nombre = option.dataset.nombre;
    const precio = parseFloat(option.dataset.precio);
    const stock = parseInt(option.dataset.stock);
    const id = option.value;
    
    repuestosData.push({id, nombre, precio, cantidad: 1, stock});
    renderRepuestos();
    select.selectedIndex = 0;
}

function renderRepuestos() {
    const tbody = document.querySelector('#repuestos_table tbody');
    tbody.innerHTML = repuestosData.map((r, i) => `
        <tr>
            <td>${r.nombre}<input type="hidden" name="repuestos[${i}][id]" value="${r.id}"><input type="hidden" name="repuestos[${i}][nombre]" value="${r.nombre}"></td>
            <td><input type="number" name="repuestos[${i}][cantidad]" value="${r.cantidad}" min="1" max="${r.stock}" style="width:60px"></td>
            <td>$${r.precio}<input type="hidden" name="repuestos[${i}][precio]" value="${r.precio}"></td>
            <td><button type="button" class="btn btn-sm btn-danger" onclick="eliminarRepuesto(${i})">×</button></td>
        </tr>
    `).join('');
}

function eliminarRepuesto(index) {
    repuestosData.splice(index, 1);
    renderRepuestos();
}

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

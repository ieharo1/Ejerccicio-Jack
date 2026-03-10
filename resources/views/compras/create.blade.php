@extends('layouts.principal')

@section('title', 'Nueva Compra')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Nueva Compra</h2>
    <a href="{{ route('compras.index') }}" class="btn btn-secondary">Volver</a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('compras.store') }}">
            @csrf
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Proveedor</label>
                    <select name="proveedor_id" class="form-select" required>
                        @foreach($proveedores as $proveedor)
                        <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Fecha</label>
                    <input type="date" name="fecha" class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Número Factura</label>
                    <input type="text" name="numero_factura" class="form-control">
                </div>
            </div>
            <hr>
            <h5>Agregar Repuestos</h5>
            <div class="row mb-3">
                <div class="col-md-4">
                    <select id="repuesto_select" class="form-select">
                        <option value="">Seleccionar repuesto</option>
                        @foreach($repuestos as $repuesto)
                        <option value="{{ $repuesto->id }}" data-nombre="{{ $repuesto->nombre }}" data-precio="{{ $repuesto->precio_compra }}">{{ $repuesto->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="number" id="cantidad" class="form-control" placeholder="Cantidad" min="1" value="1">
                </div>
                <div class="col-md-3">
                    <input type="number" id="precio" class="form-control" placeholder="Precio" step="0.01">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-primary w-100" onclick="agregarItem()">Agregar</button>
                </div>
            </div>
            <table class="table" id="items_table">
                <thead><tr><th>Repuesto</th><th>Cantidad</th><th>Precio</th><th>Subtotal</th><th></th></tr></thead>
                <tbody></tbody>
            </table>
            <div class="mb-3">
                <label class="form-label">Observaciones</label>
                <textarea name="observaciones" class="form-control" rows="2"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Compra</button>
        </form>
    </div>
</div>

<script>
let itemsData = [];

function agregarItem() {
    const select = document.getElementById('repuesto_select');
    const option = select.options[select.selectedIndex];
    if (!option.value) return;
    
    const nombre = option.dataset.nombre;
    const precio = parseFloat(document.getElementById('precio').value) || parseFloat(option.dataset.precio);
    const cantidad = parseInt(document.getElementById('cantidad').value) || 1;
    const id = option.value;
    
    itemsData.push({id, nombre, precio, cantidad});
    renderItems();
    select.selectedIndex = 0;
    document.getElementById('cantidad').value = 1;
}

function renderItems() {
    const tbody = document.querySelector('#items_table tbody');
    tbody.innerHTML = itemsData.map((item, i) => `
        <tr>
            <td>${item.nombre}<input type="hidden" name="items[${i}][repuesto_id]" value="${item.id}"></td>
            <td><input type="number" name="items[${i}][cantidad]" value="${item.cantidad}" min="1" style="width:60px"></td>
            <td><input type="number" name="items[${i}][precio_unitario]" value="${item.precio}" step="0.01" style="width:80px"></td>
            <td>$${(item.cantidad * item.precio).toFixed(2)}</td>
            <td><button type="button" class="btn btn-sm btn-danger" onclick="eliminarItem(${i})">×</button></td>
        </tr>
    `).join('');
}

function eliminarItem(index) {
    itemsData.splice(index, 1);
    renderItems();
}

document.getElementById('repuesto_select').addEventListener('change', function() {
    const option = this.options[this.selectedIndex];
    if (option.dataset.precio) {
        document.getElementById('precio').value = option.dataset.precio;
    }
});
</script>
@endsection

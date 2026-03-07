<div class="row mb-3">
    <div class="col-6"><h4><i class="fas fa-cogs"></i> Repuestos / Inventario</h4></div>
    <div class="col-6 text-end">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalRepuesto">
            <i class="fas fa-plus"></i> Nuevo Repuesto
        </button>
    </div>
</div>

@php $repuestos = \App\Models\Repuesto::all(); @endphp
@if($repuestos->where('stock', '<', function($q) { return $q->stock_minimo; })->count() > 0)
<div class="alert alert-warning">
    <i class="fas fa-exclamation-triangle"></i> 
    Hay {{ $repuestos->where('stock', '<', function($q) { return $q->stock_minimo; })->count() }} repuestos con stock bajo
</div>
@endif

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Marca</th>
                        <th>Stock</th>
                        <th>Stock Mín.</th>
                        <th>Precio Compra</th>
                        <th>Precio Venta</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($repuestos as $r)
                    <tr class="{{ $r->stock < $r->stock_minimo ? 'table-warning' : '' }}">
                        <td>{{ $r->codigo }}</td>
                        <td>{{ $r->nombre }}</td>
                        <td>{{ $r->categoria }}</td>
                        <td>{{ $r->marca }}</td>
                        <td>{{ $r->stock }}</td>
                        <td>{{ $r->stock_minimo }}</td>
                        <td>${{ number_format($r->precio_compra, 2) }}</td>
                        <td>${{ number_format($r->precio_venta, 2) }}</td>
                        <td>
                            <button class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalRepuesto" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"><h5 class="modal-title">Nuevo Repuesto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="form-repuesto">
                    <div class="mb-3">
                        <label class="form-label">Código</label>
                        <input type="text" name="codigo" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Categoría</label>
                        <input type="text" name="categoria" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Marca</label>
                        <input type="text" name="marca" class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Stock</label>
                            <input type="number" name="stock" class="form-control" value="0">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Stock Mínimo</label>
                            <input type="number" name="stock_minimo" class="form-control" value="5">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Precio Compra</label>
                            <input type="number" step="0.01" name="precio_compra" class="form-control" value="0">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Precio Venta</label>
                            <input type="number" step="0.01" name="precio_venta" class="form-control" value="0">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Proveedor</label>
                        <select name="proveedor_id" class="form-select">
                            <option value="">Seleccione...</option>
                            @foreach(\App\Models\Proveedor::all() as $p)
                            <option value="{{ $p->id }}">{{ $p->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="guardarRepuesto()">Guardar</button>
            </div>
        </div>
    </div>
</div>

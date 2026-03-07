<div class="row mb-3">
    <div class="col-6"><h4><i class="fas fa-tools"></i> Órdenes de Servicio</h4></div>
    <div class="col-6 text-end">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalOrden">
            <i class="fas fa-plus"></i> Nueva Orden
        </button>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Número</th>
                        <th>Fecha Ingreso</th>
                        <th>Cliente</th>
                        <th>Vehículo</th>
                        <th>Tipo</th>
                        <th>Estado</th>
                        <th>Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @php $ordenes = \App\Models\OrdenServicio::with(['cliente','vehiculo'])->get(); @endphp
                    @foreach($ordenes as $o)
                    <tr>
                        <td>{{ $o->numero_orden }}</td>
                        <td>{{ $o->fecha_ingreso }}</td>
                        <td>{{ $o->cliente->nombre ?? '-' }}</td>
                        <td>{{ $o->vehiculo->placa ?? '-' }}</td>
                        <td>{{ $o->tipo_orden }}</td>
                        <td><span class="status-badge status-{{ $o->estado }}">{{ ucfirst($o->estado) }}</span></td>
                        <td>${{ number_format($o->total, 2) }}</td>
                        <td>
                            <button class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-info"><i class="fas fa-print"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalOrden" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header"><h5 class="modal-title">Nueva Orden de Servicio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="form-orden">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Cliente</label>
                            <select name="cliente_id" class="form-select" required>
                                <option value="">Seleccione...</option>
                                @foreach(\App\Models\Cliente::all() as $c)
                                <option value="{{ $c->id }}">{{ $c->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Vehículo</label>
                            <select name="vehiculo_id" class="form-select" required>
                                <option value="">Seleccione...</option>
                                @foreach(\App\Models\Vehiculo::all() as $v)
                                <option value="{{ $v->id }}">{{ $v->placa }} - {{ $v->marca }} {{ $v->modelo }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Tipo de Orden</label>
                            <select name="tipo_orden" class="form-select">
                                <option value="normal">Normal</option>
                                <option value="avanzada">Avanzada</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Garantía</label>
                            <select name="garantia" class="form-select">
                                <option value="0">No</option>
                                <option value="1">Sí</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Autoriza Prueba Ruta</label>
                            <select name="autoriza_prueba_ruta" class="form-select">
                                <option value="0">No</option>
                                <option value="1">Sí</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Motivo de Ingreso</label>
                        <textarea name="motivo_ingreso" class="form-control"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Técnico</label>
                            <input type="text" name="tecnico" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Asesor Repuestos</label>
                            <input type="text" name="asesor_repuestos" class="form-control">
                        </div>
                    </div>
                    <input type="hidden" name="estado" value="recepcion">
                    <input type="hidden" name="fecha_ingreso" value="{{ now() }}">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="guardarOrden()">Guardar</button>
            </div>
        </div>
    </div>
</div>

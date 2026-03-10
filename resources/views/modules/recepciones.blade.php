<div class="row mb-3">
    <div class="col-6"><h4><i class="fas fa-clipboard-list"></i> Órdenes de Recepción</h4></div>
    <div class="col-6 text-end">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalRecepcion">
            <i class="fas fa-plus"></i> Nueva Recepción
        </button>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Consecutivo</th>
                        <th>Fecha</th>
                        <th>Cliente</th>
                        <th>Vehículo</th>
                        <th>Motivo</th>
                        <th>Técnico</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @php $recepciones = \App\Models\OrdenRecepcion::with(['cliente','vehiculo'])->get(); @endphp
                    @foreach($recepciones as $r)
                    <tr>
                        <td>{{ $r->consecutivo }}</td>
                        <td>{{ $r->fecha }}</td>
                        <td>{{ $r->cliente->nombre ?? '-' }}</td>
                        <td>{{ $r->vehiculo->placa ?? '-' }}</td>
                        <td>{{ Str::limit($r->motivo_ingreso, 30) }}</td>
                        <td>{{ $r->tecnico }}</td>
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

<div class="modal fade" id="modalRecepcion" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header"><h5 class="modal-title">Nueva Recepción</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="form-recepcion">
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
                    <div class="mb-3">
                        <label class="form-label">Motivo de Ingreso</label>
                        <textarea name="motivo_ingreso" class="form-control" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kilometraje</label>
                            <input type="number" name="kilometraje" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nivel Combustible</label>
                            <select name="nivel_combustible" class="form-select">
                                <option value="1/4">1/4</option>
                                <option value="1/2">1/2</option>
                                <option value="3/4">3/4</option>
                                <option value="Full">Full</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Técnico</label>
                        <input type="text" name="tecnico" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Comentarios</label>
                        <textarea name="comentarios" class="form-control"></textarea>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" name="fluidos_adecuados" class="form-check-input" value="1" checked>
                        <label class="form-check-label">Fluidos Adecuados</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="guardarRecepcion()">Guardar</button>
            </div>
        </div>
    </div>
</div>

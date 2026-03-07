<div class="row mb-3">
    <div class="col-6"><h4><i class="fas fa-car"></i> Vehículos</h4></div>
    <div class="col-6 text-end">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalVehiculo">
            <i class="fas fa-plus"></i> Nuevo Vehículo
        </button>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Placa</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Año</th>
                        <th>Color</th>
                        <th>Cliente</th>
                        <th>Km</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @php $vehiculos = \App\Models\Vehiculo::with('cliente')->get(); @endphp
                    @foreach($vehiculos as $v)
                    <tr>
                        <td>{{ $v->placa }}</td>
                        <td>{{ $v->marca }}</td>
                        <td>{{ $v->modelo }}</td>
                        <td>{{ $v->año }}</td>
                        <td>{{ $v->color }}</td>
                        <td>{{ $v->cliente->nombre ?? '-' }}</td>
                        <td>{{ number_format($v->kilometraje) }}</td>
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

<div class="modal fade" id="modalVehiculo" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nuevo Vehículo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="form-vehiculo">
                    <div class="mb-3">
                        <label class="form-label">Placa</label>
                        <input type="text" name="placa" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cliente</label>
                        <select name="cliente_id" class="form-select" onchange="buscarCliente(this)">
                            <option value="">Seleccione...</option>
                            @foreach(\App\Models\Cliente::all() as $c)
                            <option value="{{ $c->id }}">{{ $c->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Marca</label>
                        <input type="text" name="marca" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Modelo</label>
                        <input type="text" name="modelo" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Año</label>
                        <input type="number" name="año" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Color</label>
                        <input type="text" name="color" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">VIN</label>
                        <input type="text" name="vin" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kilometraje</label>
                        <input type="number" name="kilometraje" class="form-control" value="0">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="guardarVehiculo()">Guardar</button>
            </div>
        </div>
    </div>
</div>

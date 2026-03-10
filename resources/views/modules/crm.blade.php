<h4><i class="fas fa-calendar-alt"></i> CRM - Servicios Programados</h4>
<div class="card mt-3">
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h6>Esta Semana</h6>
                        <h4>{{ \App\Models\ServicioProgramado::whereBetween('fecha_programacion', [now(), now()->addWeek()])->count() }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h6>Próxima Semana</h6>
                        <h4>{{ \App\Models\ServicioProgramado::whereBetween('fecha_programacion', [now()->addWeek(), now()->addWeeks(2)])->count() }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <h6>Este Mes</h6>
                        <h4>{{ \App\Models\ServicioProgramado::whereBetween('fecha_programacion', [now(), now()->addMonth()])->count() }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-secondary text-white">
                    <div class="card-body">
                        <h6>Más Adelantado</h6>
                        <h4>{{ \App\Models\ServicioProgramado::where('fecha_programacion', '>', now()->addMonth())->count() }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive mt-3">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Fecha</th>
                        <th>Cliente</th>
                        <th>Vehículo</th>
                        <th>Servicio</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(\App\Models\ServicioProgramado::with(['cliente','vehiculo'])->get() as $s)
                    <tr>
                        <td>{{ $s->fecha_programacion }}</td>
                        <td>{{ $s->cliente->nombre ?? '-' }}</td>
                        <td>{{ $s->vehiculo->placa ?? '-' }}</td>
                        <td>{{ $s->servicio }}</td>
                        <td><span class="badge bg-{{ $s->estado == 'pendiente' ? 'warning' : ($s->estado == 'realizado' ? 'success' : 'danger') }}">{{ ucfirst($s->estado) }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

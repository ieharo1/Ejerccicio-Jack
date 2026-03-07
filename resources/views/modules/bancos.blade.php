<h4><i class="fas fa-university"></i> Bancos / Cuentas</h4>
<div class="card mt-3">
    <div class="card-body">
        <div class="row">
            @foreach(\App\Models\CuentaBancaria::all() as $cuenta)
            <div class="col-md-4 mb-3">
                <div class="card border-primary">
                    <div class="card-body">
                        <h5>{{ $cuenta->nombre }}</h5>
                        <p class="text-muted">{{ $cuenta->banco }}</p>
                        <h4 class="text-primary">${{ number_format($cuenta->saldo_actual, 2) }}</h4>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="table-responsive mt-3">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Fecha</th>
                        <th>Cuenta</th>
                        <th>Tipo</th>
                        <th>Concepto</th>
                        <th>Monto</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(\App\Models\MovimientoBancario::with('cuentaBancaria')->latest()->limit(20)->get() as $m)
                    <tr>
                        <td>{{ $m->fecha }}</td>
                        <td>{{ $m->cuentaBancaria->nombre ?? '-' }}</td>
                        <td><span class="badge bg-{{ $m->tipo == 'ingreso' ? 'success' : 'danger' }}">{{ ucfirst($m->tipo) }}</span></td>
                        <td>{{ $m->concepto }}</td>
                        <td class="{{ $m->tipo == 'ingreso' ? 'text-success' : 'text-danger' }}">
                            {{ $m->tipo == 'ingreso' ? '+' : '-' }}${{ number_format($m->monto, 2) }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

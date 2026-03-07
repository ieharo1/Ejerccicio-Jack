<h4><i class="fas fa-dollar-sign"></i> Ingresos</h4>
<div class="card mt-3">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Orden</th>
                        <th>Método</th>
                        <th>Monto</th>
                        <th>Referencia</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(\App\Models\Ingreso::with('ordenServicio')->get() as $i)
                    <tr>
                        <td>{{ $i->id }}</td>
                        <td>{{ $i->fecha }}</td>
                        <td>{{ $i->ordenServicio->numero_orden ?? '-' }}</td>
                        <td>{{ $i->metodo_pago }}</td>
                        <td>${{ number_format($i->monto, 2) }}</td>
                        <td>{{ $i->numero_referencia }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

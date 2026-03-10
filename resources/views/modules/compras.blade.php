<h4><i class="fas fa-shopping-cart"></i> Compras</h4>
<div class="card mt-3">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Proveedor</th>
                        <th>Factura</th>
                        <th>Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(\App\Models\Compra::with('proveedor')->get() as $c)
                    <tr>
                        <td>{{ $c->id }}</td>
                        <td>{{ $c->fecha }}</td>
                        <td>{{ $c->proveedor->nombre ?? '-' }}</td>
                        <td>{{ $c->numero_factura }}</td>
                        <td>${{ number_format($c->total, 2) }}</td>
                        <td><button class="btn btn-sm btn-info"><i class="fas fa-print"></i></button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

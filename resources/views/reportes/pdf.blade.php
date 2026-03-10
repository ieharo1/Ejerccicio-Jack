<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reporte de Órdenes de Servicio</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #333; color: white; }
        .total { font-weight: bold; background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Reporte de Órdenes de Servicio</h1>
    <p>Fecha: {{ date('d/m/Y') }}</p>
    
    <table>
        <thead>
            <tr>
                <th>Orden</th>
                <th>Cliente</th>
                <th>Vehículo</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php $granTotal = 0; @endphp
            @foreach($ordenes as $orden)
            @php 
                $totalOrden = $orden->items->sum(function($i) { return $i->cantidad * $i->precio; });
                $granTotal += $totalOrden;
            @endphp
            <tr>
                <td>{{ $orden->id_consecutivo }}</td>
                <td>{{ $orden->cliente->nombre ?? 'N/A' }}</td>
                <td>{{ $orden->vehiculo->placa ?? 'N/A' }}</td>
                <td>{{ $orden->created_at->format('d/m/Y') }}</td>
                <td>{{ $orden->estado }}</td>
                <td>${{ number_format($totalOrden, 2) }}</td>
            </tr>
            @endforeach
            <tr class="total">
                <td colspan="5" class="text-end">Gran Total:</td>
                <td>${{ number_format($granTotal, 2) }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>

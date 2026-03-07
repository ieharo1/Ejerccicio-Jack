<?php

use Illuminate\Support\Facades\Route;
use App\Models\Cliente;
use App\Models\Vehiculo;
use App\Models\OrdenRecepcion;
use App\Models\OrdenServicio;
use App\Models\Repuesto;
use App\Models\Proveedor;
use App\Models\Compra;
use App\Models\CuentaBancaria;
use App\Models\Ingreso;
use App\Models\ServicioProgramado;

function dashboardStats(): array
{
    return [
        'clientes' => Cliente::count(),
        'vehiculos' => Vehiculo::count(),
        'ordenes_abiertas' => OrdenServicio::whereIn('estado', ['recepcion', 'diagnostico', 'repuestos', 'aprobacion', 'reparacion', 'control'])->count(),
        'ordenes_terminadas' => OrdenServicio::whereIn('estado', ['entrega', 'archivado'])->count(),
        'ingresos_mes' => Ingreso::whereMonth('fecha', date('m'))->sum('monto'),
        'compras_mes' => Compra::whereMonth('fecha', date('m'))->sum('total'),
        'repuestos_bajos' => Repuesto::whereRaw('stock < stock_minimo')->count(),
    ];
}

Route::get('/', function () {
    return view('modules.dashboard', ['stats' => dashboardStats()]);
});

Route::get('/api/module/{module}', function ($module) {
    return match ($module) {
        'dashboard' => view('modules.dashboard', ['stats' => dashboardStats()])->render(),
        'clientes' => view('modules.clientes')->render(),
        'vehiculos' => view('modules.vehiculos')->render(),
        'recepciones' => view('modules.recepciones')->render(),
        'servicios' => view('modules.servicios')->render(),
        'repuestos' => view('modules.repuestos')->render(),
        'proveedores' => view('modules.proveedores')->render(),
        'compras' => view('modules.compras')->render(),
        'ingresos' => view('modules.ingresos')->render(),
        'bancos' => view('modules.bancos')->render(),
        'crm' => view('modules.crm')->render(),
        'reportes' => view('modules.reportes')->render(),
        'usuarios' => view('modules.usuarios')->render(),
        default => '<div class="alert">Modulo no encontrado</div>',
    };
});

Route::post('/api/clientes', function () {
    Cliente::create(request()->all());
    return ['success' => true];
});

Route::post('/api/vehiculos', function () {
    Vehiculo::create(request()->all());
    return ['success' => true];
});

Route::post('/api/recepciones', function () {
    $data = request()->all();
    $data['consecutivo'] = 'REC-' . date('Ymd') . '-' . str_pad(OrdenRecepcion::count() + 1, 4, '0', STR_PAD_LEFT);
    OrdenRecepcion::create($data);
    return ['success' => true];
});

Route::post('/api/ordenes', function () {
    $data = request()->all();
    $data['numero_orden'] = OrdenServicio::generarNumeroOrden();
    OrdenServicio::create($data);
    return ['success' => true];
});

Route::post('/api/repuestos', function () {
    Repuesto::create(request()->all());
    return ['success' => true];
});

Route::post('/api/proveedores', function () {
    Proveedor::create(request()->all());
    return ['success' => true];
});

Route::post('/api/compras', function () {
    $data = request()->all();
    $compra = Compra::create($data);

    if (isset($data['items'])) {
        foreach ($data['items'] as $item) {
            $item['compra_id'] = $compra->id;
            \App\Models\CompraItem::create($item);
        }
    }

    $compra->calcularTotal();
    return ['success' => true];
});

Route::post('/api/cuentas', function () {
    CuentaBancaria::create(request()->all());
    return ['success' => true];
});

Route::post('/api/ingresos', function () {
    $data = request()->all();
    $ingreso = Ingreso::create($data);

    if ($ingreso->cuenta_bancaria_id) {
        $cuenta = $ingreso->cuentaBancaria;
        $cuenta->actualizarSaldo($ingreso->monto, 'ingreso');
    }

    return ['success' => true];
});

Route::post('/api/servicios-programados', function () {
    ServicioProgramado::create(request()->all());
    return ['success' => true];
});

Route::get('/api/clientes', fn () => Cliente::all());
Route::get('/api/vehiculos/cliente/{id}', fn ($id) => Vehiculo::where('cliente_id', $id)->get());
Route::get('/api/repuestos', fn () => Repuesto::all());
Route::get('/api/proveedores', fn () => Proveedor::all());
Route::get('/api/cuentas', fn () => CuentaBancaria::all());

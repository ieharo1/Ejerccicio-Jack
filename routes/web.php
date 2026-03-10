<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\OrdenRecepcionController;
use App\Http\Controllers\OrdenServicioController;
use App\Http\Controllers\RepuestoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\IngresoController;
use App\Http\Controllers\CuentaBancariaController;
use App\Http\Controllers\ServicioProgramadoController;
use App\Http\Controllers\ReporteController;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/vehiculos-por-cliente/{cliente_id}', function($cliente_id) {
        return \App\Models\Vehiculo::where('cliente_id', $cliente_id)->get();
    });
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('clientes', ClienteController::class);
    Route::resource('vehiculos', VehiculoController::class);
    Route::resource('recepciones', OrdenRecepcionController::class);
    Route::resource('ordenes', OrdenServicioController::class);
    Route::post('ordenes/{orden}/estado', [OrdenServicioController::class, 'cambiarEstado'])->name('ordenes.estado');
    
    Route::resource('repuestos', RepuestoController::class);
    Route::resource('proveedores', ProveedorController::class);
    Route::resource('compras', CompraController::class);
    Route::resource('servicios', ServicioController::class);
    Route::resource('ingresos', IngresoController::class);
    Route::resource('bancos', CuentaBancariaController::class);
    Route::post('bancos/{cuenta}/movimiento', [CuentaBancariaController::class, 'movimiento'])->name('bancos.movimiento');
    
    Route::resource('crm', ServicioProgramadoController::class);
    Route::get('crm/kanban', [ServicioProgramadoController::class, 'kanban'])->name('crm.kanban');
    Route::post('crm/{programado}/estado', [ServicioProgramadoController::class, 'actualizarEstado'])->name('crm.estado');
    
    Route::get('reportes', [ReporteController::class, 'index'])->name('reportes.index');
    Route::post('reportes/generar', [ReporteController::class, 'generar'])->name('reportes.generar');
    Route::post('reportes/pdf', [ReporteController::class, 'exportarPdf'])->name('reportes.pdf');
    Route::post('reportes/excel', [ReporteController::class, 'exportarExcel'])->name('reportes.excel');
});

require __DIR__.'/auth.php';

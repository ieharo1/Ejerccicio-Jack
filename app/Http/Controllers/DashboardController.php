<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Vehiculo;
use App\Models\OrdenServicio;
use App\Models\Repuesto;
use App\Models\Compra;
use App\Models\Ingreso;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $clientesCount = Cliente::count();
        $vehiculosCount = Vehiculo::count();
        
        $ordenesAbiertas = OrdenServicio::whereIn('estado', ['recepcion', 'diagnostico', 'repuestos', 'reparacion', 'control'])
            ->count();
        $ordenesTerminadas = OrdenServicio::where('estado', 'entregado')->count();
        
        $ingresosMes = Ingreso::whereMonth('fecha', Carbon::now()->month)
            ->whereYear('fecha', Carbon::now()->year)
            ->sum('monto');
            
        $comprasMes = Compra::whereMonth('fecha', Carbon::now()->month)
            ->whereYear('fecha', Carbon::now()->year)
            ->sum('total');
            
        $stockBajo = Repuesto::whereRaw('stock <= stock_minimo')->get();
        
        $ordenesRecientes = OrdenServicio::with(['cliente', 'vehiculo'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();
            
        $ingresosPorMes = Ingreso::selectRaw('MONTH(fecha) as mes, SUM(monto) as total')
            ->whereYear('fecha', Carbon::now()->year)
            ->groupBy('mes')
            ->get();

        return view('dashboard', compact(
            'clientesCount',
            'vehiculosCount',
            'ordenesAbiertas',
            'ordenesTerminadas',
            'ingresosMes',
            'comprasMes',
            'stockBajo',
            'ordenesRecientes',
            'ingresosPorMes'
        ));
    }
}

<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Cliente;
use App\Models\Vehiculo;
use App\Models\OrdenRecepcion;
use App\Models\OrdenServicio;
use App\Models\OrdenServicioItem;
use App\Models\Movimiento;
use App\Models\Repuesto;

class Dashboard extends Component
{
    public $totalClientes = 0;
    public $totalVehiculos = 0;
    public $ordenesRecepcionPendientes = 0;
    public $ordenesServicioActivas = 0;
    public $ingresosMes = 0;
    public $egresosMes = 0;
    public $repuestosStockMinimo = 0;

    public function mount()
    {
        $this->cargarDatos();
    }

    public function cargarDatos()
    {
        $this->totalClientes = Cliente::count();
        $this->totalVehiculos = Vehiculo::count();
        $this->ordenesRecepcionPendientes = OrdenRecepcion::where('estado', 'pendiente')->count();
        $this->ordenesServicioActivas = OrdenServicio::whereIn('estado', ['recibido', 'en_proceso'])->count();
        
        $this->ingresosMes = Movimiento::where('tipo', 'ingreso')
            ->whereMonth('fecha', now()->month)
            ->whereYear('fecha', now()->year)
            ->sum('monto');
            
        $this->egresosMes = Movimiento::where('tipo', 'egreso')
            ->whereMonth('fecha', now()->month)
            ->whereYear('fecha', now()->year)
            ->sum('monto');

        $this->repuestosStockMinimo = Repuesto::whereRaw('stock <= stock_minimo')->count();
    }

    public function render()
    {
        return view('livewire.dashboard.dashboard');
    }
}

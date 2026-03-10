<?php

namespace App\Livewire\Reportes;

use Livewire\Component;
use App\Models\OrdenServicio;
use App\Models\OrdenRecepcion;
use App\Models\Movimiento;
use App\Models\Cliente;
use App\Models\Repuesto;
use Carbon\Carbon;

class Index extends Component
{
    public $reporte_seleccionado = 'resumen';
    public $fecha_inicio = '';
    public $fecha_fin = '';
    public $resultados = [];

    public function mount()
    {
        $this->fecha_inicio = Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->fecha_fin = Carbon::now()->endOfMonth()->format('Y-m-d');
        $this->generarReporte();
    }

    public function updatedReporteSeleccionado()
    {
        $this->generarReporte();
    }

    public function generarReporte()
    {
        switch ($this->reporte_seleccionado) {
            case 'resumen':
                $this->resultados = [
                    'total_ordenes' => OrdenServicio::count(),
                    'ordenes_mes' => OrdenServicio::whereBetween('created_at', [$this->fecha_inicio, $this->fecha_fin])->count(),
                    'total_clientes' => Cliente::count(),
                    'ingresos' => Movimiento::where('tipo', 'ingreso')->whereBetween('fecha', [$this->fecha_inicio, $this->fecha_fin])->sum('monto'),
                    'egresos' => Movimiento::where('tipo', 'egreso')->whereBetween('fecha', [$this->fecha_inicio, $this->fecha_fin])->sum('monto'),
                    'repuestos_bajo_stock' => Repuesto::whereRaw('stock <= stock_minimo')->count(),
                ];
                break;

            case 'ordenes_servicio':
                $this->resultados = OrdenServicio::with(['cliente', 'vehiculo'])
                    ->whereBetween('created_at', [$this->fecha_inicio, $this->fecha_fin])
                    ->orderBy('created_at', 'desc')
                    ->get();
                break;

            case 'recepciones':
                $this->resultados = OrdenRecepcion::with(['cliente', 'vehiculo'])
                    ->whereBetween('fecha', [$this->fecha_inicio, $this->fecha_fin])
                    ->orderBy('fecha', 'desc')
                    ->get();
                break;

            case 'movimientos':
                $this->resultados = Movimiento::with(['cuentaBancaria', 'ordenServicio'])
                    ->whereBetween('fecha', [$this->fecha_inicio, $this->fecha_fin])
                    ->orderBy('fecha', 'desc')
                    ->get();
                break;

            case 'top_clientes':
                $this->resultados = Cliente::withCount('ordenServicios')
                    ->orderBy('orden_servicios_count', 'desc')
                    ->limit(10)
                    ->get();
                break;
        }
    }

    public function render()
    {
        return view('livewire.reportes.index');
    }
}

<?php

namespace App\Livewire\ServiciosProgramados;

use Livewire\Component;
use App\Models\ServicioProgramado;

class Kanban extends Component
{
    public $pendientes = [];
    public $enProceso = [];
    public $completados = [];
    public $cancelados = [];

    public function mount()
    {
        $this->cargarDatos();
    }

    public function cargarDatos()
    {
        $this->pendientes = ServicioProgramado::with(['cliente', 'vehiculo'])
            ->where('estado', 'pendiente')
            ->orderBy('fecha_programacion')
            ->get();

        $this->enProceso = ServicioProgramado::with(['cliente', 'vehiculo'])
            ->where('estado', 'en_proceso')
            ->orderBy('fecha_programacion')
            ->get();

        $this->completados = ServicioProgramado::with(['cliente', 'vehiculo'])
            ->where('estado', 'completado')
            ->orderBy('fecha_programacion', 'desc')
            ->limit(20)
            ->get();

        $this->cancelados = ServicioProgramado::with(['cliente', 'vehiculo'])
            ->where('estado', 'cancelado')
            ->orderBy('fecha_programacion', 'desc')
            ->limit(20)
            ->get();
    }

    public function cambiarEstado($id, $estado)
    {
        $servicio = ServicioProgramado::findOrFail($id);
        $servicio->update(['estado' => $estado]);
        $this->cargarDatos();
    }

    public function render()
    {
        return view('livewire.servicios-programados.kanban');
    }
}

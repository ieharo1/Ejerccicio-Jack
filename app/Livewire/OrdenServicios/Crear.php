<?php

namespace App\Livewire\OrdenServicios;

use Livewire\Component;
use App\Models\OrdenServicio;
use App\Models\OrdenRecepcion;
use App\Models\Cliente;
use App\Models\Vehiculo;
use App\Models\Servicio;

class Crear extends Component
{
    public $orden_recepcion_id = '';
    public $cliente_id = '';
    public $vehiculo_id = '';
    public $tipo = 'mantenimiento';
    public $garantia = false;
    public $autoriza_prueba_ruta = false;
    public $asesor_repuestos = '';
    public $tecnico = '';
    public $observaciones = '';
    public $modalOpen = false;
    public $vehiculos = [];
    public $recepciones = [];

    protected $rules = [
        'orden_recepcion_id' => 'nullable|exists:orden_recepcions,id',
        'cliente_id' => 'required|exists:clientes,id',
        'vehiculo_id' => 'required|exists:vehiculos,id',
        'tipo' => 'required|string|in:mantenimiento,reparacion,garantia',
        'garantia' => 'boolean',
        'autoriza_prueba_ruta' => 'boolean',
        'asesor_repuestos' => 'nullable|string|max:255',
        'tecnico' => 'nullable|string|max:255',
        'observaciones' => 'nullable|string',
    ];

    public function updatedClienteId($value)
    {
        $this->vehiculos = Vehiculo::where('cliente_id', $value)->get();
        $this->recepciones = OrdenRecepcion::where('cliente_id', $value)->where('estado', '!=', 'completado')->get();
        $this->vehiculo_id = '';
    }

    public function openModal()
    {
        $this->resetFields();
        $this->modalOpen = true;
    }

    public function closeModal()
    {
        $this->modalOpen = false;
    }

    public function resetFields()
    {
        $this->reset(['orden_recepcion_id', 'cliente_id', 'vehiculo_id', 'tipo', 'garantia', 'autoriza_prueba_ruta', 'asesor_repuestos', 'tecnico', 'observaciones', 'vehiculos', 'recepciones']);
    }

    public function store()
    {
        $this->validate();

        $numeroOrden = OrdenServicio::max('numero_orden') + 1;

        OrdenServicio::create([
            'numero_orden' => $numeroOrden,
            'orden_recepcion_id' => $this->orden_recepcion_id ?: null,
            'cliente_id' => $this->cliente_id,
            'vehiculo_id' => $this->vehiculo_id,
            'tipo' => $this->tipo,
            'garantia' => $this->garantia,
            'autoriza_prueba_ruta' => $this->autoriza_prueba_ruta,
            'fecha_ingreso' => now(),
            'asesor_repuestos' => $this->asesor_repuestos,
            'tecnico' => $this->tecnico,
            'observaciones' => $this->observaciones,
            'estado' => 'recibido',
            'subtotal' => 0,
            'impuesto' => 0,
            'total' => 0,
        ]);

        session()->flash('message', 'Orden de servicio creada exitosamente.');
        $this->closeModal();
        $this->dispatch('servicio-creado');
    }

    public function render()
    {
        $clientes = Cliente::all();
        return view('livewire.orden-servicios.crear', compact('clientes'));
    }
}

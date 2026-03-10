<?php

namespace App\Livewire\ServiciosProgramados;

use Livewire\Component;
use App\Models\ServicioProgramado;
use App\Models\Cliente;
use App\Models\Vehiculo;

class Crear extends Component
{
    public $cliente_id = '';
    public $vehiculo_id = '';
    public $categoria = '';
    public $servicio = '';
    public $fecha_programacion = '';
    public $observacion = '';
    public $modalOpen = false;
    public $vehiculos = [];

    protected $rules = [
        'cliente_id' => 'required|exists:clientes,id',
        'vehiculo_id' => 'required|exists:vehiculos,id',
        'categoria' => 'required|string|max:100',
        'servicio' => 'required|string|max:255',
        'fecha_programacion' => 'required|date',
        'observacion' => 'nullable|string',
    ];

    public function updatedClienteId($value)
    {
        $this->vehiculos = Vehiculo::where('cliente_id', $value)->get();
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
        $this->reset(['cliente_id', 'vehiculo_id', 'categoria', 'servicio', 'fecha_programacion', 'observacion', 'vehiculos']);
    }

    public function store()
    {
        $this->validate();

        ServicioProgramado::create([
            'cliente_id' => $this->cliente_id,
            'vehiculo_id' => $this->vehiculo_id,
            'categoria' => $this->categoria,
            'servicio' => $this->servicio,
            'fecha_programacion' => $this->fecha_programacion,
            'observacion' => $this->observacion,
            'estado' => 'pendiente',
        ]);

        session()->flash('message', 'Servicio programado creado exitosamente.');
        $this->closeModal();
        $this->dispatch('servicio-programado-creado');
    }

    public function render()
    {
        $clientes = Cliente::all();
        return view('livewire.servicios-programados.crear', compact('clientes'));
    }
}

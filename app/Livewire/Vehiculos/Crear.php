<?php

namespace App\Livewire\Vehiculos;

use Livewire\Component;
use App\Models\Vehiculo;
use App\Models\Cliente;

class Crear extends Component
{
    public $cliente_id = '';
    public $placa = '';
    public $marca = '';
    public $modelo = '';
    public $año = '';
    public $color = '';
    public $vin = '';
    public $kilometraje = '';
    public $modalOpen = false;

    protected $rules = [
        'cliente_id' => 'required|exists:clientes,id',
        'placa' => 'required|string|max:20|unique:vehiculos,placa',
        'marca' => 'required|string|max:100',
        'modelo' => 'required|string|max:100',
        'año' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
        'color' => 'nullable|string|max:50',
        'vin' => 'nullable|string|max:50|unique:vehiculos,vin',
        'kilometraje' => 'nullable|integer|min:0',
    ];

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
        $this->reset(['cliente_id', 'placa', 'marca', 'modelo', 'año', 'color', 'vin', 'kilometraje']);
    }

    public function store()
    {
        $this->validate();

        Vehiculo::create([
            'cliente_id' => $this->cliente_id,
            'placa' => $this->placa,
            'marca' => $this->marca,
            'modelo' => $this->modelo,
            'año' => $this->año,
            'color' => $this->color,
            'vin' => $this->vin,
            'kilometraje' => $this->kilometraje,
        ]);

        session()->flash('message', 'Vehículo creado exitosamente.');
        $this->closeModal();
        $this->dispatch('vehiculo-creado');
    }

    public function render()
    {
        $clientes = Cliente::all();
        return view('livewire.vehiculos.crear', compact('clientes'));
    }
}

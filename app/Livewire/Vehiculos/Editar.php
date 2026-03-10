<?php

namespace App\Livewire\Vehiculos;

use Livewire\Component;
use App\Models\Vehiculo;
use App\Models\Cliente;

class Editar extends Component
{
    public $vehiculoId = null;
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
        'placa' => 'required|string|max:20',
        'marca' => 'required|string|max:100',
        'modelo' => 'required|string|max:100',
        'año' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
        'color' => 'nullable|string|max:50',
        'vin' => 'nullable|string|max:50',
        'kilometraje' => 'nullable|integer|min:0',
    ];

    public function openModal($id)
    {
        $this->vehiculoId = $id;
        $vehiculo = Vehiculo::findOrFail($id);
        $this->cliente_id = $vehiculo->cliente_id;
        $this->placa = $vehiculo->placa;
        $this->marca = $vehiculo->marca;
        $this->modelo = $vehiculo->modelo;
        $this->año = $vehiculo->año;
        $this->color = $vehiculo->color;
        $this->vin = $vehiculo->vin;
        $this->kilometraje = $vehiculo->kilometraje;
        $this->modalOpen = true;
    }

    public function closeModal()
    {
        $this->modalOpen = false;
    }

    public function update()
    {
        $this->validate();

        $vehiculo = Vehiculo::findOrFail($this->vehiculoId);
        $vehiculo->update([
            'cliente_id' => $this->cliente_id,
            'placa' => $this->placa,
            'marca' => $this->marca,
            'modelo' => $this->modelo,
            'año' => $this->año,
            'color' => $this->color,
            'vin' => $this->vin,
            'kilometraje' => $this->kilometraje,
        ]);

        session()->flash('message', 'Vehículo actualizado exitosamente.');
        $this->closeModal();
        $this->dispatch('vehiculo-actualizado');
    }

    public function delete($id)
    {
        Vehiculo::findOrFail($id)->delete();
        session()->flash('message', 'Vehículo eliminado exitosamente.');
        $this->dispatch('vehiculo-actualizado');
    }

    public function render()
    {
        $clientes = Cliente::all();
        return view('livewire.vehiculos.editar', compact('clientes'));
    }
}

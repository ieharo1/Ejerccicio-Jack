<?php

namespace App\Livewire\Clientes;

use Livewire\Component;
use App\Models\Cliente;

class Editar extends Component
{
    public $clienteId = null;
    public $nombre = '';
    public $cedula_ruc = '';
    public $telefono = '';
    public $email = '';
    public $direccion = '';
    public $ciudad = '';
    public $observaciones = '';
    public $modalOpen = false;

    protected $rules = [
        'nombre' => 'required|string|max:255',
        'cedula_ruc' => 'required|string|max:20',
        'telefono' => 'nullable|string|max:20',
        'email' => 'nullable|email|max:255',
        'direccion' => 'nullable|string|max:255',
        'ciudad' => 'nullable|string|max:100',
        'observaciones' => 'nullable|string',
    ];

    public function openModal($id)
    {
        $this->clienteId = $id;
        $cliente = Cliente::findOrFail($id);
        $this->nombre = $cliente->nombre;
        $this->cedula_ruc = $cliente->cedula_ruc;
        $this->telefono = $cliente->telefono;
        $this->email = $cliente->email;
        $this->direccion = $cliente->direccion;
        $this->ciudad = $cliente->ciudad;
        $this->observaciones = $cliente->observaciones;
        $this->modalOpen = true;
    }

    public function closeModal()
    {
        $this->modalOpen = false;
    }

    public function update()
    {
        $this->validate();

        $cliente = Cliente::findOrFail($this->clienteId);
        $cliente->update([
            'nombre' => $this->nombre,
            'cedula_ruc' => $this->cedula_ruc,
            'telefono' => $this->telefono,
            'email' => $this->email,
            'direccion' => $this->direccion,
            'ciudad' => $this->ciudad,
            'observaciones' => $this->observaciones,
        ]);

        session()->flash('message', 'Cliente actualizado exitosamente.');
        $this->closeModal();
        $this->dispatch('cliente-actualizado');
    }

    public function delete($id)
    {
        Cliente::findOrFail($id)->delete();
        session()->flash('message', 'Cliente eliminado exitosamente.');
        $this->dispatch('cliente-actualizado');
    }

    public function render()
    {
        return view('livewire.clientes.editar');
    }
}

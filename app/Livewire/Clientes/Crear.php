<?php

namespace App\Livewire\Clientes;

use Livewire\Component;
use App\Models\Cliente;

class Crear extends Component
{
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
        'cedula_ruc' => 'required|string|max:20|unique:clientes,cedula_ruc',
        'telefono' => 'nullable|string|max:20',
        'email' => 'nullable|email|max:255',
        'direccion' => 'nullable|string|max:255',
        'ciudad' => 'nullable|string|max:100',
        'observaciones' => 'nullable|string',
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
        $this->reset(['nombre', 'cedula_ruc', 'telefono', 'email', 'direccion', 'ciudad', 'observaciones']);
    }

    public function store()
    {
        $this->validate();

        Cliente::create([
            'nombre' => $this->nombre,
            'cedula_ruc' => $this->cedula_ruc,
            'telefono' => $this->telefono,
            'email' => $this->email,
            'direccion' => $this->direccion,
            'ciudad' => $this->ciudad,
            'observaciones' => $this->observaciones,
        ]);

        session()->flash('message', 'Cliente creado exitosamente.');
        $this->closeModal();
        $this->dispatch('cliente-creado');
    }

    public function render()
    {
        return view('livewire.clientes.crear');
    }
}

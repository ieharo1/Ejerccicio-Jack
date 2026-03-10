<?php

namespace App\Livewire\Proveedores;

use Livewire\Component;
use App\Models\Proveedor;

class Crear extends Component
{
    public $nombre = '';
    public $telefono = '';
    public $email = '';
    public $direccion = '';
    public $contacto = '';
    public $modalOpen = false;

    protected $rules = [
        'nombre' => 'required|string|max:255',
        'telefono' => 'nullable|string|max:20',
        'email' => 'nullable|email|max:255',
        'direccion' => 'nullable|string|max:255',
        'contacto' => 'nullable|string|max:255',
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
        $this->reset(['nombre', 'telefono', 'email', 'direccion', 'contacto']);
    }

    public function store()
    {
        $this->validate();

        Proveedor::create([
            'nombre' => $this->nombre,
            'telefono' => $this->telefono,
            'email' => $this->email,
            'direccion' => $this->direccion,
            'contacto' => $this->contacto,
        ]);

        session()->flash('message', 'Proveedor creado exitosamente.');
        $this->closeModal();
        $this->dispatch('proveedor-creado');
    }

    public function render()
    {
        return view('livewire.proveedores.crear');
    }
}

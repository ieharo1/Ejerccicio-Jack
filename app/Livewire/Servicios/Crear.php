<?php

namespace App\Livewire\Servicios;

use Livewire\Component;
use App\Models\Servicio;

class Crear extends Component
{
    public $nombre = '';
    public $descripcion = '';
    public $precio = '';
    public $categoria = '';
    public $activo = true;
    public $modalOpen = false;

    protected $rules = [
        'nombre' => 'required|string|max:255',
        'descripcion' => 'nullable|string',
        'precio' => 'required|numeric|min:0',
        'categoria' => 'nullable|string|max:100',
        'activo' => 'boolean',
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
        $this->reset(['nombre', 'descripcion', 'precio', 'categoria', 'activo']);
    }

    public function store()
    {
        $this->validate();

        Servicio::create([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'precio' => $this->precio,
            'categoria' => $this->categoria,
            'activo' => $this->activo,
        ]);

        session()->flash('message', 'Servicio creado exitosamente.');
        $this->closeModal();
        $this->dispatch('servicio-creado');
    }

    public function render()
    {
        return view('livewire.servicios.crear');
    }
}

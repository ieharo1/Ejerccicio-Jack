<?php

namespace App\Livewire\Servicios;

use Livewire\Component;
use App\Models\Servicio;

class Editar extends Component
{
    public $servicioId = null;
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

    public function openModal($id)
    {
        $this->servicioId = $id;
        $servicio = Servicio::findOrFail($id);
        $this->nombre = $servicio->nombre;
        $this->descripcion = $servicio->descripcion;
        $this->precio = $servicio->precio;
        $this->categoria = $servicio->categoria;
        $this->activo = $servicio->activo;
        $this->modalOpen = true;
    }

    public function closeModal()
    {
        $this->modalOpen = false;
    }

    public function update()
    {
        $this->validate();

        $servicio = Servicio::findOrFail($this->servicioId);
        $servicio->update([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'precio' => $this->precio,
            'categoria' => $this->categoria,
            'activo' => $this->activo,
        ]);

        session()->flash('message', 'Servicio actualizado exitosamente.');
        $this->closeModal();
        $this->dispatch('servicio-actualizado');
    }

    public function delete($id)
    {
        Servicio::findOrFail($id)->delete();
        session()->flash('message', 'Servicio eliminado exitosamente.');
        $this->dispatch('servicio-actualizado');
    }

    public function render()
    {
        return view('livewire.servicios.editar');
    }
}

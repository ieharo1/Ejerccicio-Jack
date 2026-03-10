<?php

namespace App\Livewire\Proveedores;

use Livewire\Component;
use App\Models\Proveedor;

class Editar extends Component
{
    public $proveedorId = null;
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

    public function openModal($id)
    {
        $this->proveedorId = $id;
        $proveedor = Proveedor::findOrFail($id);
        $this->nombre = $proveedor->nombre;
        $this->telefono = $proveedor->telefono;
        $this->email = $proveedor->email;
        $this->direccion = $proveedor->direccion;
        $this->contacto = $proveedor->contacto;
        $this->modalOpen = true;
    }

    public function closeModal()
    {
        $this->modalOpen = false;
    }

    public function update()
    {
        $this->validate();

        $proveedor = Proveedor::findOrFail($this->proveedorId);
        $proveedor->update([
            'nombre' => $this->nombre,
            'telefono' => $this->telefono,
            'email' => $this->email,
            'direccion' => $this->direccion,
            'contacto' => $this->contacto,
        ]);

        session()->flash('message', 'Proveedor actualizado exitosamente.');
        $this->closeModal();
        $this->dispatch('proveedor-actualizado');
    }

    public function delete($id)
    {
        Proveedor::findOrFail($id)->delete();
        session()->flash('message', 'Proveedor eliminado exitosamente.');
        $this->dispatch('proveedor-actualizado');
    }

    public function render()
    {
        return view('livewire.proveedores.editar');
    }
}

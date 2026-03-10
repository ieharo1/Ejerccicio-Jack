<?php

namespace App\Livewire\OrdenRecepcions;

use Livewire\Component;
use App\Models\OrdenRecepcion;

class Ver extends Component
{
    public $recepcion = null;
    public $modalOpen = false;

    public function openModal($id)
    {
        $this->recepcion = OrdenRecepcion::with(['cliente', 'vehiculo', 'ordenServicios'])->findOrFail($id);
        $this->modalOpen = true;
    }

    public function closeModal()
    {
        $this->modalOpen = false;
        $this->recepcion = null;
    }

    public function cambiarEstado($estado)
    {
        if ($this->recepcion) {
            $this->recepcion->update(['estado' => $estado]);
            $this->dispatch('recepcion-actualizada');
        }
    }

    public function render()
    {
        return view('livewire.orden-recepcions.ver');
    }
}

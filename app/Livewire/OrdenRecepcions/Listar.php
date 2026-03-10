<?php

namespace App\Livewire\OrdenRecepcions;

use Livewire\Component;
use App\Models\OrdenRecepcion;
use Livewire\WithPagination;

class Listar extends Component
{
    use WithPagination;

    public $search = '';
    public $estado = '';
    public $sortField = 'fecha';
    public $sortDirection = 'desc';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'desc';
        }
        $this->sortField = $field;
    }

    public function render()
    {
        $recepciones = OrdenRecepcion::with(['cliente', 'vehiculo'])
            ->when($this->search, function ($query) {
                $query->where('consecutivo', 'like', '%' . $this->search . '%')
                    ->orWhereHas('cliente', function ($q) {
                        $q->where('nombre', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('vehiculo', function ($q) {
                        $q->where('placa', 'like', '%' . $this->search . '%');
                    });
            })
            ->when($this->estado, function ($query) {
                $query->where('estado', $this->estado);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.orden-recepcions.listar', compact('recepciones'));
    }
}

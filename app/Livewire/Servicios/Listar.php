<?php

namespace App\Livewire\Servicios;

use Livewire\Component;
use App\Models\Servicio;
use Livewire\WithPagination;

class Listar extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'nombre';
    public $sortDirection = 'asc';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }

    public function render()
    {
        $servicios = Servicio::when($this->search, function ($query) {
            $query->where('nombre', 'like', '%' . $this->search . '%')
                ->orWhere('descripcion', 'like', '%' . $this->search . '%')
                ->orWhere('categoria', 'like', '%' . $this->search . '%');
        })
        ->orderBy($this->sortField, $this->sortDirection)
        ->paginate(10);

        return view('livewire.servicios.listar', compact('servicios'));
    }
}

<?php

namespace App\Livewire\Proveedores;

use Livewire\Component;
use App\Models\Proveedor;
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
        $proveedores = Proveedor::when($this->search, function ($query) {
            $query->where('nombre', 'like', '%' . $this->search . '%')
                ->orWhere('telefono', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%');
        })
        ->orderBy($this->sortField, $this->sortDirection)
        ->paginate(10);

        return view('livewire.proveedores.listar', compact('proveedores'));
    }
}

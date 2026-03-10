<?php

namespace App\Livewire\Clientes;

use Livewire\Component;
use App\Models\Cliente;
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
        $clientes = Cliente::when($this->search, function ($query) {
            $query->where('nombre', 'like', '%' . $this->search . '%')
                ->orWhere('cedula_ruc', 'like', '%' . $this->search . '%')
                ->orWhere('telefono', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%');
        })
        ->orderBy($this->sortField, $this->sortDirection)
        ->paginate(10);

        return view('livewire.clientes.listar', compact('clientes'));
    }
}

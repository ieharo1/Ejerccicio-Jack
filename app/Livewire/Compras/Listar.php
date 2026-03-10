<?php

namespace App\Livewire\Compras;

use Livewire\Component;
use App\Models\Compra;
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
        $compras = Compra::with('proveedor')
            ->when($this->search, function ($query) {
                $query->where('numero_factura', 'like', '%' . $this->search . '%')
                    ->orWhereHas('proveedor', function ($q) {
                        $q->where('nombre', 'like', '%' . $this->search . '%');
                    });
            })
            ->when($this->estado, function ($query) {
                $query->where('estado', $this->estado);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.compras.listar', compact('compras'));
    }
}

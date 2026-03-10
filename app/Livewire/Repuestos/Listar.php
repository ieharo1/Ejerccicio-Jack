<?php

namespace App\Livewire\Repuestos;

use Livewire\Component;
use App\Models\Repuesto;
use App\Models\CategoriaRepuesto;
use Livewire\WithPagination;

class Listar extends Component
{
    use WithPagination;

    public $search = '';
    public $categoria_id = '';
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
        $repuestos = Repuesto::with('categoria')
            ->when($this->search, function ($query) {
                $query->where('nombre', 'like', '%' . $this->search . '%')
                    ->orWhere('codigo', 'like', '%' . $this->search . '%')
                    ->orWhere('marca', 'like', '%' . $this->search . '%');
            })
            ->when($this->categoria_id, function ($query) {
                $query->where('categoria_id', $this->categoria_id);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        $categorias = CategoriaRepuesto::all();

        return view('livewire.repuestos.listar', compact('repuestos', 'categorias'));
    }
}

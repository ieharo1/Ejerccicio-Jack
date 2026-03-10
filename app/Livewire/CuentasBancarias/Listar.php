<?php

namespace App\Livewire\CuentasBancarias;

use Livewire\Component;
use App\Models\CuentaBancaria;
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
        $cuentas = CuentaBancaria::when($this->search, function ($query) {
            $query->where('nombre', 'like', '%' . $this->search . '%')
                ->orWhere('banco', 'like', '%' . $this->search . '%')
                ->orWhere('numero_cuenta', 'like', '%' . $this->search . '%');
        })
        ->orderBy($this->sortField, $this->sortDirection)
        ->paginate(10);

        return view('livewire.cuentas-bancarias.listar', compact('cuentas'));
    }
}

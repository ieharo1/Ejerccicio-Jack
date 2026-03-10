<?php

namespace App\Livewire\Vehiculos;

use Livewire\Component;
use App\Models\Vehiculo;
use App\Models\Cliente;
use Livewire\WithPagination;

class Listar extends Component
{
    use WithPagination;

    public $search = '';
    public $cliente_id = '';
    public $sortField = 'placa';
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
        $clientes = Cliente::all();
        
        $vehiculos = Vehiculo::with('cliente')
            ->when($this->search, function ($query) {
                $query->where('placa', 'like', '%' . $this->search . '%')
                    ->orWhere('marca', 'like', '%' . $this->search . '%')
                    ->orWhere('modelo', 'like', '%' . $this->search . '%')
                    ->orWhere('vin', 'like', '%' . $this->search . '%');
            })
            ->when($this->cliente_id, function ($query) {
                $query->where('cliente_id', $this->cliente_id);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.vehiculos.listar', compact('vehiculos', 'clientes'));
    }
}

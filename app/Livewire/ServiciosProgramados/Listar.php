<?php

namespace App\Livewire\ServiciosProgramados;

use Livewire\Component;
use App\Models\ServicioProgramado;
use Livewire\WithPagination;

class Listar extends Component
{
    use WithPagination;

    public $search = '';
    public $estado = '';
    public $sortField = 'fecha_programacion';
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
        $servicios = ServicioProgramado::with(['cliente', 'vehiculo'])
            ->when($this->search, function ($query) {
                $query->where('servicio', 'like', '%' . $this->search . '%')
                    ->orWhere('categoria', 'like', '%' . $this->search . '%')
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

        return view('livewire.servicios-programados.listar', compact('servicios'));
    }
}

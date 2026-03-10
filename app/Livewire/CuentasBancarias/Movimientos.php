<?php

namespace App\Livewire\CuentasBancarias;

use Livewire\Component;
use App\Models\CuentaBancaria;
use App\Models\Movimiento;
use App\Models\OrdenServicio;
use Livewire\WithPagination;

class Movimientos extends Component
{
    public $cuenta_id = '';
    public $search = '';
    public $tipo = '';
    public $sortField = 'fecha';
    public $sortDirection = 'desc';
    public $modalOpen = false;
    public $cuentas = [];
    public $movimientos = [];
    public $cuenta_actual = null;

    protected $rules = [
        'cuenta_id' => 'required|exists:cuentas_bancarias,id',
    ];

    public function mount()
    {
        $this->cuentas = CuentaBancaria::where('activa', true)->get();
    }

    public function openModal($id = null)
    {
        if ($id) {
            $this->cuenta_id = $id;
        }
        $this->cuenta_actual = CuentaBancaria::find($this->cuenta_id);
        $this->modalOpen = true;
        $this->cargarMovimientos();
    }

    public function closeModal()
    {
        $this->modalOpen = false;
        $this->cuenta_actual = null;
    }

    public function cargarMovimientos()
    {
        $this->movimientos = Movimiento::with('ordenServicio')
            ->when($this->cuenta_id, function ($query) {
                $query->where('cuenta_bancaria_id', $this->cuenta_id);
            })
            ->when($this->search, function ($query) {
                $query->where('descripcion', 'like', '%' . $this->search . '%');
            })
            ->when($this->tipo, function ($query) {
                $query->where('tipo', $this->tipo);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->get();
    }

    public function addMovimiento()
    {
        $this->validate([
            'tipo' => 'required|in:ingreso,egreso',
        ]);

        $this->validate([
            'tipo' => 'required|in:ingreso,egreso',
        ]);

        $monto = 0;
        $descripcion = '';

        $this->dispatch('abrir-formulario-movimiento');
    }

    public function render()
    {
        return view('livewire.cuentas-bancarias.movimientos');
    }
}

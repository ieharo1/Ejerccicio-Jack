<?php

namespace App\Livewire\CuentasBancarias;

use Livewire\Component;
use App\Models\CuentaBancaria;

class Crear extends Component
{
    public $nombre = '';
    public $banco = '';
    public $numero_cuenta = '';
    public $saldo_actual = 0;
    public $activa = true;
    public $modalOpen = false;

    protected $rules = [
        'nombre' => 'required|string|max:255',
        'banco' => 'required|string|max:100',
        'numero_cuenta' => 'required|string|max:50',
        'saldo_actual' => 'required|numeric|min:0',
        'activa' => 'boolean',
    ];

    public function openModal()
    {
        $this->resetFields();
        $this->modalOpen = true;
    }

    public function closeModal()
    {
        $this->modalOpen = false;
    }

    public function resetFields()
    {
        $this->reset(['nombre', 'banco', 'numero_cuenta', 'saldo_actual', 'activa']);
    }

    public function store()
    {
        $this->validate();

        CuentaBancaria::create([
            'nombre' => $this->nombre,
            'banco' => $this->banco,
            'numero_cuenta' => $this->numero_cuenta,
            'saldo_actual' => $this->saldo_actual,
            'activa' => $this->activa,
        ]);

        session()->flash('message', 'Cuenta bancaria creada exitosamente.');
        $this->closeModal();
        $this->dispatch('cuenta-creada');
    }

    public function render()
    {
        return view('livewire.cuentas-bancarias.crear');
    }
}

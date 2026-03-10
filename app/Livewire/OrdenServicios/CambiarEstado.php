<?php

namespace App\Livewire\OrdenServicios;

use Livewire\Component;
use App\Models\OrdenServicio;
use App\Models\Movimiento;
use App\Models\CuentaBancaria;

class CambiarEstado extends Component
{
    public $servicioId = null;
    public $estado = '';
    public $modalOpen = false;
    public $cuentas = [];
    public $cuenta_id = '';
    public $monto_pago = 0;
    public $descripcion_pago = '';

    protected $rules = [
        'estado' => 'required|string',
    ];

    public function openModal($id)
    {
        $this->servicioId = $id;
        $this->estado = OrdenServicio::findOrFail($id)->estado;
        $this->cuentas = CuentaBancaria::where('activa', true)->get();
        $this->modalOpen = true;
    }

    public function closeModal()
    {
        $this->modalOpen = false;
    }

    public function updateEstado()
    {
        $servicio = OrdenServicio::findOrFail($this->servicioId);
        
        if ($this->estado === 'completado' && $this->monto_pago > 0 && $this->cuenta_id) {
            Movimiento::create([
                'cuenta_bancaria_id' => $this->cuenta_id,
                'tipo' => 'ingreso',
                'monto' => $this->monto_pago,
                'descripcion' => 'Pago orden #' . $servicio->numero_orden . ' - ' . $this->descripcion_pago,
                'orden_servicio_id' => $servicio->id,
                'fecha' => now(),
            ]);

            $cuenta = CuentaBancaria::findOrFail($this->cuenta_id);
            $cuenta->update(['saldo_actual' => $cuenta->saldo_actual + $this->monto_pago]);
        }

        $servicio->update(['estado' => $this->estado]);

        session()->flash('message', 'Estado actualizado exitosamente.');
        $this->closeModal();
        $this->dispatch('servicio-actualizado');
    }

    public function render()
    {
        return view('livewire.orden-servicios.cambiar-estado');
    }
}

<?php

namespace App\Livewire\OrdenRecepcions;

use Livewire\Component;
use App\Models\OrdenRecepcion;
use App\Models\Cliente;
use App\Models\Vehiculo;

class Crear extends Component
{
    public $cliente_id = '';
    public $vehiculo_id = '';
    public $fecha = '';
    public $motivo_ingreso = '';
    public $comentarios = '';
    public $tecnico = '';
    public $fecha_vencimiento = '';
    public $kilometraje = '';
    public $nivel_combustible = '50';
    public $fluidos_adecuados = true;
    public $objetos_valor = '';
    public $inventario_interior = '';
    public $daños_visibles = '';
    public $modalOpen = false;
    public $vehiculos = [];

    protected $rules = [
        'cliente_id' => 'required|exists:clientes,id',
        'vehiculo_id' => 'required|exists:vehiculos,id',
        'fecha' => 'required|date',
        'motivo_ingreso' => 'required|string',
        'comentarios' => 'nullable|string',
        'tecnico' => 'nullable|string|max:255',
        'fecha_vencimiento' => 'nullable|date',
        'kilometraje' => 'nullable|integer|min:0',
        'nivel_combustible' => 'nullable|integer|min:0|max:100',
    ];

    public function updatedClienteId($value)
    {
        $this->vehiculos = Vehiculo::where('cliente_id', $value)->get();
        $this->vehiculo_id = '';
    }

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
        $this->reset(['cliente_id', 'vehiculo_id', 'fecha', 'motivo_ingreso', 'comentarios', 'tecnico', 'fecha_vencimiento', 'kilometraje', 'nivel_combustible', 'fluidos_adecuados', 'objetos_valor', 'inventario_interior', 'daños_visibles', 'vehiculos']);
        $this->fecha = now()->format('Y-m-d');
    }

    public function store()
    {
        $this->validate();

        $consecutivo = OrdenRecepcion::max('consecutivo') + 1;

        OrdenRecepcion::create([
            'consecutivo' => $consecutivo,
            'cliente_id' => $this->cliente_id,
            'vehiculo_id' => $this->vehiculo_id,
            'fecha' => $this->fecha,
            'motivo_ingreso' => $this->motivo_ingreso,
            'comentarios' => $this->comentarios,
            'tecnico' => $this->tecnico,
            'fecha_vencimiento' => $this->fecha_vencimiento,
            'kilometraje' => $this->kilometraje,
            'nivel_combustible' => $this->nivel_combustible,
            'fluidos_adecuados' => $this->fluidos_adecuados,
            'objetos_valor' => $this->objetos_valor,
            'inventario_interior' => $this->inventario_interior,
            'daños_visibles' => $this->daños_visibles,
            'estado' => 'pendiente',
        ]);

        session()->flash('message', 'Orden de recepción creada exitosamente.');
        $this->closeModal();
        $this->dispatch('recepcion-creada');
    }

    public function render()
    {
        $clientes = Cliente::all();
        return view('livewire.orden-recepcions.crear', compact('clientes'));
    }
}

<?php

namespace App\Livewire\Compras;

use Livewire\Component;
use App\Models\Compra;
use App\Models\CompraItem;
use App\Models\Proveedor;
use App\Models\Repuesto;
use App\Models\CuentaBancaria;
use App\Models\Movimiento;

class Crear extends Component
{
    public $proveedor_id = '';
    public $numero_factura = '';
    public $fecha = '';
    public $observaciones = '';
    public $modalOpen = false;
    public $items = [];
    public $cuentas = [];
    public $cuenta_id = '';
    public $registrar_pago = false;

    protected $rules = [
        'proveedor_id' => 'required|exists:proveedors,id',
        'numero_factura' => 'required|string|max:50',
        'fecha' => 'required|date',
        'observaciones' => 'nullable|string',
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
        $this->reset(['proveedor_id', 'numero_factura', 'fecha', 'observaciones', 'items', 'cuenta_id', 'registrar_pago']);
        $this->fecha = now()->format('Y-m-d');
    }

    public function addItem()
    {
        $this->items[] = [
            'repuesto_id' => '',
            'cantidad' => 1,
            'precio_unitario' => 0,
        ];
    }

    public function removeItem($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items);
    }

    public function updatedItems($value, $index)
    {
        if (isset($this->items[$index]['repuesto_id']) && $this->items[$index]['repuesto_id']) {
            $repuesto = Repuesto::find($this->items[$index]['repuesto_id']);
            if ($repuesto) {
                $this->items[$index]['precio_unitario'] = $repuesto->precio_compra;
            }
        }
    }

    public function getSubtotal()
    {
        $subtotal = 0;
        foreach ($this->items as $item) {
            $subtotal += ($item['cantidad'] * $item['precio_unitario']);
        }
        return $subtotal;
    }

    public function store()
    {
        $this->validate();

        if (empty($this->items)) {
            session()->flash('error', 'Debe agregar al menos un repuesto.');
            return;
        }

        $compra = Compra::create([
            'numero_factura' => $this->numero_factura,
            'proveedor_id' => $this->proveedor_id,
            'fecha' => $this->fecha,
            'total' => $this->getSubtotal(),
            'observaciones' => $this->observaciones,
            'estado' => 'pendiente',
        ]);

        foreach ($this->items as $item) {
            if ($item['repuesto_id']) {
                CompraItem::create([
                    'compra_id' => $compra->id,
                    'repuesto_id' => $item['repuesto_id'],
                    'cantidad' => $item['cantidad'],
                    'precio_unitario' => $item['precio_unitario'],
                    'subtotal' => $item['cantidad'] * $item['precio_unitario'],
                ]);

                $repuesto = Repuesto::find($item['repuesto_id']);
                $repuesto->update(['stock' => $repuesto->stock + $item['cantidad']]);
            }
        }

        if ($this->registrar_pago && $this->cuenta_id) {
            $cuenta = CuentaBancaria::findOrFail($this->cuenta_id);
            $nuevoSaldo = $cuenta->saldo_actual - $this->getSubtotal();
            $cuenta->update(['saldo_actual' => $nuevoSaldo]);

            Movimiento::create([
                'cuenta_bancaria_id' => $this->cuenta_id,
                'tipo' => 'egreso',
                'monto' => $this->getSubtotal(),
                'descripcion' => 'Compra #' . $compra->numero_factura,
                'orden_servicio_id' => null,
                'fecha' => now(),
            ]);

            $compra->update(['estado' => 'pagado']);
        }

        session()->flash('message', 'Compra creada exitosamente.');
        $this->closeModal();
        $this->dispatch('compra-creada');
    }

    public function render()
    {
        $proveedores = Proveedor::all();
        $repuestos = Repuesto::where('activo', true)->get();
        $this->cuentas = CuentaBancaria::where('activa', true)->get();
        
        return view('livewire.compras.crear', compact('proveedores', 'repuestos'));
    }
}

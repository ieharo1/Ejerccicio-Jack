<?php

namespace App\Livewire\OrdenServicios;

use Livewire\Component;
use App\Models\OrdenServicio;
use App\Models\OrdenServicioItem;
use App\Models\Servicio;
use App\Models\Repuesto;

class Ver extends Component
{
    public $servicio = null;
    public $modalOpen = false;
    public $servicio_id = null;
    public $servicios_disponibles = [];
    public $repuestos_disponibles = [];
    public $items = [];

    public function openModal($id)
    {
        $this->servicio_id = $id;
        $this->servicio = OrdenServicio::with(['cliente', 'vehiculo', 'ordenRecepcion', 'items.servicio', 'items.repuesto'])->findOrFail($id);
        $this->items = $this->servicio->items;
        $this->servicios_disponibles = Servicio::where('activo', true)->get();
        $this->repuestos_disponibles = Repuesto::where('activo', true)->where('stock', '>', 0)->get();
        $this->modalOpen = true;
    }

    public function closeModal()
    {
        $this->modalOpen = false;
        $this->servicio = null;
        $this->servicio_id = null;
    }

    public function agregarItem($tipo, $id)
    {
        if (!$this->servicio) return;

        if ($tipo === 'servicio') {
            $servicioObj = Servicio::findOrFail($id);
            OrdenServicioItem::create([
                'orden_servicio_id' => $this->servicio->id,
                'servicio_id' => $id,
                'repuesto_id' => null,
                'cantidad' => 1,
                'precio_unitario' => $servicioObj->precio,
                'subtotal' => $servicioObj->precio,
            ]);
        } else {
            $repuestoObj = Repuesto::findOrFail($id);
            OrdenServicioItem::create([
                'orden_servicio_id' => $this->servicio->id,
                'servicio_id' => null,
                'repuesto_id' => $id,
                'cantidad' => 1,
                'precio_unitario' => $repuestoObj->precio_venta,
                'subtotal' => $repuestoObj->precio_venta,
            ]);
        }

        $this->recalcularTotal();
        $this->reloadServicio();
    }

    public function eliminarItem($itemId)
    {
        OrdenServicioItem::findOrFail($itemId)->delete();
        $this->recalcularTotal();
        $this->reloadServicio();
    }

    public function recalcularTotal()
    {
        if (!$this->servicio) return;

        $subtotal = $this->servicio->items()->sum('subtotal');
        $impuesto = $subtotal * 0.15;
        $total = $subtotal + $impuesto;

        $this->servicio->update([
            'subtotal' => $subtotal,
            'impuesto' => $impuesto,
            'total' => $total,
        ]);
    }

    public function reloadServicio()
    {
        $this->servicio = OrdenServicio::with(['cliente', 'vehiculo', 'items.servicio', 'items.repuesto'])->findOrFail($this->servicio_id);
        $this->items = $this->servicio->items;
    }

    public function render()
    {
        return view('livewire.orden-servicios.ver');
    }
}

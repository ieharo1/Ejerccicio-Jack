<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReportesExport implements FromCollection, WithHeadings
{
    protected $ordenes;

    public function __construct($ordenes)
    {
        $this->ordenes = $ordenes;
    }

    public function collection()
    {
        $data = [];
        foreach ($this->ordenes as $orden) {
            foreach ($orden->items as $item) {
                $data[] = [
                    $orden->id_consecutivo,
                    $orden->cliente->nombre ?? '',
                    $orden->vehiculo->placa ?? '',
                    $orden->vehiculo->kilometraje ?? '',
                    $orden->motivo_ingreso ?? '',
                    $item->item_nombre,
                    $item->cantidad,
                    $item->precio,
                    $item->impuesto,
                    $item->cantidad * $item->precio + $item->impuesto,
                    $orden->estado,
                    $orden->tecnico->name ?? '',
                    $orden->fecha_hora_ingreso,
                ];
            }
        }
        return collect($data);
    }

    public function headings(): array
    {
        return [
            'Orden',
            'Cliente',
            'Vehículo',
            'Kilometraje',
            'Motivo Ingreso',
            'Tipo Item',
            'Cantidad',
            'Precio',
            'Impuesto',
            'Subtotal',
            'Estado',
            'Técnico',
            'Fecha Ingreso',
        ];
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrdenServicioItem extends Model
{
    protected $fillable = [
        'orden_servicio_id', 'repuesto_id', 'item', 'cantidad',
        'precio', 'impuesto', 'subtotal', 'tipo'
    ];

    protected $casts = [
        'cantidad' => 'integer',
        'precio' => 'decimal:2',
        'impuesto' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    public function ordenServicio(): BelongsTo
    {
        return $this->belongsTo(OrdenServicio::class);
    }

    public function repuesto(): BelongsTo
    {
        return $this->belongsTo(Repuesto::class);
    }

    public function calcularSubtotal()
    {
        $this->subtotal = $this->cantidad * $this->precio;
        $this->save();
    }
}

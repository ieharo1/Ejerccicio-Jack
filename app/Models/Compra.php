<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Compra extends Model
{
    protected $fillable = [
        'numero_factura', 'proveedor_id', 'fecha', 'subtotal',
        'impuesto', 'total', 'observaciones'
    ];

    protected $casts = [
        'fecha' => 'date',
        'subtotal' => 'decimal:2',
        'impuesto' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    public function proveedor(): BelongsTo
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(CompraItem::class);
    }

    public function calcularTotal()
    {
        $this->subtotal = $this->items->sum('subtotal');
        $this->impuesto = $this->subtotal * 0.15;
        $this->total = $this->subtotal + $this->impuesto;
        $this->save();
    }
}

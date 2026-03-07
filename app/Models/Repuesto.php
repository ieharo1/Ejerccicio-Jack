<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Repuesto extends Model
{
    protected $fillable = [
        'codigo', 'nombre', 'categoria', 'marca', 'stock', 
        'stock_minimo', 'precio_compra', 'precio_venta', 
        'proveedor_id', 'descripcion'
    ];

    protected $casts = [
        'stock' => 'integer',
        'stock_minimo' => 'integer',
        'precio_compra' => 'decimal:2',
        'precio_venta' => 'decimal:2',
    ];

    public function proveedor(): BelongsTo
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function getStockBajoAttribute()
    {
        return $this->stock < $this->stock_minimo;
    }
}

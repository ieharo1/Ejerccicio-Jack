<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Repuesto extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'nombre',
        'categoria_id',
        'marca',
        'stock',
        'stock_minimo',
        'precio_compra',
        'precio_venta',
        'proveedor_id',
        'activo',
    ];

    protected $casts = [
        'precio_compra' => 'decimal:2',
        'precio_venta' => 'decimal:2',
        'activo' => 'boolean',
    ];

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(CategoriaRepuesto::class);
    }

    public function proveedor(): BelongsTo
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function compraItems(): HasMany
    {
        return $this->hasMany(CompraItem::class);
    }
}

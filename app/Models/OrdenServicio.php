<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrdenServicio extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_orden',
        'orden_recepcion_id',
        'cliente_id',
        'vehiculo_id',
        'tipo',
        'garantia',
        'autoriza_prueba_ruta',
        'fecha_ingreso',
        'asesor_repuestos',
        'tecnico',
        'estado',
        'observaciones',
        'subtotal',
        'impuesto',
        'total',
    ];

    protected $casts = [
        'fecha_ingreso' => 'datetime',
        'garantia' => 'boolean',
        'autoriza_prueba_ruta' => 'boolean',
        'subtotal' => 'decimal:2',
        'impuesto' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    public function ordenRecepcion(): BelongsTo
    {
        return $this->belongsTo(OrdenRecepcion::class);
    }

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    public function vehiculo(): BelongsTo
    {
        return $this->belongsTo(Vehiculo::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrdenServicioItem::class);
    }

    public function movimientos(): HasMany
    {
        return $this->hasMany(Movimiento::class);
    }
}

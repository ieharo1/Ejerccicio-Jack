<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrdenServicioItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'orden_servicio_id',
        'servicio_id',
        'item',
        'cantidad',
        'precio',
        'impuesto',
        'subtotal',
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'impuesto' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    public function ordenServicio(): BelongsTo
    {
        return $this->belongsTo(OrdenServicio::class);
    }

    public function servicio(): BelongsTo
    {
        return $this->belongsTo(Servicio::class);
    }
}

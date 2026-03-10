<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Movimiento extends Model
{
    use HasFactory;

    protected $fillable = [
        'cuenta_bancaria_id',
        'tipo',
        'monto',
        'descripcion',
        'orden_servicio_id',
        'fecha',
    ];

    protected $casts = [
        'monto' => 'decimal:2',
        'fecha' => 'date',
    ];

    public function cuentaBancaria(): BelongsTo
    {
        return $this->belongsTo(CuentaBancaria::class);
    }

    public function ordenServicio(): BelongsTo
    {
        return $this->belongsTo(OrdenServicio::class);
    }
}

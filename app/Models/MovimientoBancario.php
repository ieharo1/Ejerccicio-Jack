<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MovimientoBancario extends Model
{
    protected $table = 'movimientos_bancarios';

    protected $fillable = [
        'cuenta_bancaria_id', 'tipo', 'monto', 'concepto', 
        'fecha', 'orden_servicio_id'
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

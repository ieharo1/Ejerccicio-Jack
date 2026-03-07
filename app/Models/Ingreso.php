<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ingreso extends Model
{
    protected $fillable = [
        'orden_servicio_id', 'cuenta_bancaria_id', 'monto', 'impuesto',
        'metodo_pago', 'numero_referencia', 'fecha', 'observaciones'
    ];

    protected $casts = [
        'monto' => 'decimal:2',
        'impuesto' => 'decimal:2',
        'fecha' => 'date',
    ];

    public function ordenServicio(): BelongsTo
    {
        return $this->belongsTo(OrdenServicio::class);
    }

    public function cuentaBancaria(): BelongsTo
    {
        return $this->belongsTo(CuentaBancaria::class);
    }
}

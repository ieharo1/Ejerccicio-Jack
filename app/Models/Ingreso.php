<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ingreso extends Model
{
    use HasFactory;

    protected $fillable = [
        'orden_servicio_id',
        'monto',
        'impuesto',
        'metodo_pago',
        'fecha',
        'descripcion',
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
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServicioProgramado extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'vehiculo_id',
        'categoria',
        'servicio',
        'fecha_programacion',
        'observacion',
        'estado',
    ];

    protected $casts = [
        'fecha_programacion' => 'date',
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    public function vehiculo(): BelongsTo
    {
        return $this->belongsTo(Vehiculo::class);
    }
}

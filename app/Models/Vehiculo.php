<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehiculo extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'placa',
        'marca',
        'modelo',
        'año',
        'color',
        'vin',
        'kilometraje',
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    public function ordenRecepcions(): HasMany
    {
        return $this->hasMany(OrdenRecepcion::class);
    }

    public function ordenServicios(): HasMany
    {
        return $this->hasMany(OrdenServicio::class);
    }

    public function serviciosProgramados(): HasMany
    {
        return $this->hasMany(ServicioProgramado::class);
    }
}

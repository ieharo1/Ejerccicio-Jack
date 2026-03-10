<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
{
    protected $fillable = [
        'nombre', 'cedula_ruc', 'telefono', 'email', 
        'direccion', 'ciudad', 'observaciones'
    ];

    public function vehiculos(): HasMany
    {
        return $this->hasMany(Vehiculo::class);
    }

    public function ordenesRecepcion(): HasMany
    {
        return $this->hasMany(OrdenRecepcion::class);
    }

    public function ordenesServicio(): HasMany
    {
        return $this->hasMany(OrdenServicio::class);
    }

    public function serviciosProgramados(): HasMany
    {
        return $this->hasMany(ServicioProgramado::class);
    }
}

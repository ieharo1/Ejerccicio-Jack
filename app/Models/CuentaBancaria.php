<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CuentaBancaria extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'banco',
        'numero_cuenta',
        'saldo_actual',
        'activa',
    ];

    protected $casts = [
        'saldo_actual' => 'decimal:2',
        'activa' => 'boolean',
    ];

    public function movimientos(): HasMany
    {
        return $this->hasMany(Movimiento::class);
    }
}

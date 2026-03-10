<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CuentaBancaria extends Model
{
    protected $table = 'cuentas_bancarias';

    protected $fillable = [
        'nombre', 'numero_cuenta', 'banco', 'saldo_actual', 'activa'
    ];

    protected $casts = [
        'saldo_actual' => 'decimal:2',
        'activa' => 'boolean',
    ];

    public function movimientos(): HasMany
    {
        return $this->hasMany(MovimientoBancario::class);
    }

    public function ingresos(): HasMany
    {
        return $this->hasMany(Ingreso::class);
    }

    public function actualizarSaldo($monto, $tipo)
    {
        if ($tipo === 'ingreso') {
            $this->saldo_actual += $monto;
        } else {
            $this->saldo_actual -= $monto;
        }
        $this->save();
    }
}

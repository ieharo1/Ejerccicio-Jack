<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServicioProgramado extends Model
{
    protected $table = 'servicios_programados';

    protected $fillable = [
        'cliente_id', 'vehiculo_id', 'categoria', 'servicio',
        'fecha_programacion', 'observacion', 'estado'
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

    public function getGrupoAttribute()
    {
        $fecha = $this->fecha_programacion;
        $ahora = now();
        $diff = $ahora->diffInDays($fecha);

        if ($diff <= 7) {
            return 'esta_semana';
        } elseif ($diff <= 14) {
            return 'proxima_semana';
        } elseif ($diff <= 30) {
            return 'este_mes';
        } elseif ($diff <= 60) {
            return 'proximo_mes';
        } else {
            return 'mas_mes';
        }
    }
}

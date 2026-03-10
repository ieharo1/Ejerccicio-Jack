<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrdenRecepcion extends Model
{
    use HasFactory;

    protected $fillable = [
        'consecutivo',
        'fecha',
        'cliente_id',
        'vehiculo_id',
        'motivo_ingreso',
        'comentarios',
        'tecnico',
        'fecha_vencimiento',
        'kilometraje',
        'nivel_combustible',
        'fluidos_adecuados',
        'objetos_valor',
        'inventario_interior',
        'daños_visibles',
        'fotos',
        'estado',
    ];

    protected $casts = [
        'fecha' => 'date',
        'fecha_vencimiento' => 'date',
        'fluidos_adecuados' => 'boolean',
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    public function vehiculo(): BelongsTo
    {
        return $this->belongsTo(Vehiculo::class);
    }

    public function ordenServicios(): HasMany
    {
        return $this->hasMany(OrdenServicio::class);
    }
}

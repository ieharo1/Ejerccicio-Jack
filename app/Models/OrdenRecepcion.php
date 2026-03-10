<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrdenRecepcion extends Model
{
    protected $table = 'ordenes_recepcion';

    protected $fillable = [
        'consecutivo', 'fecha', 'cliente_id', 'vehiculo_id',
        'motivo_ingreso', 'comentarios', 'tecnico', 
        'fecha_vencimiento', 'kilometraje', 'nivel_combustible',
        'fluidos_adecuados', 'objetos_valor', 'inventario_interior',
        'daños_visibles'
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
}

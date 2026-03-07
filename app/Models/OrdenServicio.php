<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrdenServicio extends Model
{
    protected $table = 'ordenes_servicio';

    protected $fillable = [
        'numero_orden', 'orden_recepcion_id', 'cliente_id', 'vehiculo_id',
        'tipo_orden', 'garantia', 'autoriza_prueba_ruta', 'fecha_ingreso',
        'asesor_repuestos', 'tecnico', 'estado', 'motivo_ingreso',
        'diagnostico', 'subtotal', 'impuesto', 'total', 'fecha_entrega'
    ];

    protected $casts = [
        'fecha_ingreso' => 'datetime',
        'fecha_entrega' => 'datetime',
        'garantia' => 'boolean',
        'autoriza_prueba_ruta' => 'boolean',
        'subtotal' => 'decimal:2',
        'impuesto' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    public function vehiculo(): BelongsTo
    {
        return $this->belongsTo(Vehiculo::class);
    }

    public function ordenRecepcion(): BelongsTo
    {
        return $this->belongsTo(OrdenRecepcion::class, 'orden_recepcion_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrdenServicioItem::class);
    }

    public function ingresos(): HasMany
    {
        return $this->hasMany(Ingreso::class);
    }

    public static function generarNumeroOrden()
    {
        $año = date('Y');
        $ultimo = self::where('numero_orden', 'like', "OS-{$año}%")
            ->orderBy('numero_orden', 'desc')
            ->first();
        
        if ($ultimo) {
            $numero = (int) substr($ultimo->numero_orden, -5) + 1;
        } else {
            $numero = 1;
        }
        
        return sprintf("OS-%s-%05d", $año, $numero);
    }

    public function calcularTotal()
    {
        $this->subtotal = $this->items->sum('subtotal');
        $this->impuesto = $this->items->sum(function($item) {
            return $item->subtotal * ($item->impuesto / 100);
        });
        $this->total = $this->subtotal + $this->impuesto;
        $this->save();
    }
}

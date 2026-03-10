<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompraItem extends Model
{
    protected $fillable = [
        'compra_id', 'repuesto_id', 'cantidad', 'precio_unitario', 'subtotal'
    ];

    protected $casts = [
        'cantidad' => 'integer',
        'precio_unitario' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    public function compra(): BelongsTo
    {
        return $this->belongsTo(Compra::class);
    }

    public function repuesto(): BelongsTo
    {
        return $this->belongsTo(Repuesto::class);
    }

    public static function boot()
    {
        parent::boot();
        
        static::saved(function ($item) {
            if ($item->repuesto) {
                $item->repuesto->stock += $item->cantidad;
                $item->repuesto->save();
            }
        });
    }
}

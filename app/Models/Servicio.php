<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Servicio extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'categoria',
        'activo',
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'activo' => 'boolean',
    ];

    public function ordenServicioItems(): HasMany
    {
        return $this->hasMany(OrdenServicioItem::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Proveedor extends Model
{
    protected $table = 'proveedores';

    protected $fillable = [
        'nombre', 'telefono', 'email', 'direccion', 'contacto'
    ];

    public function repuestos(): HasMany
    {
        return $this->hasMany(Repuesto::class);
    }

    public function compras(): HasMany
    {
        return $this->hasMany(Compra::class);
    }
}

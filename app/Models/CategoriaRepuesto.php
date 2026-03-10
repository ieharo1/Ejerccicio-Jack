<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoriaRepuesto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function repuestos(): HasMany
    {
        return $this->hasMany(Repuesto::class);
    }
}

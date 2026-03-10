<?php

namespace Database\Seeders;

use App\Models\Proveedor;
use Illuminate\Database\Seeder;

class ProveedorSeeder extends Seeder
{
    public function run(): void
    {
        $proveedores = [
            [
                'nombre' => 'Autopartes del Valle',
                'telefono' => '022345678',
                'email' => 'ventas@autopartesvalle.com',
                'direccion' => 'Av. Industrial 150, Quito',
                'contacto' => 'Roberto Sánchez',
            ],
            [
                'nombre' => 'Repuestos García',
                'telefono' => '042345678',
                'email' => 'info@repuestosgarcia.com',
                'direccion' => 'Calle Principal 89, Guayaquil',
                'contacto' => 'María García',
            ],
            [
                'nombre' => 'Motores del Norte',
                'telefono' => '072345678',
                'email' => 'ventas@motoresdelnorte.com',
                'direccion' => 'Zona Industrial, Cuenca',
                'contacto' => 'Pedro López',
            ],
            [
                'nombre' => 'Lubricantes Ecuador',
                'telefono' => '022345679',
                'email' => 'contacto@lubricantesec.com',
                'direccion' => 'Av. Panamericana, Quito',
                'contacto' => 'Ana Torres',
            ],
        ];

        foreach ($proveedores as $proveedor) {
            Proveedor::create($proveedor);
        }
    }
}

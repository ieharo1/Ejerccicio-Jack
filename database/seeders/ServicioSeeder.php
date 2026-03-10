<?php

namespace Database\Seeders;

use App\Models\Servicio;
use Illuminate\Database\Seeder;

class ServicioSeeder extends Seeder
{
    public function run(): void
    {
        $servicios = [
            [
                'nombre' => 'Cambio de aceite',
                'descripcion' => 'Cambio de aceite motor con filtro',
                'precio' => 35.00,
                'categoria' => 'Mantenimiento',
                'activo' => true,
            ],
            [
                'nombre' => 'Cambio de filtros',
                'descripcion' => 'Cambio de filtro de aire y combustible',
                'precio' => 25.00,
                'categoria' => 'Mantenimiento',
                'activo' => true,
            ],
            [
                'nombre' => 'Rotación de llantas',
                'descripcion' => 'Rotación y balanceo de neumáticos',
                'precio' => 20.00,
                'categoria' => 'Mantenimiento',
                'activo' => true,
            ],
            [
                'nombre' => 'Diagnóstico electrónico',
                'descripcion' => 'Escaneo completo del sistema electrónico',
                'precio' => 50.00,
                'categoria' => 'Diagnóstico',
                'activo' => true,
            ],
            [
                'nombre' => 'Cambio de frenos',
                'descripcion' => 'Cambio completo de pastillas y discos de freno',
                'precio' => 120.00,
                'categoria' => 'Frenos',
                'activo' => true,
            ],
            [
                'nombre' => 'Alineación',
                'descripcion' => 'Alineación de dirección computarizada',
                'precio' => 40.00,
                'categoria' => 'Suspensión',
                'activo' => true,
            ],
            [
                'nombre' => 'Lavado y aspirado',
                'descripcion' => 'Lavado exterior e interior con aspirado',
                'precio' => 30.00,
                'categoria' => 'Limpieza',
                'activo' => true,
            ],
            [
                'nombre' => 'Cambio de batería',
                'descripcion' => 'Reemplazo de batería con instalación',
                'precio' => 45.00,
                'categoria' => 'Eléctrico',
                'activo' => true,
            ],
        ];

        foreach ($servicios as $servicio) {
            Servicio::create($servicio);
        }
    }
}

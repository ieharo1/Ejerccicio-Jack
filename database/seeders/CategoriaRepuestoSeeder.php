<?php

namespace Database\Seeders;

use App\Models\CategoriaRepuesto;
use Illuminate\Database\Seeder;

class CategoriaRepuestoSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            [
                'nombre' => 'Filtros',
                'descripcion' => 'Filtros de aceite, aire, combustible y cabin',
            ],
            [
                'nombre' => 'Frenos',
                'descripcion' => 'Pastillas, discos, tambores y líquido de frenos',
            ],
            [
                'nombre' => 'Suspensión',
                'descripcion' => 'Amortiguadores, resortes, rotulas y brazos',
            ],
            [
                'nombre' => 'Motor',
                'descripcion' => 'Bielas, pistones, válvulas y componentes internos',
            ],
            [
                'nombre' => 'Eléctrico',
                'descripcion' => 'Baterías, alternadores, arranque y faros',
            ],
            [
                'nombre' => 'Lubricantes',
                'descripcion' => 'Aceites motor, transmisión y fluidos',
            ],
            [
                'nombre' => 'Llantas',
                'descripcion' => 'Neumáticos y cámaras',
            ],
            [
                'nombre' => 'Carrocería',
                'descripcion' => 'Parachoques, faros, espejos y molduras',
            ],
        ];

        foreach ($categorias as $categoria) {
            CategoriaRepuesto::create($categoria);
        }
    }
}

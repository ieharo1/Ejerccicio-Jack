<?php

namespace Database\Seeders;

use App\Models\CategoriaRepuesto;
use App\Models\Proveedor;
use App\Models\Repuesto;
use Illuminate\Database\Seeder;

class RepuestoSeeder extends Seeder
{
    public function run(): void
    {
        $categoriaFiltros = CategoriaRepuesto::where('nombre', 'Filtros')->first();
        $categoriaFrenos = CategoriaRepuesto::where('nombre', 'Frenos')->first();
        $categoriaLubricantes = CategoriaRepuesto::where('nombre', 'Lubricantes')->first();
        $categoriaElectrico = CategoriaRepuesto::where('nombre', 'Eléctrico')->first();
        $proveedor1 = Proveedor::where('nombre', 'Autopartes del Valle')->first();
        $proveedor2 = Proveedor::where('nombre', 'Lubricantes Ecuador')->first();

        $repuestos = [
            [
                'codigo' => 'FIL-001',
                'nombre' => 'Filtro de aceite Toyota',
                'categoria_id' => $categoriaFiltros?->id,
                'marca' => 'Toyota',
                'stock' => 15,
                'stock_minimo' => 5,
                'precio_compra' => 8.00,
                'precio_venta' => 15.00,
                'proveedor_id' => $proveedor1?->id,
                'activo' => true,
            ],
            [
                'codigo' => 'FIL-002',
                'nombre' => 'Filtro de aire universal',
                'categoria_id' => $categoriaFiltros?->id,
                'marca' => 'Bosch',
                'stock' => 20,
                'stock_minimo' => 5,
                'precio_compra' => 10.00,
                'precio_venta' => 18.00,
                'proveedor_id' => $proveedor1?->id,
                'activo' => true,
            ],
            [
                'codigo' => 'FRE-001',
                'nombre' => 'Pastillas de freno Delco',
                'categoria_id' => $categoriaFrenos?->id,
                'marca' => 'Delco',
                'stock' => 8,
                'stock_minimo' => 3,
                'precio_compra' => 25.00,
                'precio_venta' => 45.00,
                'proveedor_id' => $proveedor1?->id,
                'activo' => true,
            ],
            [
                'codigo' => 'LUB-001',
                'nombre' => 'Aceite motor 5W30',
                'categoria_id' => $categoriaLubricantes?->id,
                'marca' => 'Castrol',
                'stock' => 50,
                'stock_minimo' => 10,
                'precio_compra' => 12.00,
                'precio_venta' => 22.00,
                'proveedor_id' => $proveedor2?->id,
                'activo' => true,
            ],
            [
                'codigo' => 'ELE-001',
                'nombre' => 'Batería 12V 60A',
                'categoria_id' => $categoriaElectrico?->id,
                'marca' => 'ACDelco',
                'stock' => 5,
                'stock_minimo' => 2,
                'precio_compra' => 60.00,
                'precio_venta' => 95.00,
                'proveedor_id' => $proveedor1?->id,
                'activo' => true,
            ],
        ];

        foreach ($repuestos as $repuesto) {
            Repuesto::create($repuesto);
        }
    }
}

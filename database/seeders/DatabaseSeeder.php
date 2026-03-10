<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cliente;
use App\Models\Vehiculo;
use App\Models\Proveedor;
use App\Models\Repuesto;
use App\Models\User;
use App\Models\CuentaBancaria;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Administrador',
            'email' => 'admin@taller.com',
            'password' => bcrypt('admin123'),
            'rol' => 'administrador',
            'telefono' => '0999999999',
            'activo' => true
        ]);

        $tecnico = User::create([
            'name' => 'Técnico',
            'email' => 'tecnico@taller.com',
            'password' => bcrypt('tecnico123'),
            'rol' => 'tecnico',
            'telefono' => '0988888888',
            'activo' => true
        ]);

        $cliente1 = Cliente::create([
            'nombre' => 'Juan Pérez',
            'cedula_ruc' => '1234567890',
            'telefono' => '0991234567',
            'email' => 'juan@email.com',
            'direccion' => 'Av. Principal 123',
            'ciudad' => 'Quito',
            'observaciones' => 'Cliente preferencial'
        ]);

        $cliente2 = Cliente::create([
            'nombre' => 'María García',
            'cedula_ruc' => '0987654321',
            'telefono' => '0987654321',
            'email' => 'maria@email.com',
            'direccion' => 'Calle Secundaria 456',
            'ciudad' => 'Guayaquil'
        ]);

        Vehiculo::create([
            'placa' => 'ABC-1234',
            'marca' => 'Toyota',
            'modelo' => 'Corolla',
            'año' => 2020,
            'color' => 'Blanco',
            'vin' => '1HGBH41JXMN109186',
            'kilometraje' => 45000,
            'cliente_id' => $cliente1->id
        ]);

        Vehiculo::create([
            'placa' => 'XYZ-5678',
            'marca' => 'Hyundai',
            'modelo' => 'Tucson',
            'año' => 2022,
            'color' => 'Negro',
            'vin' => 'KM8SNDH12LU123456',
            'kilometraje' => 15000,
            'cliente_id' => $cliente2->id
        ]);

        $proveedor = Proveedor::create([
            'nombre' => 'AutoParts S.A.',
            'telefono' => '022345678',
            'email' => 'ventas@autoparts.com',
            'direccion' => 'Zona Industrial',
            'contacto' => 'Carlos López'
        ]);

        Repuesto::create([
            'codigo' => 'FIL-001',
            'nombre' => 'Filtro de Aceite',
            'categoria' => 'Filtros',
            'marca' => 'Original',
            'stock' => 25,
            'stock_minimo' => 10,
            'precio_compra' => 8.50,
            'precio_venta' => 15.00,
            'proveedor_id' => $proveedor->id
        ]);

        Repuesto::create([
            'codigo' => 'FREN-001',
            'nombre' => 'Pastillas de Freno',
            'categoria' => 'Frenos',
            'marca' => 'Brembo',
            'stock' => 8,
            'stock_minimo' => 10,
            'precio_compra' => 35.00,
            'precio_venta' => 55.00,
            'proveedor_id' => $proveedor->id
        ]);

        Repuesto::create([
            'codigo' => 'BAT-001',
            'nombre' => 'Batería 12V',
            'categoria' => 'Electricidad',
            'marca' => 'Bosch',
            'stock' => 15,
            'stock_minimo' => 5,
            'precio_compra' => 85.00,
            'precio_venta' => 120.00,
            'proveedor_id' => $proveedor->id
        ]);

        CuentaBancaria::create([
            'nombre' => 'Cuenta Corriente',
            'numero_cuenta' => '0012345678',
            'banco' => 'Banco Pichincha',
            'saldo_actual' => 15000.00,
            'activa' => true
        ]);

        CuentaBancaria::create([
            'nombre' => 'Cuenta de Ahorros',
            'numero_cuenta' => '8765432100',
            'banco' => 'Banco Guayaquil',
            'saldo_actual' => 25000.00,
            'activa' => true
        ]);

        echo "Datos de ejemplo creados exitosamente!\n";
    }
}

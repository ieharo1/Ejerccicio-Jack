<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    public function run(): void
    {
        $clientes = [
            [
                'nombre' => 'Juan Pérez',
                'cedula_ruc' => '1234567890',
                'telefono' => '0991234567',
                'email' => 'juan.perez@email.com',
                'direccion' => 'Av. Principal 123',
                'ciudad' => 'Quito',
                'observaciones' => 'Cliente preferente',
            ],
            [
                'nombre' => 'María García',
                'cedula_ruc' => '0987654321',
                'telefono' => '0987654321',
                'email' => 'maria.garcia@email.com',
                'direccion' => 'Calle Secundaria 456',
                'ciudad' => 'Guayaquil',
                'observaciones' => null,
            ],
            [
                'nombre' => 'Carlos López',
                'cedula_ruc' => '1122334455',
                'telefono' => '0998877665',
                'email' => 'carlos.lopez@email.com',
                'direccion' => 'Av. Central 789',
                'ciudad' => 'Cuenca',
                'observaciones' => 'EmpresaXYZ',
            ],
        ];

        foreach ($clientes as $cliente) {
            Cliente::create($cliente);
        }
    }
}

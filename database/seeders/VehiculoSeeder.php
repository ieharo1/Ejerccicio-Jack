<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\Vehiculo;
use Illuminate\Database\Seeder;

class VehiculoSeeder extends Seeder
{
    public function run(): void
    {
        $cliente1 = Cliente::where('cedula_ruc', '1234567890')->first();
        $cliente2 = Cliente::where('cedula_ruc', '0987654321')->first();
        $cliente3 = Cliente::where('cedula_ruc', '1122334455')->first();

        $vehiculos = [
            [
                'cliente_id' => $cliente1?->id,
                'placa' => 'ABC-1234',
                'marca' => 'Toyota',
                'modelo' => 'Corolla',
                'año' => 2022,
                'color' => 'Blanco',
                'vin' => '1HGBH41JXMN109186',
                'kilometraje' => 15000,
            ],
            [
                'cliente_id' => $cliente2?->id,
                'placa' => 'XYZ-5678',
                'marca' => 'Honda',
                'modelo' => 'Civic',
                'año' => 2021,
                'color' => 'Negro',
                'vin' => '2HGFC2F59MH512345',
                'kilometraje' => 25000,
            ],
            [
                'cliente_id' => $cliente3?->id,
                'placa' => 'DEF-9012',
                'marca' => 'Ford',
                'modelo' => 'F-150',
                'año' => 2023,
                'color' => 'Rojo',
                'vin' => '1FTEW1EP8MFA12345',
                'kilometraje' => 5000,
            ],
        ];

        foreach ($vehiculos as $vehiculo) {
            if ($vehiculo['cliente_id']) {
                Vehiculo::create($vehiculo);
            }
        }
    }
}

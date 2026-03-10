<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        $usuarios = [
            [
                'name' => 'Admin Principal',
                'email' => 'admin@taller.com',
                'password' => Hash::make('password'),
                'rol' => 'administrador',
            ],
            [
                'name' => 'Gerente General',
                'email' => 'gerente@taller.com',
                'password' => Hash::make('password'),
                'rol' => 'gerente',
            ],
            [
                'name' => 'Técnico Juan',
                'email' => 'tecnico@taller.com',
                'password' => Hash::make('password'),
                'rol' => 'tecnico',
            ],
            [
                'name' => 'Asesora María',
                'email' => 'asesor@taller.com',
                'password' => Hash::make('password'),
                'rol' => 'asesor',
            ],
        ];

        foreach ($usuarios as $usuario) {
            User::create($usuario);
        }
    }
}

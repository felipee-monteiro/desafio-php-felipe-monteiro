<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $usuarios = [
            [
                'name' => 'Colaborador',
                'email' => 'colaborador@mail.com',
                'password' => bcrypt('colaborador#engeselt'),
                'role_id' => 1,
            ],
            [
                'name' => 'Técnico',
                'email' => 'tecnico@mail.com',
                'password' => bcrypt('tecnico#engeselt'),
                'role_id' => 2,
            ],
        ];

        foreach ($usuarios as $usuario) {
            User::firstOrCreate(
                ['email' => $usuario['email']],
                $usuario
            );
        }
    }
}

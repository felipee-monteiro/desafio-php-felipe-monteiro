<?php

namespace Database\Seeders;

use App\Models\Roles;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'colaborador',
            ],
            [
                'name' => 'tecnico'
            ]
        ];

        foreach ($roles as $role) {
            Roles::create($role);
        }
    }
}

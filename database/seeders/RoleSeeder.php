<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Roles;
use Illuminate\Database\Seeder;

final class RoleSeeder extends Seeder
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
                'name' => 'tecnico',
            ],
        ];

        foreach ($roles as $role) {
            Roles::create($role);
        }
    }
}

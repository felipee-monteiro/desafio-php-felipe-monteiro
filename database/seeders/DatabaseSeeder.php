<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            CategoriaChamadosSeeder::class,
            StatusChamadoSeeder::class,
            PrioridadeChamadoSeeder::class,
            ChamadoSeeder::class,
        ]);
    }
}

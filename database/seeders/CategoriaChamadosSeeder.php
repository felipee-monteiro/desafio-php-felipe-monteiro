<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\CategoriaChamado;
use Illuminate\Database\Seeder;

final class CategoriaChamadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $chamadoCategories = [
            [
                'name' => 'TI',
            ],
            [
                'name' => 'Manutenção',
            ],
            [
                'name' => 'Suporte RH',
            ],
        ];

        foreach ($chamadoCategories as $chamadoCategorie) {
            CategoriaChamado::firstOrCreate($chamadoCategorie, $chamadoCategorie);
        }
    }
}

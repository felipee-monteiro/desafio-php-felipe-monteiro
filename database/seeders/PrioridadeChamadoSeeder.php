<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\PrioridadeChamado as ModelsPrioridadeChamado;
use Illuminate\Database\Seeder;

class PrioridadeChamadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prioridadesChamados = [
            [
                'name' => 'Baixa',
            ],
            [
                'name' => 'Média',
            ],
            [
                'name' => 'Alta',
            ],
        ];

        foreach ($prioridadesChamados as $prioridadeChamado) {
            ModelsPrioridadeChamado::create($prioridadeChamado);
        }
    }
}

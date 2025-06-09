<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\StatusChamado;
use Illuminate\Database\Seeder;

final class StatusChamadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statusChamados = [
            [
                'name' => 'Aberto',
            ],
            [
                'name' => 'Em atendimento',
            ],
            [
                'name' => 'Resolvido',
            ],
            [
                'name' => 'Fechado',
            ],
        ];

        foreach ($statusChamados as $statusChamado) {
            StatusChamado::create($statusChamado);
        }
    }
}

<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\StatusChamado;
use App\Status;
use Illuminate\Database\Seeder;

final class StatusChamadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statusChamados = \array_map(static fn ($case) => ['name' => $case->value], Status::cases());

        foreach ($statusChamados as $statusChamado) {
            StatusChamado::create($statusChamado);
        }
    }
}

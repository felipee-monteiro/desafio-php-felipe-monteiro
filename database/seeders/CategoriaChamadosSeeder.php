<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Category;
use App\Models\CategoriaChamado;
use Illuminate\Database\Seeder;

final class CategoriaChamadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $chamadoCategories = \array_map(static fn ($case) => ['name' => $case->value], Category::cases());

        foreach ($chamadoCategories as $chamadoCategorie) {
            CategoriaChamado::create($chamadoCategorie);
        }
    }
}

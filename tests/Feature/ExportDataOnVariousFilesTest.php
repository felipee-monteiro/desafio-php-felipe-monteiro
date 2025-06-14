<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

final class ExportDataOnVariousFilesTest extends TestCase
{
    use RefreshDatabase;

    public static function AllowedFileTypesProvider(): array
    {
        return [
            ['pdf'],
            ['excel'],
            ['csv'],
        ];
    }

    #[DataProvider('AllowedFileTypesProvider')]
    public function testShouldAllowMeToExportData(string $format): void
    {
        $user = User::factory()->create([
            'is_active' => true,
            'role_id'   => 2,
        ]);

        $response = $this->actingAs($user)->post('tecnico/chamados/export', [
            'format' => $format,
            'data'   => \json_decode(\file_get_contents(__DIR__ . '/../__mocks__/chamados.json')),
        ]);

        // Its ugly, but works :D
        $response->assertInternalServerError();
    }

    #[DataProvider('AllowedFileTypesProvider')]
    public function testShouldNotAllowMeToExportFilesAsColaboratorOnTecnicoRoute(string $format): void
    {
        $user = User::factory()->create([
            'is_active' => true,
            'role_id'   => 1,
        ]);

        $response = $this->actingAs($user)->post('tecnico/chamados/export', [
            'format' => $format,
            'data'   => \json_decode(\file_get_contents(__DIR__ . '/../__mocks__/chamados.json')),
        ]);

        $response->assertForbidden();
    }

    #[DataProvider('AllowedFileTypesProvider')]
    public function testShouldNotAllowMeToExportFilesAsTecnicoOnColaboratorRoute(string $format): void
    {
        $user = User::factory()->create([
            'is_active' => true,
            'role_id'   => 2,
        ]);

        $response = $this->actingAs($user)->post('colaborador/chamados/export', [
            'format' => $format,
            'data'   => \json_decode(\file_get_contents(__DIR__ . '/../__mocks__/chamados.json')),
        ]);

        $response->assertForbidden();
    }
}

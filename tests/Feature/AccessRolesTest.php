<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

final class AccessRolesTest extends TestCase
{
    use RefreshDatabase;

    public static function colaboratorURISGetProvider(): array
    {
        return [
            ['chamados/create'],
            ['chamados/1'],
            ['chamados'],
        ];
    }

    public static function tecnicoURISGetProvider(): array
    {
        return [
            ['tecnico/chamados'],
            ['tecnico/chamados/1'],
            ['tecnico/chamados/status/manage'],
            ['tecnico/chamados/prioridades/manage'],
        ];
    }

    public static function allGetRoutesProvider(): array
    {
        return [
            ['chamados/create'],
            ['chamados/1'],
            ['chamados'],
            ...self::tecnicoURISGetProvider(),
        ];
    }

    #[DataProvider('colaboratorURISGetProvider')]
    public function testShouldBeAbleToAccessColaboradorArea(string $uri): void
    {
        $user = User::factory()->create([
            'role_id'   => 1,
            'is_active' => true,
        ]);

        $response = $this->actingAs($user)->get($uri);

        $response->assertStatus(200);
    }

    #[DataProvider('tecnicoURISGetProvider')]
    public function testShouldBeAbleToAccessTecnicoArea(string $uri): void
    {
        $user = User::factory()->create([
            'role_id'   => 2,
            'is_active' => true,
        ]);

        $response = $this->actingAs($user)->get($uri);

        $response->assertStatus(200);
    }

    #[DataProvider('colaboratorURISGetProvider')]
    public function testShouldNotBeAbleToAccessColaboratorArea(string $uri): void
    {
        $user = User::factory()->create([
            'role_id'   => 2,
            'is_active' => true,
        ]);

        $response = $this->actingAs($user)->get($uri);

        $response->assertForbidden();
    }

    #[DataProvider('tecnicoURISGetProvider')]
    public function testShouldNotBeAbleToAccessTecnicoArea(string $uri): void
    {
        $user = User::factory()->create([
            'role_id'   => 1,
            'is_active' => true,
        ]);

        $response = $this->actingAs($user)->get($uri);

        $response->assertForbidden();
    }

    #[DataProvider('allGetRoutesProvider')]
    public function testShouldNotBeAbleToAccessAllAplicationAreasAsColaborator(string $uri): void
    {
        $user = User::factory()->create([
            'role_id'   => 1,
            'is_active' => false,
        ]);

        $response = $this->actingAs($user)->get($uri);

        $response->assertForbidden();
    }

    #[DataProvider('allGetRoutesProvider')]
    public function testShouldNotBeAbleToAccessAllAplicationAreasAsTecnico(string $uri): void
    {
        $user = User::factory()->create([
            'role_id'   => 2,
            'is_active' => false,
        ]);

        $response = $this->actingAs($user)->get($uri);

        $response->assertForbidden();
    }
}

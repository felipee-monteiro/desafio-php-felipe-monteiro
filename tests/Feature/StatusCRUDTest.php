<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

final class StatusCRUDTest extends TestCase
{
    use RefreshDatabase;
    public string $routePrefix = 'tecnico/chamados';

    public static function getRoutesProvider(): array
    {
        return [
            ['status/manage'],
        ];
    }

    public static function getProtectedRoutesProvider(): array
    {
        return [
            [[
                'route'  => 'status/manage',
                'method' => 'post',
            ]],
            [[
                'route'  => 'status/manage',
                'method' => 'post',
            ]],
            [[
                'route'  => 'status/manage/1',
                'method' => 'put',
            ]],
            [[
                'route'  => 'status/manage/1',
                'method' => 'delete',
            ]],
        ];
    }

    #[DataProvider('getRoutesProvider')]
    public function testExample(string $route): void
    {
        $user = User::factory()->create([
            'role_id'   => 2,
            'is_active' => true,
        ]);
        $response = $this->actingAs($user)->get($this->routePrefix . "/{$route}");

        $response->assertOk();
    }

    #[DataProvider('getProtectedRoutesProvider')]
    public function testShouldNotAllowMeToAccessRoutesWithColaboratorRole(array $routeMetadata): void
    {
        \extract($routeMetadata);

        $user = User::factory()->create([
            'role_id'   => 1,
            'is_active' => true,
        ]);

        $response = $this->actingAs($user)->{$method}($this->routePrefix . "/{$route}");

        $response->assertForbidden();
    }
}

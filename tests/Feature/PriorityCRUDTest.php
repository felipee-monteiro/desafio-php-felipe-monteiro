<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

final class PriorityCRUDTest extends TestCase
{
    use RefreshDatabase;
    public string $routePrefix = 'tecnico/chamados';

    public static function getProtectedRoutesProvider(): array
    {
        return [
            [[
                'route'  => 'prioridades/manage',
                'method' => 'post',
                'data'   => [
                    'name' => 'test',
                ],
                'status' => 302,
            ]],
            [[
                'route'  => 'prioridades/manage',
                'method' => 'get',
                'data'   => [],
            ]],
            [[
                'route'  => 'prioridades/manage/1',
                'method' => 'put',
                'data'   => [
                    'name' => 'test_updating',
                ],
                'status' => 302,
            ]],
            [[
                'route'  => 'prioridades/manage/1',
                'method' => 'delete',
                'data'   => [],
                'status' => 302,
            ]],
        ];
    }

    #[DataProvider('getProtectedRoutesProvider')]
    public function testShouldNotAllowMeToAccessRoutesWithColaboratorRole(array $routeMetadata): void
    {
        \extract($routeMetadata);

        $user = User::factory()->create();

        $response = $this->actingAs($user)->{$method}($this->routePrefix . "/{$route}");

        $response->assertForbidden();
    }

    #[DataProvider('getProtectedRoutesProvider')]
    public function testShouldDoAllActions(array $routeMetadata): void
    {
        $method = $routeMetadata['method'] ?? 'get';
        $route  = $routeMetadata['route'] ?? '/';
        $data   = $routeMetadata['data'] ?? [];
        $status = $routeMetadata['status'] ?? 200;

        $user = User::factory()->create([
            'role_id' => 2,
        ]);

        $response = $this->actingAs($user)->{$method}($this->routePrefix . "/{$route}", $data);

        $response->assertSessionHasNoErrors();
        $response->assertStatus($status);
    }
}

<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;
use Tests\TestCase;

class ApiTokenPermissionsTest extends TestCase
{
    use RefreshDatabase;

    public function testApiTokenPermissionsCanBeUpdated(): void
    {
        if (!Features::hasApiFeatures()) {
            self::markTestSkipped('API support is not enabled.');
        }

        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        $token = $user->tokens()->create([
            'name'      => 'Test Token',
            'token'     => Str::random(40),
            'abilities' => ['create', 'read'],
        ]);

        $this->put('/user/api-tokens/' . $token->id, [
            'name'        => $token->name,
            'permissions' => [
                'delete',
                'missing-permission',
            ],
        ]);

        self::assertTrue($user->fresh()->tokens->first()->can('delete'));
        self::assertFalse($user->fresh()->tokens->first()->can('read'));
        self::assertFalse($user->fresh()->tokens->first()->can('missing-permission'));
    }
}

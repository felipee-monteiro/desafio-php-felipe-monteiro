<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Features;
use Tests\TestCase;

class CreateApiTokenTest extends TestCase
{
    use RefreshDatabase;

    public function testApiTokensCanBeCreated(): void
    {
        if (!Features::hasApiFeatures()) {
            self::markTestSkipped('API support is not enabled.');
        }

        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        $this->post('/user/api-tokens', [
            'name'        => 'Test Token',
            'permissions' => [
                'read',
                'update',
            ],
        ]);

        self::assertCount(1, $user->fresh()->tokens);
        self::assertEquals('Test Token', $user->fresh()->tokens->first()->name);
        self::assertTrue($user->fresh()->tokens->first()->can('read'));
        self::assertFalse($user->fresh()->tokens->first()->can('delete'));
    }
}

<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Fortify\Features;
use Tests\TestCase;

class TwoFactorAuthenticationSettingsTest extends TestCase
{
    use RefreshDatabase;

    public function testTwoFactorAuthenticationCanBeEnabled(): void
    {
        if (!Features::canManageTwoFactorAuthentication()) {
            self::markTestSkipped('Two factor authentication is not enabled.');
        }

        $this->actingAs($user = User::factory()->create());

        $this->withSession(['auth.password_confirmed_at' => \time()]);

        $this->post('/user/two-factor-authentication');

        self::assertNotNull($user->fresh()->two_factor_secret);
        self::assertCount(8, $user->fresh()->recoveryCodes());
    }

    public function testRecoveryCodesCanBeRegenerated(): void
    {
        if (!Features::canManageTwoFactorAuthentication()) {
            self::markTestSkipped('Two factor authentication is not enabled.');
        }

        $this->actingAs($user = User::factory()->create());

        $this->withSession(['auth.password_confirmed_at' => \time()]);

        $this->post('/user/two-factor-authentication');
        $this->post('/user/two-factor-recovery-codes');

        $user = $user->fresh();

        $this->post('/user/two-factor-recovery-codes');

        self::assertCount(8, $user->recoveryCodes());
        self::assertCount(8, \array_diff($user->recoveryCodes(), $user->fresh()->recoveryCodes()));
    }

    public function testTwoFactorAuthenticationCanBeDisabled(): void
    {
        if (!Features::canManageTwoFactorAuthentication()) {
            self::markTestSkipped('Two factor authentication is not enabled.');
        }

        $this->actingAs($user = User::factory()->create());

        $this->withSession(['auth.password_confirmed_at' => \time()]);

        $this->post('/user/two-factor-authentication');

        self::assertNotNull($user->fresh()->two_factor_secret);

        $this->delete('/user/two-factor-authentication');

        self::assertNull($user->fresh()->two_factor_secret);
    }
}

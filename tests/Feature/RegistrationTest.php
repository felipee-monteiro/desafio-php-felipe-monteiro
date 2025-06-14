<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Fortify\Features;
use Laravel\Jetstream\Jetstream;
use Tests\TestCase;

final class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function testRegistrationScreenCanBeRendered(): void
    {
        if (!Features::enabled(Features::registration())) {
            self::markTestSkipped('Registration support is not enabled.');
        }

        $response = $this->get('/register');

        $response->assertOk();
    }

    public function testRegistrationScreenCannotBeRenderedIfSupportIsDisabled(): void
    {
        if (Features::enabled(Features::registration())) {
            self::markTestSkipped('Registration support is enabled.');
        }

        $response = $this->get('/register');

        $response->assertNotFound();
    }

    public function testNewUsersCanRegister(): void
    {
        if (!Features::enabled(Features::registration())) {
            self::markTestSkipped('Registration support is not enabled.');
        }

        $response = $this->post('/register', [
            'name'                  => 'Test User',
            'email'                 => 'test@example.com',
            'password'              => 'password',
            'password_confirmation' => 'password',
            'terms'                 => Jetstream::hasTermsAndPrivacyPolicyFeature(),
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', absolute: false));
    }
}

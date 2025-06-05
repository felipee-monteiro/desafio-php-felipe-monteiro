<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('isColaborador', static fn ($user) => $user->isColaborador());
        Gate::define('isTecnico', static fn ($user) => $user->isTecnico());
        Gate::define('isActive', static fn ($user) => $user->isActive());
    }
}

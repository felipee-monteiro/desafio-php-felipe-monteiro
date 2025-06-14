<?php

declare(strict_types=1);

namespace App\Models;

use App\Composables\ParseTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

final class User extends Authenticatable
{
    use HasApiTokens;
    use ParseTimestamps;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;

    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];
    protected $appends = [
        'profile_photo_url',
    ];
    protected $with = ['role'];

    public function isActive(): bool
    {
        return $this->is_active;
    }

    public function isColaborador(): bool
    {
        // @phpstan-ignore property.notFound
        return 'colaborador' === $this->role->name;
    }

    public function isTecnico(): bool
    {
        // @phpstan-ignore property.notFound
        return 'tecnico' === $this->role->name;
    }

    public function isTecnicoOrColaborador(): bool
    {
        return $this->isTecnico() || $this->isColaborador();
    }

    public function respostas(): HasMany
    {
        return $this->hasMany(Resposta::class);
    }

    public function chamados(): HasMany
    {
        return $this->hasMany(Chamado::class, 'user_id');
    }

    public function role(): HasOne
    {
        return $this->hasOne(Roles::class, 'id', 'role_id');
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }
}

<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Roles extends Model
{
    protected $fillable = [
        'name',
    ];

    /**
     * Define a relationship between a role and a user.
     *
     * @return BelongsTo<User, $this>
     */
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

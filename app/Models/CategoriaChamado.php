<?php

declare(strict_types=1);

namespace App\Models;

use App\Composables\ParseTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class CategoriaChamado extends Model
{
    use ParseTimestamps;
    protected $fillable = [
        'name',
    ];

    /**
     * Get the chamados that belong to the categoria chamado.
     *
     * @return HasMany<Chamado, $this>
     */
    public function chamados(): HasMany
    {
        return $this->hasMany(Chamado::class);
    }
}

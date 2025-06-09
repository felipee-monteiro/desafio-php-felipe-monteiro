<?php

declare(strict_types=1);

namespace App\Models;

use App\Composables\ParseTimestamps;
use Illuminate\Database\Eloquent\Model;

final class CategoriaChamado extends Model
{
    use ParseTimestamps;
    protected $fillable = [
        'name',
    ];

    public function chamados()
    {
        return $this->hasMany(Chamado::class);
    }
}

<?php

namespace App\Models;

use App\Composables\ParseTimestamps;
use Illuminate\Database\Eloquent\Model;

class CategoriaChamado extends Model
{
    use ParseTimestamps;

    protected $fillable = [
        'name'
    ];

    public function chamados() {
        return $this->hasMany(Chamado::class);
    }
}

<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class Roles extends Model
{
    protected $fillable = [
        'name',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}

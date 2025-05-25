<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $fillable = [
        'name'
    ];

    public function users() {
        return $this->belongsTo(User::class);
    }
}

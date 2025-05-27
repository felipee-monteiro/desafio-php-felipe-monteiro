<?php

namespace App\Models;

use App\Composables\ParseTimestamps;
use Illuminate\Database\Eloquent\Model;

class PrioridadeChamado extends Model
{
    use ParseTimestamps;

    protected $fillable = ['name'];
}

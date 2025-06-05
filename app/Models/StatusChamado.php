<?php

declare(strict_types=1);

namespace App\Models;

use App\Composables\ParseTimestamps;
use Illuminate\Database\Eloquent\Model;

class StatusChamado extends Model
{
    use ParseTimestamps;
    protected $fillable = ['name'];
}

<?php

namespace App\Composables;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait ParseTimestamps
{
    protected function serializeDate(\DateTimeInterface $date)
    {
        $date->setTimezone(new \DateTimeZone("America/Sao_Paulo"));
        return $date->format('c');
    }

    protected function formatDate(string $date): string {
        return \date_format(new \DateTime($date), "d/m/Y H:i:s");
    }

    protected function createdAt(): Attribute {
        return Attribute::make(
            get: fn(string $date) =>  $this->formatDate($date),
        );
    }

    protected function updatedAt(): Attribute {
        return Attribute::make(
            get: fn(string $date) => $this->formatDate($date),
        );
    }
}

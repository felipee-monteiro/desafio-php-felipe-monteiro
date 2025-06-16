<?php

declare(strict_types=1);

namespace App\Factories\Document;

interface IDocument
{
    /**
     * @phpstan-ignore missingType.iterableValue
     */
    public function process(array $data): string;
}

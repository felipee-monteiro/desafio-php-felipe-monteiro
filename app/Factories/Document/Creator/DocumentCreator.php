<?php

declare(strict_types=1);

namespace App\Factories\Document\Creator;

use App\Factories\Document\IDocument;

abstract class DocumentCreator
{
    abstract public function createDocument(): IDocument;
}

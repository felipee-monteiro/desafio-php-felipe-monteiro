<?php

namespace App\Factories\Document\Creator;

use App\Factories\Document\IDocument;

abstract class DocumentCreator {
    abstract public function createDocument(): IDocument;
}


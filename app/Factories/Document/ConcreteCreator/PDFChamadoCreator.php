<?php

declare(strict_types=1);

namespace App\Factories\Document\ConcreteCreator;

use App\Factories\Document\ConcreteDocuments\PDFChamados;
use App\Factories\Document\Creator\DocumentCreator;
use App\Factories\Document\IDocument;

final class PDFChamadoCreator extends DocumentCreator
{
    public function createDocument(): IDocument
    {
        return new PDFChamados();
    }
}

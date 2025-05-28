<?php

namespace App\Factories\Document\ConcreteCreator;

use App\Factories\Document\Creator\DocumentCreator;
use App\Factories\Document\IDocument;
use App\Factories\Document\ConcreteDocuments\PDFChamados;

final class PDFChamadoCreator extends DocumentCreator {
    public function createDocument(): IDocument {
        return new PDFChamados;
    }
}

<?php

namespace App\Factories\Document\ConcreteCreator;

use App\Factories\Document\ConcreteDocuments\CsvChamados;
use App\Factories\Document\Creator\DocumentCreator;
use App\Factories\Document\IDocument;

final class CsvChamadoCreator extends DocumentCreator {
    public function createDocument(): IDocument
    {
        return new CsvChamados;
    }
}

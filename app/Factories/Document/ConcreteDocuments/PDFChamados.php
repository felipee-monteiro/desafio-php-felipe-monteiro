<?php

declare(strict_types=1);

namespace App\Factories\Document\ConcreteDocuments;

use App\Factories\Document\IDocument;
use Barryvdh\DomPDF\Facade\Pdf;

final class PDFChamados implements IDocument
{
    /**
     * Processes the given data to generate a PDF document.
     *
     * @param array $data the data to be used in the PDF generation
     *
     * @return string the generated PDF document as a string
     *
     * @phpstan-ignore missingType.iterableValue
     */
    public function process(array $data): string
    {
        $pdf = Pdf::loadView('chamados', $data);

        return $pdf->output();
    }
}

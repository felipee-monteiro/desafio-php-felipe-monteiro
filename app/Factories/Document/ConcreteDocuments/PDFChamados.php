<?php

namespace App\Factories\Document\ConcreteDocuments;

use App\Factories\Document\IDocument;
use Barryvdh\DomPDF\Facade\Pdf;

final class PDFChamados implements IDocument {
    public function process(array $data) {
        $pdf = Pdf::loadView('chamados', $data);
        return $pdf->output();
    }
}

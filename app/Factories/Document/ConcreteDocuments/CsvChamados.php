<?php

namespace App\Factories\Document\ConcreteDocuments;

use App\Factories\Document\IDocument;
use App\Exports\ChamadosExport;
use Maatwebsite\Excel\Facades\Excel;

final class CsvChamados implements IDocument {
    public function process(array $data)
    {
        $chamadosExport = new chamadosexport($data);
        return Excel::raw($chamadosExport, 'Csv');
    }
}

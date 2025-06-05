<?php

declare(strict_types=1);

namespace App\Factories\Document\ConcreteDocuments;

use App\Exports\ChamadosExport;
use App\Factories\Document\IDocument;
use Maatwebsite\Excel\Facades\Excel;

final class ExcelChamados implements IDocument
{
    public function process(array $data)
    {
        $chamadosExport = new chamadosexport($data);

        return Excel::raw($chamadosExport, 'Xlsx');
    }
}

<?php

declare(strict_types=1);

namespace App\Factories\Document\ConcreteDocuments;

use App\Exports\ChamadosExport;
use App\Factories\Document\IDocument;
use Maatwebsite\Excel\Facades\Excel;

final class CsvChamados implements IDocument
{
    /**
     * Processa os dados para gerar um arquivo CSV.
     *
     * @phpstan-ignore missingType.iterableValue
     */
    public function process(array $data): string
    {
        $chamadosExport = new chamadosexport($data);

        return Excel::raw($chamadosExport, 'Csv');
    }
}

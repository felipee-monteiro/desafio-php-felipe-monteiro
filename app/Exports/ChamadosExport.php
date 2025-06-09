<?php

declare(strict_types=1);

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

final class ChamadosExport implements FromView
{
    public function __construct(protected array $chamados)
    {
    }

    public function view(): View
    {
        return view('chamados', [
            'chamados' => $this->chamados['chamados'],
        ]);
    }
}

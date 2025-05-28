<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ChamadosExport implements FromView
{
    public function __construct(protected $chamados)
    {
    }

    public function view(): View {
        return view('chamados', [
            'chamados' => $this->chamados['chamados']
        ]);
    }
}

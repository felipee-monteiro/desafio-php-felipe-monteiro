<?php

namespace App\Composables;

use App\Models\Chamado;
use App\Rules\SafeIntengerRule;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

trait ShowChamado
{
    public function show(string $chamadoId)
    {
        $validator = Validator::make(['chamado_id' => $chamadoId], [
            'chamado_id' => ['required', 'numeric', new SafeIntengerRule]
        ]);

        if ($validator->fails()) {
            abort(400);
        }

        $chamado = Chamado::findOrFail($chamadoId);

        return Inertia::render('Chamados/Show', \compact('chamado'));
    }
}

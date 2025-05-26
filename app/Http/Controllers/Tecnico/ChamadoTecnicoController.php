<?php

namespace App\Http\Controllers\Tecnico;

use App\Composables\ShowChamado;
use App\Http\Controllers\Controller;
use App\Http\Requests\AlterarStatusChamadoTecnicoRequest;
use App\Http\Requests\IndexChamadoTecnicoRequest;
use App\Http\Requests\ResponderChamadoTecnicoRequest;
use App\Models\Chamado;
use Inertia\Inertia;

class ChamadoTecnicoController extends Controller
{
    use ShowChamado;

    public function index(IndexChamadoTecnicoRequest $request)
    {
        $query = Chamado::query();

        $data = $request->validated();

        if (!empty($data)) {
            if (null !== $data["status"]) {
                $query->where('status', $data['status']);
            }

            if (null !== $data['prioridade']) {
                $query->where('prioridade', $data['prioridade']);
            }
        }

        $chamados = $query->latest()->get();

        return Inertia::render('Tecnico/Chamados/Index', \compact('chamados'));
    }

    public function responder(ResponderChamadoTecnicoRequest $request, Chamado $chamado)
    {
        $mensagem = $request->safe()->only('mensagem');

        $chamado->respostas()->create([
            'user_id' => auth()->id(),
            'mensagem' => $mensagem,
        ]);

        return back()->with('success', 'Resposta enviada.');
    }

    public function alterarStatus(AlterarStatusChamadoTecnicoRequest $request, Chamado $chamado)
    {
        $status = $request->safe()->only('status');

        $chamado->update([
            'status' => $status,
        ]);

        return back()->with('success', 'Status atualizado.');
    }
}


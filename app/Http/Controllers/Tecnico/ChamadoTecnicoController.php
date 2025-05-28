<?php

namespace App\Http\Controllers\Tecnico;

use App\Composables\ShowChamado;
use App\Http\Controllers\Controller;
use App\Http\Requests\AlterarStatusChamadoTecnicoRequest;
use App\Http\Requests\IndexChamadoTecnicoRequest;
use App\Http\Requests\ResponderChamadoTecnicoRequest;
use App\Models\Chamado;
use App\Models\PrioridadeChamado;
use App\Models\StatusChamado;
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
                $query->where('status_chamados_id', $data['status']);
            }

            if (null !== $data['prioridade']) {
                $query->where('prioridade_chamado_id', $data['prioridade']);
            }

            if (null !== $data['user_id']) {
                $query->where('user_id', $data['user_id']);
            }
        }

        $chamados = $query->latest()->get();
        $status = StatusChamado::all();
        $prioridades = PrioridadeChamado::all();

        return Inertia::render('Tecnico/Chamados/Index', \compact('chamados', 'status', 'prioridades'));
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
        $status = $request->input('status_chamados_id');

        $chamado->updateOrFail([
            'status_chamados_id' => $status,
        ]);

        return back()->with('success', 'Status atualizado com sucesso.');
    }
}


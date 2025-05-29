<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChamadoRequest;
use App\Models\CategoriaChamado;
use App\Composables\ShowChamado;
use App\Http\Requests\IndexChamadoRequest;
use App\Models\Chamado;
use App\Models\PrioridadeChamado;
use App\Models\StatusChamado;
use Inertia\Inertia;

class ChamadoController extends Controller
{
    use ShowChamado;

    public function index(IndexChamadoRequest $request)
    {
        $data = $request->validated();
        $query = Chamado::query();

        if (!empty($data)) {
            if (null !== $data["status"]) {
                $query->where('status_chamados_id', $data['status']);
            }

            if (null !== $data['prioridade']) {
                $query->where('prioridade_chamado_id', $data['prioridade']);
            }
        }

        $chamados = $query->where('user_id', auth()->user()->id)->latest()->get();
        $status = StatusChamado::all();
        $prioridades = PrioridadeChamado::all();

        return Inertia::render('Chamados/Index', \compact('chamados', 'status', 'prioridades'));
    }

    public function create()
    {
        $categoriasChamado = CategoriaChamado::all();
        $prioridades = PrioridadeChamado::all();

        return Inertia::render('Chamados/Create', \compact("categoriasChamado", "prioridades"));
    }

    public function store(StoreChamadoRequest $request)
    {
        $data = $request->validated();

        // dd($data);

        if ($request->hasFile('anexo')) {
            $data['anexo'] = $request->file('anexo')->store('anexos', 'public');
        }

        $request->user()->chamados()->create($data);

        return redirect()->route('chamados.index')->with('success', 'Chamado criado com sucesso.');
    }
}


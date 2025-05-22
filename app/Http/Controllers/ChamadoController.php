<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChamadoRequest;
use App\Models\CategoriaChamado;
use App\Models\Chamado;
use Inertia\Inertia;

class ChamadoController extends Controller
{
    public function index()
    {
        $chamados = auth()->user()->chamados()->latest()->get();

        return Inertia::render('Chamados/Index', \compact('chamados'));
    }

    public function create()
    {
        $categoriasChamado = CategoriaChamado::all()->toArray();
        return Inertia::render('Chamados/Create', \compact("categoriasChamado"));
    }

    public function store(StoreChamadoRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('anexo')) {
            $data['anexo'] = $request->file('anexo')->store('anexos', 'public');
        }

        $request->user()->chamados()->create($data);

        return redirect()->route('chamados.index')->with('success', 'Chamado criado com sucesso.');
    }

    public function show(string $chamadoId)
    {
        if (!is_numeric($chamadoId) || (int)$chamadoId >= \PHP_INT_MAX) {
            abort(400, "Verifique o identificador do chamado e tente novamente.");
        }

        $chamado = Chamado::findOrFail($chamadoId);

        return Inertia::render('Chamados/Show', \compact('chamado'));
    }
}


<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChamadoRequest;
use App\Models\CategoriaChamado;
use App\Composables\ShowChamado;
use Inertia\Inertia;

class ChamadoController extends Controller
{
    use ShowChamado;

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
}


<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StorePrioridadeChamadoRequest;
use App\Http\Requests\UpdatePrioridadeChamadoRequest;
use App\Models\PrioridadeChamado;
use App\Rules\SafeIntengerRule;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class PrioridadeChamadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prioridadesChamados = PrioridadeChamado::all();

        return Inertia::render('Tecnico/Chamados/Prioridades/Index', \compact('prioridadesChamados'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePrioridadeChamadoRequest $request)
    {
        $createData = $request->safe()->only('name');

        PrioridadeChamado::create($createData);

        return back()->with('success', 'Prioridade criada com sucesso.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePrioridadeChamadoRequest $request, string $id)
    {
        $updateData = $request->safe()->only('name');

        PrioridadeChamado::findOrFail($id)->update($updateData);

        return back()->with('success', 'Prioridade atualizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $statusID = Validator::make(['id' => $id], [
            'id' => ['numeric', 'required', new SafeIntengerRule(), 'exists:prioridade_chamados,id'],
        ])->validate();

        $isDeleted = PrioridadeChamado::findOrFail($statusID['id'])->delete();

        if ($isDeleted) {
            return back()->with('success', 'Prioridade excluída com sucesso.');
        }

        return back()->with('errors', 'A prioridade não foi deletada, contate o suporte.');
    }
}

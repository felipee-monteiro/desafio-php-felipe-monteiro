<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStatusChamadoRequest;
use App\Http\Requests\UpdateStatusChamadoRequest;
use App\Models\StatusChamado;
use App\Rules\SafeIntengerRule;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class StatusChamadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $status = StatusChamado::all();
        return Inertia::render('Tecnico/Chamados/Status/Index', \compact('status'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStatusChamadoRequest $request)
    {
        $createData = $request->safe()->only('name');

        StatusChamado::create($createData);

        return back()->with('success', 'Status criado com sucesso.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStatusChamadoRequest $request, string $id)
    {
        $updateData = $request->safe()->only('name');

        StatusChamado::findOrFail($id)->update($updateData);

        return back()->with('success', 'Status atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $statusID = Validator::make(['id' => $id], [
            'id' => ['numeric', 'required', new SafeIntengerRule, 'exists:status_chamados,id']
        ])->validate();

        $isDeleted = StatusChamado::findOrFail($statusID['id'])->delete();

        if ($isDeleted) {
            return back()->with('success', 'Status excluído com sucesso.');
        }

        return back()->with('errors', 'O status não foi deletado, contate o suporte.');
    }
}

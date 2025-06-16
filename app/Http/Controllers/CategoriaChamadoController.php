<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoriaChamadoRequest;
use App\Http\Requests\UpdateCategoriaChamadoRequest;
use App\Models\CategoriaChamado;
use Inertia\Inertia;

final class CategoriaChamadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Inertia\Response
    {
        $categorias = CategoriaChamado::all();

        return Inertia::render('Tecnico/Categorias/Index', \compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoriaChamadoRequest $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->safe()->only(['name']);

        CategoriaChamado::create($data);

        return redirect()->route('tecnico.categorias.index')->with('success', 'Categoria criada com sucesso.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoriaChamadoRequest $request, string $id): \Illuminate\Http\RedirectResponse
    {
        $newName = $request->validated('newName');

        $categoriaChamado = CategoriaChamado::findOrFail($id);

        $isUpdated = $categoriaChamado->updateOrFail([
            'name' => $newName,
        ]);

        if (!$isUpdated) {
            abort(500);
        }

        return redirect()->route('tecnico.categorias.index')->with('success', 'Categoria atualizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): \Illuminate\Http\RedirectResponse
    {
        $categoriaChamado = CategoriaChamado::findOrFail($id);

        $categoriaChamado->delete();

        return redirect()->route('tecnico.categorias.index')->with('success', 'Categoria Excluída com sucesso!');
    }
}

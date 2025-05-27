<?php

namespace App\Http\Controllers;

use App\Models\StatusChamado;
use Illuminate\Http\Request;
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StatusChamado $statusChamado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StatusChamado $statusChamado)
    {
        //
    }
}

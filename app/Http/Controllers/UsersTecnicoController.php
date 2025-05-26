<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUsersTecnicoRequest;
use App\Models\Roles;
use App\Models\User;
use Inertia\Inertia;

class UsersTecnicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'users' => User::all(),
            'roles' => Roles::all(),
        ];

        return Inertia::render('Tecnico/Users/Index', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUsersTecnicoRequest $request, string $id)
    {
        $data = $request->safe()->only(['role_id', 'isActive']);

        $user = User::findOrFail($id);

        \extract($data);

        $user->role_id = $role_id;

        $user->save();

        return \redirect()->back()->with('success', 'Role atualizada com sucesso');
    }
}

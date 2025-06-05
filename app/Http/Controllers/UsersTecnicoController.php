<?php

declare(strict_types=1);

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
            'users' => User::whereNot('id', auth()->user()->id)->get(),
            'roles' => Roles::all(),
        ];

        return Inertia::render('Tecnico/Users/Index', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUsersTecnicoRequest $request, string $id)
    {
        $data = $request->safe()->only(['role_id', 'is_active']);

        $user = User::findOrFail($id);

        \extract($data);

        if (null !== $role_id) {
            $user->role_id = $role_id;
        }

        if (null !== $is_active) {
            $user->is_active = $is_active;
        }

        $user->save();

        return back()->with('success', 'Role atualizada com sucesso');
    }
}

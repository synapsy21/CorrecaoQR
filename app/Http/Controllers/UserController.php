<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $this->authorize('viewAny', User::class);
        return view('usuarios.index', ['usuarios' => User::query()->latest()->paginate(12)]);
    }

    public function create(): View
    {
        $this->authorize('create', User::class);
        return view('usuarios.create', ['usuario' => new User()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', User::class);
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:180', 'unique:users,email'],
            'role' => ['required', 'in:admin,professor'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        $data['password'] = Hash::make($data['password']);
        User::create($data);
        return redirect()->route('usuarios.index')->with('success', 'Usuário criado com sucesso.');
    }

    public function edit(User $usuario): View
    {
        $this->authorize('update', $usuario);
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, User $usuario): RedirectResponse
    {
        $this->authorize('update', $usuario);
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:180', 'unique:users,email,'.$usuario->id],
            'role' => ['required', 'in:admin,professor'],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
        ]);
        if (filled($data['password'] ?? null)) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        $usuario->update($data);
        return redirect()->route('usuarios.index')->with('success', 'Usuário atualizado.');
    }

    public function destroy(User $usuario): RedirectResponse
    {
        $this->authorize('delete', $usuario);
        $usuario->delete();
        return back()->with('success', 'Usuário removido.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Prova;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProvaController extends Controller
{
    public function index(): View
    {
        $this->authorize('viewAny', Prova::class);
        $provas = Prova::withCount(['questoes', 'respostas'])->latest()->paginate(10);
        return view('provas.index', compact('provas'));
    }

    public function create(): View
    {
        $this->authorize('create', Prova::class);
        return view('provas.create', ['prova' => new Prova()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', Prova::class);
        $data = $request->validate([
            'nome' => ['required', 'string', 'max:180'],
            'descricao' => ['nullable', 'string', 'max:2000'],
        ]);
        $prova = Prova::create($data + ['gabarito' => []]);
        return redirect()->route('provas.edit', $prova)->with('success', 'Prova criada. Agora adicione as questões.');
    }

    public function edit(Prova $prova): View
    {
        $this->authorize('update', $prova);
        $prova->load('questoes');
        return view('provas.edit', compact('prova'));
    }

    public function update(Request $request, Prova $prova): RedirectResponse
    {
        $this->authorize('update', $prova);
        $data = $request->validate([
            'nome' => ['required', 'string', 'max:180'],
            'descricao' => ['nullable', 'string', 'max:2000'],
        ]);
        $prova->update($data);
        return back()->with('success', 'Dados da prova atualizados.');
    }

    public function destroy(Prova $prova): RedirectResponse
    {
        $this->authorize('delete', $prova);
        $prova->delete();
        return redirect()->route('provas.index')->with('success', 'Prova excluída.');
    }
}

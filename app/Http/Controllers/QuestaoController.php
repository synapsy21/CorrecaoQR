<?php

namespace App\Http\Controllers;

use App\Models\Prova;
use App\Models\Questao;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class QuestaoController extends Controller
{
    public function store(Request $request, Prova $prova): RedirectResponse
    {
        $this->authorize('update', $prova);
        $data = $this->validated($request);
        $data['prova_id'] = $prova->id;
        Questao::create($data);
        $prova->sincronizarGabarito();
        return back()->with('success', 'Questão adicionada ao gabarito.');
    }

    public function update(Request $request, Questao $questao): RedirectResponse
    {
        $this->authorize('update', $questao->prova);
        $questao->update($this->validated($request));
        $questao->prova->sincronizarGabarito();
        return back()->with('success', 'Questão atualizada.');
    }

    public function destroy(Questao $questao): RedirectResponse
    {
        $this->authorize('update', $questao->prova);
        $prova = $questao->prova;
        $questao->delete();
        $prova->sincronizarGabarito();
        return back()->with('success', 'Questão removida.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'numero' => ['required', 'integer', 'min:1', 'max:200'],
            'enunciado' => ['required', 'string', 'max:10000'],
            'alternativas' => ['required', 'array', 'size:5'],
            'alternativas.A' => ['required', 'string', 'max:1000'],
            'alternativas.B' => ['required', 'string', 'max:1000'],
            'alternativas.C' => ['required', 'string', 'max:1000'],
            'alternativas.D' => ['required', 'string', 'max:1000'],
            'alternativas.E' => ['required', 'string', 'max:1000'],
            'resposta_correta' => ['required', 'in:A,B,C,D,E'],
        ]);
    }
}

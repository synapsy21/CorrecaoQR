<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Prova;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CorrecaoController extends Controller
{
    public function index(): View
    {
        return view('corrigir.index', ['provas' => Prova::orderBy('nome')->get()]);
    }

    public function student(Request $request): JsonResponse
    {
        $request->validate(['codigo' => ['required', 'regex:/^\d+\|\d+$/']]);
        [$alunoId, $provaId] = array_map('intval', explode('|', $request->string('codigo')->toString()));
        $aluno = Aluno::find($alunoId);
        $prova = Prova::find($provaId);
        if (!$aluno || !$prova) {
            return response()->json(['message' => 'Aluno ou prova não encontrado.'], 404);
        }
        return response()->json(['aluno' => $aluno, 'prova' => $prova, 'respostas' => $prova->gabarito]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Prova;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrcodeController extends Controller
{
    public function index(): View
    {
        return view('qrcodes.index', [
            'alunos' => Aluno::orderBy('nome')->get(),
            'provas' => Prova::orderBy('nome')->get(),
        ]);
    }

    public function generate(Request $request): RedirectResponse
    {
        $data = $request->validate(['prova_id' => ['required', 'exists:provas,id']]);
        return redirect()->route('qrcodes.index', ['prova_id' => $data['prova_id']])
            ->with('success', 'QRCodes prontos para impressão.');
    }

    public function show(Aluno $aluno, Prova $prova): Response
    {
        $svg = QrCode::format('svg')->size(240)->margin(1)->errorCorrection('M')->generate($aluno->id . '|' . $prova->id);
        return response($svg)->header('Content-Type', 'image/svg+xml');
    }
}

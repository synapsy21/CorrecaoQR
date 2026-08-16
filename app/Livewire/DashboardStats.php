<?php

namespace App\Livewire;

use App\Models\Prova;
use App\Models\Resposta;
use Livewire\Component;

class DashboardStats extends Component
{
    public ?int $provaId = null;
    public array $stats = [];

    public function mount(): void
    {
        $this->refreshStats();
    }

    public function updatedProvaId(): void
    {
        $this->refreshStats();
    }

    public function refreshStats(): void
    {
        $query = Resposta::query()->with('prova');
        if ($this->provaId) {
            $query->where('prova_id', $this->provaId);
        }
        $respostas = $query->get();
        $total = $respostas->count();
        $gabaritos = $this->provaId
            ? Prova::whereKey($this->provaId)->pluck('gabarito')
            : Prova::pluck('gabarito');

        $questoes = collect(range(1, 5))->map(function (int $numero) use ($respostas, $gabaritos): float {
            $tentativas = 0;
            $acertos = 0;
            foreach ($respostas as $resposta) {
                $gabarito = $resposta->prova?->gabarito ?? [];
                if (!array_key_exists((string) $numero, $gabarito)) continue;
                $tentativas++;
                if (strtoupper((string) ($resposta->respostas[(string) $numero] ?? '')) === strtoupper((string) $gabarito[(string) $numero])) {
                    $acertos++;
                }
            }
            return $tentativas ? round(($acertos / $tentativas) * 100, 1) : 0;
        })->values()->all();

        $this->stats = [
            'total' => $total,
            'media' => $total ? round((float) $respostas->avg('nota'), 2) : 0,
            'questoes' => $questoes,
            'atualizado' => now()->format('H:i:s'),
            'recentes' => $respostas->sortByDesc('corrigida_em')->take(6)->values()->map(fn ($resposta) => [
                'aluno' => $resposta->aluno?->nome ?? 'Aluno',
                'prova' => $resposta->prova?->nome ?? 'Prova',
                'nota' => (float) $resposta->nota,
                'quando' => $resposta->corrigida_em?->format('d/m/Y H:i') ?? '—',
            ])->all(),
        ];
    }

    public function render()
    {
        return view('livewire.dashboard-stats', ['provas' => Prova::orderBy('nome')->get()]);
    }
}

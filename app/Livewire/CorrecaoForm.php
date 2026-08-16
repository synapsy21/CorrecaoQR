<?php

namespace App\Livewire;

use App\Models\Aluno;
use App\Models\Prova;
use App\Models\Resposta;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CorrecaoForm extends Component
{
    public ?int $alunoId = null;
    public ?int $provaId = null;
    public ?string $alunoNome = null;
    public ?string $provaNome = null;
    public array $respostas = [];
    public array $questoes = [];

    protected $listeners = ['qrCodeLido' => 'carregarCodigo'];

    public function carregarCodigo(string $codigo): void
    {
        if (!preg_match('/^(\d+)\|(\d+)$/', $codigo, $partes)) {
            $this->addError('codigo', 'QRCode inválido.');
            return;
        }
        $aluno = Aluno::find((int) $partes[1]);
        $prova = Prova::find((int) $partes[2]);
        if (!$aluno || !$prova) {
            $this->addError('codigo', 'Aluno ou prova não encontrado.');
            return;
        }
        $this->resetErrorBag();
        $this->alunoId = $aluno->id;
        $this->provaId = $prova->id;
        $this->alunoNome = $aluno->nome;
        $this->provaNome = $prova->nome;
        $this->questoes = array_keys($prova->gabarito);
        $this->respostas = array_fill_keys($this->questoes, '');
        $this->dispatch('correcao-carregada');
    }

    public function salvar(): void
    {
        $this->validate([
            'alunoId' => ['required', 'exists:alunos,id'],
            'provaId' => ['required', 'exists:provas,id'],
            'respostas' => ['required', 'array', 'size:' . count($this->questoes)],
            'respostas.*' => ['required', Rule::in(['A', 'B', 'C', 'D', 'E'])],
        ], [
            'respostas.*.required' => 'Selecione uma alternativa.',
        ]);

        $prova = Prova::findOrFail($this->provaId);
        $acertos = collect($prova->gabarito)->filter(fn ($correta, $questao) => strtoupper((string) ($this->respostas[$questao] ?? '')) === strtoupper((string) $correta))->count();
        $nota = round(($acertos / max(count($prova->gabarito), 1)) * 10, 2);

        Resposta::updateOrCreate(
            ['aluno_id' => $this->alunoId, 'prova_id' => $this->provaId],
            ['respostas' => $this->respostas, 'nota' => $nota, 'corrigida_em' => now()]
        );

        $this->dispatch('correcao-salva', nota: number_format($nota, 2, ',', '.'), acertos: $acertos, total: count($prova->gabarito));
        $this->reset(['alunoId', 'provaId', 'alunoNome', 'provaNome', 'respostas', 'questoes']);
    }

    public function render()
    {
        return view('livewire.correcao-form');
    }
}

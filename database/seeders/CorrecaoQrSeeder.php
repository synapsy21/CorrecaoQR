<?php

namespace Database\Seeders;

use App\Models\Aluno;
use App\Models\Prova;
use App\Models\Questao;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CorrecaoQrSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@teste.com'],
            ['name' => 'Administrador', 'password' => Hash::make('123456'), 'role' => 'admin']
        );

        $prova = Prova::updateOrCreate(
            ['nome' => 'Engenharia de Software - Fundamentos'],
            ['descricao' => 'Avaliação inicial sobre conceitos fundamentais de Engenharia de Software.', 'gabarito' => ['1' => 'B', '2' => 'C', '3' => 'A', '4' => 'D', '5' => 'E']]
        );

        $questoes = [
            [1, 'Qual é o principal objetivo da Engenharia de Software?', 'B'],
            [2, 'Qual modelo organiza o desenvolvimento em etapas sequenciais?', 'C'],
            [3, 'Qual atividade identifica necessidades dos usuários?', 'A'],
            [4, 'Qual prática reduz riscos por meio de ciclos curtos?', 'D'],
            [5, 'Qual documento descreve requisitos do sistema?', 'E'],
        ];
        $alternativas = [
            'A' => 'Alternativa A', 'B' => 'Alternativa B', 'C' => 'Alternativa C',
            'D' => 'Alternativa D', 'E' => 'Alternativa E',
        ];
        foreach ($questoes as [$numero, $enunciado, $correta]) {
            Questao::updateOrCreate(
                ['prova_id' => $prova->id, 'numero' => $numero],
                ['enunciado' => $enunciado, 'alternativas' => $alternativas, 'resposta_correta' => $correta]
            );
        }
        $prova->sincronizarGabarito();

        foreach (['João Silva', 'Maria Souza', 'Carlos Lima'] as $nome) {
            Aluno::firstOrCreate(['nome' => $nome]);
        }
    }
}

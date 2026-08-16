<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Prova extends Model
{
    protected $fillable = ['nome', 'descricao', 'gabarito'];

    protected function casts(): array
    {
        return ['gabarito' => 'array'];
    }

    public function respostas(): HasMany
    {
        return $this->hasMany(Resposta::class);
    }

    public function questoes(): HasMany
    {
        return $this->hasMany(Questao::class)->orderBy('numero');
    }

    public function sincronizarGabarito(): void
    {
        $this->update([
            'gabarito' => $this->questoes()->orderBy('numero')->pluck('resposta_correta', 'numero')->toArray(),
        ]);
    }
}

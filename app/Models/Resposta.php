<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Resposta extends Model
{
    protected $fillable = ['aluno_id', 'prova_id', 'respostas', 'nota', 'corrigida_em'];

    protected function casts(): array
    {
        return [
            'respostas' => 'array',
            'nota' => 'decimal:2',
            'corrigida_em' => 'datetime',
        ];
    }

    public function aluno(): BelongsTo
    {
        return $this->belongsTo(Aluno::class);
    }

    public function prova(): BelongsTo
    {
        return $this->belongsTo(Prova::class);
    }
}

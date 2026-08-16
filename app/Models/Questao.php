<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Questao extends Model
{
    protected $table = 'questoes';

    protected $fillable = [
        'prova_id',
        'numero',
        'enunciado',
        'alternativas',
        'resposta_correta',
    ];

    protected function casts(): array
    {
        return ['alternativas' => 'array'];
    }

    public function prova(): BelongsTo
    {
        return $this->belongsTo(Prova::class);
    }
}

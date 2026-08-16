<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Aluno extends Model
{
    protected $fillable = ['nome'];

    public function respostas(): HasMany
    {
        return $this->hasMany(Resposta::class);
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('questoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prova_id')->constrained('provas')->cascadeOnDelete();
            $table->unsignedInteger('numero');
            $table->text('enunciado');
            $table->json('alternativas')->nullable();
            $table->string('resposta_correta', 1);
            $table->timestamps();

            $table->unique(['prova_id', 'numero']);
            $table->index(['prova_id', 'resposta_correta']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('questoes');
    }
};

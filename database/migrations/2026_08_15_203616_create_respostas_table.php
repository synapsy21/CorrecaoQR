<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('respostas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aluno_id')->constrained('alunos')->cascadeOnDelete();
            $table->foreignId('prova_id')->constrained('provas')->cascadeOnDelete();
            $table->json('respostas');
            $table->decimal('nota', 4, 2)->default(0);
            $table->timestamp('corrigida_em')->nullable();
            $table->timestamps();
            $table->unique(['aluno_id', 'prova_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('respostas');
    }
};

<?php

use App\Http\Controllers\CorrecaoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProvaController;
use App\Http\Controllers\QrcodeController;
use App\Http\Controllers\QuestaoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Prova;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::get('/qrcodes', [QrcodeController::class, 'index'])->name('qrcodes.index');
    Route::post('/qrcodes/gerar', [QrcodeController::class, 'generate'])->name('qrcodes.generate');
    Route::get('/qrcodes/{aluno}/{prova}', [QrcodeController::class, 'show'])->name('qrcodes.show');
    Route::get('/corrigir', [CorrecaoController::class, 'index'])->name('corrigir.index');
    Route::get('/corrigir/aluno', [CorrecaoController::class, 'student'])->name('corrigir.student');

    Route::get('/provas', [ProvaController::class, 'index'])->name('provas.index');
    Route::get('/provas/criar', [ProvaController::class, 'create'])->name('provas.create');
    Route::post('/provas', [ProvaController::class, 'store'])->name('provas.store');
    Route::get('/provas/{prova}/editar', [ProvaController::class, 'edit'])->name('provas.edit');
    Route::put('/provas/{prova}', [ProvaController::class, 'update'])->name('provas.update');
    Route::delete('/provas/{prova}', [ProvaController::class, 'destroy'])->name('provas.destroy')->can('delete', 'prova');
    Route::post('/provas/{prova}/questoes', [QuestaoController::class, 'store'])->name('questoes.store');
    Route::put('/questoes/{questao}', [QuestaoController::class, 'update'])->name('questoes.update');
    Route::delete('/questoes/{questao}', [QuestaoController::class, 'destroy'])->name('questoes.destroy');

    Route::middleware('can:viewAny,'.User::class)->group(function () {
        Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.index');
        Route::get('/usuarios/criar', [UserController::class, 'create'])->name('usuarios.create');
        Route::post('/usuarios', [UserController::class, 'store'])->name('usuarios.store');
        Route::get('/usuarios/{usuario}/editar', [UserController::class, 'edit'])->name('usuarios.edit');
        Route::put('/usuarios/{usuario}', [UserController::class, 'update'])->name('usuarios.update');
        Route::delete('/usuarios/{usuario}', [UserController::class, 'destroy'])->name('usuarios.destroy');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

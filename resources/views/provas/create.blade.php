<x-app-layout>
    <div class="mb-4"><a href="{{ route('provas.index') }}" class="text-decoration-none small"><i class="bi bi-arrow-left me-1"></i>Voltar para provas</a><h1 class="h3 fw-bold mt-3">Nova prova</h1><p class="text-muted-custom">Comece cadastrando a identificação da avaliação.</p></div>
    <div class="card-soft p-4" style="max-width:760px">@if($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
    <form method="POST" action="{{ route('provas.store') }}">@csrf
        <div class="mb-3"><label class="form-label fw-semibold">Nome da prova</label><input name="nome" class="form-control" value="{{ old('nome') }}" required placeholder="Ex.: Avaliação de Engenharia de Software"></div>
        <div class="mb-4"><label class="form-label fw-semibold">Descrição <span class="text-muted fw-normal">(opcional)</span></label><textarea name="descricao" rows="4" class="form-control" placeholder="Objetivo, turma ou instruções para o professor">{{ old('descricao') }}</textarea></div>
        <button class="btn btn-primary"><i class="bi bi-check2-circle me-2"></i>Criar e adicionar questões</button>
    </form></div>
</x-app-layout>

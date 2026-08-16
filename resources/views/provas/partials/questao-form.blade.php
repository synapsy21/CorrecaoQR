@php
    $alternativas = $questao?->alternativas ?? [];
@endphp
<div class="mb-3"><label class="form-label fw-semibold">Número</label><input type="number" name="numero" min="1" class="form-control" value="{{ old('numero', $questao?->numero) }}" required></div>
<div class="mb-3"><label class="form-label fw-semibold">Enunciado</label><textarea name="enunciado" rows="3" class="form-control" required>{{ old('enunciado', $questao?->enunciado) }}</textarea></div>
<div class="row g-2 mb-3">@foreach(['A','B','C','D','E'] as $letra)<div class="col-md-6"><label class="form-label small fw-semibold">Alternativa {{ $letra }}</label><input name="alternativas[{{ $letra }}]" class="form-control" value="{{ old('alternativas.'.$letra, $alternativas[$letra] ?? '') }}" required></div>@endforeach</div>
<label class="form-label fw-semibold">Gabarito</label><div class="d-flex flex-wrap gap-2">@foreach(['A','B','C','D','E'] as $letra)<label class="btn btn-outline-primary"><input type="radio" class="btn-check" name="resposta_correta" value="{{ $letra }}" {{ old('resposta_correta', $questao?->resposta_correta) === $letra ? 'checked' : '' }} required> {{ $letra }}</label>@endforeach</div>

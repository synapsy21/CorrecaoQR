<x-app-layout>
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div><div class="small text-primary fw-bold text-uppercase">Biblioteca acadêmica</div><h1 class="h3 fw-bold mb-1">Provas e questões</h1><p class="text-muted-custom mb-0">Cadastre avaliações, monte o gabarito e revise o conteúdo.</p></div>
        @can('create', \App\Models\Prova::class)<a href="{{ route('provas.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-2"></i>Nova prova</a>@endcan
    </div>
    @if(session('success'))<div class="alert alert-success border-0 shadow-sm">{{ session('success') }}</div>@endif
    <div class="card-soft overflow-hidden"><div class="table-responsive"><table class="table align-middle mb-0"><thead class="table-light"><tr><th>Prova</th><th>Questões</th><th>Correções</th><th>Atualizada</th><th class="text-end">Ações</th></tr></thead><tbody>
    @forelse($provas as $prova)
        <tr><td><div class="fw-bold">{{ $prova->nome }}</div><div class="small text-muted-custom">{{ Str::limit($prova->descricao, 90) }}</div></td><td><span class="badge badge-soft">{{ $prova->questoes_count }} questões</span></td><td>{{ $prova->respostas_count }}</td><td class="text-muted-custom">{{ $prova->updated_at->format('d/m/Y H:i') }}</td><td class="text-end"><a href="{{ route('provas.edit', $prova) }}" class="btn btn-sm btn-light"><i class="bi bi-pencil me-1"></i>Editar</a> @can('delete', $prova)<form class="d-inline" method="POST" action="{{ route('provas.destroy', $prova) }}" onsubmit="return confirm('Excluir esta prova e suas questões?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button></form>@endcan</td></tr>
    @empty<tr><td colspan="5"><div class="empty-state"><i class="bi bi-journal-x fs-1 d-block mb-3"></i>Nenhuma prova cadastrada.</div></td></tr>@endforelse
    </tbody></table></div><div class="p-3">{{ $provas->links() }}</div></div>
</x-app-layout>

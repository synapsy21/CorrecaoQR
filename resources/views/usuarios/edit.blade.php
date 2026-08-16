<x-app-layout>
<div class="mb-4"><a href="{{ route('usuarios.index') }}" class="text-decoration-none small"><i class="bi bi-arrow-left me-1"></i>Voltar</a><h1 class="h3 fw-bold mt-3">Editar usuário</h1><p class="text-muted-custom">Atualize os dados e o nível de acesso de {{ $usuario->name }}.</p></div>
<div class="card-soft p-4" style="max-width:700px">@if($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif<form method="POST" action="{{ route('usuarios.update', $usuario) }}">@csrf @method('PUT') @include('usuarios.partials.form', ['usuario' => $usuario])<button class="btn btn-primary"><i class="bi bi-check2-circle me-2"></i>Salvar alterações</button></form></div>
</x-app-layout>

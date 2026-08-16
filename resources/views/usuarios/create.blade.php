<x-app-layout>
<div class="mb-4"><a href="{{ route('usuarios.index') }}" class="text-decoration-none small"><i class="bi bi-arrow-left me-1"></i>Voltar</a><h1 class="h3 fw-bold mt-3">Novo usuário</h1><p class="text-muted-custom">Crie um acesso para administrador ou professor.</p></div>
<div class="card-soft p-4" style="max-width:700px">@if($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif<form method="POST" action="{{ route('usuarios.store') }}">@csrf @include('usuarios.partials.form', ['usuario' => $usuario])<button class="btn btn-primary"><i class="bi bi-check2-circle me-2"></i>Criar usuário</button></form></div>
</x-app-layout>

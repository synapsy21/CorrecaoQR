<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>

<form method="post" action="{{ route('profile.update') }}" class="profile-form">
    @csrf
    @method('patch')

    <div class="mb-3">
        <label for="name" class="profile-label">Nome completo</label>
        <input id="name" name="name" type="text" class="form-control profile-input" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
        @if($errors->get('name'))<div class="text-danger small mt-1">{{ $errors->first('name') }}</div>@endif
    </div>

    <div class="mb-3">
        <label for="email" class="profile-label">E-mail</label>
        <input id="email" name="email" type="email" class="form-control profile-input" value="{{ old('email', $user->email) }}" required autocomplete="username">
        @if($errors->get('email'))<div class="text-danger small mt-1">{{ $errors->first('email') }}</div>@endif
    </div>

    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
        <div class="alert alert-warning small py-2">
            Seu e-mail ainda não foi confirmado.
            <button form="send-verification" class="btn btn-link btn-sm p-0 align-baseline">Reenviar confirmação</button>
            @if (session('status') === 'verification-link-sent')
                <div class="text-success mt-1">Um novo link de confirmação foi enviado.</div>
            @endif
        </div>
    @endif

    <div class="d-flex align-items-center gap-3 pt-2">
        <button type="submit" class="btn btn-primary px-4"><i class="bi bi-check2 me-1" aria-hidden="true"></i>Salvar dados</button>
        @if (session('status') === 'profile-updated')<span class="profile-status"><i class="bi bi-check-circle me-1" aria-hidden="true"></i>Salvo</span>@endif
    </div>
</form>

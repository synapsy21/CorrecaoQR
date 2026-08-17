<form method="post" action="{{ route('password.update') }}" class="profile-form">
    @csrf
    @method('put')

    <div class="mb-3">
        <label for="update_password_current_password" class="profile-label">Senha atual</label>
        <input id="update_password_current_password" name="current_password" type="password" class="form-control profile-input" autocomplete="current-password" required>
        @if($errors->updatePassword->get('current_password'))<div class="text-danger small mt-1">{{ $errors->updatePassword->first('current_password') }}</div>@endif
    </div>

    <div class="mb-3">
        <label for="update_password_password" class="profile-label">Nova senha</label>
        <input id="update_password_password" name="password" type="password" class="form-control profile-input" autocomplete="new-password" required>
        <div class="profile-help mt-1">Prefira uma combinação longa, exclusiva e difícil de adivinhar.</div>
        @if($errors->updatePassword->get('password'))<div class="text-danger small mt-1">{{ $errors->updatePassword->first('password') }}</div>@endif
    </div>

    <div class="mb-3">
        <label for="update_password_password_confirmation" class="profile-label">Confirmar nova senha</label>
        <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control profile-input" autocomplete="new-password" required>
        @if($errors->updatePassword->get('password_confirmation'))<div class="text-danger small mt-1">{{ $errors->updatePassword->first('password_confirmation') }}</div>@endif
    </div>

    <div class="d-flex align-items-center gap-3 pt-2">
        <button type="submit" class="btn btn-primary px-4"><i class="bi bi-shield-check me-1" aria-hidden="true"></i>Atualizar senha</button>
        @if (session('status') === 'password-updated')<span class="profile-status"><i class="bi bi-check-circle me-1" aria-hidden="true"></i>Senha salva</span>@endif
    </div>
</form>

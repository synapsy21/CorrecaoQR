<div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
    <p class="profile-danger-copy mb-0" style="max-width:760px">Ao excluir sua conta, seus dados de acesso e recursos associados serão removidos permanentemente. Essa ação não pode ser desfeita.</p>
    <button type="button" class="btn btn-outline-danger" x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"><i class="bi bi-trash3 me-1" aria-hidden="true"></i>Excluir minha conta</button>
</div>

<x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
    <form method="post" action="{{ route('profile.destroy') }}" class="p-4 p-md-5">
        @csrf
        @method('delete')

        <div class="d-flex align-items-center gap-3 mb-3">
            <div class="profile-card-icon danger"><i class="bi bi-trash3" aria-hidden="true"></i></div>
            <h2 class="h5 mb-0">Confirmar exclusão da conta</h2>
        </div>
        <p class="profile-danger-copy">Essa ação é permanente. Informe sua senha atual para confirmar que deseja excluir sua conta NexoEdu.</p>

        <div class="mt-4">
            <label for="delete_password" class="profile-label">Senha atual</label>
            <input id="delete_password" name="password" type="password" class="form-control profile-input" placeholder="Digite sua senha" autocomplete="current-password" required>
            @if($errors->userDeletion->get('password'))<div class="text-danger small mt-1">{{ $errors->userDeletion->first('password') }}</div>@endif
        </div>

        <div class="d-flex justify-content-end gap-2 mt-4">
            <button type="button" class="btn btn-outline-secondary px-4" x-on:click="$dispatch('close')">Cancelar</button>
            <button type="submit" class="btn btn-danger px-4">Excluir definitivamente</button>
        </div>
    </form>
</x-modal>

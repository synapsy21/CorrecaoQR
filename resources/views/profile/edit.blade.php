<x-app-layout>
    {{-- NexoEdu perfil: painel sóbrio em azul-marinho, branco e royal para que o professor gerencie sua conta sem a aparência padrão do Breeze. --}}
    <style>
        .profile-page{max-width:1180px;margin:0 auto}.profile-hero{background:linear-gradient(135deg,#071c3b,#123a78);border-radius:18px;padding:28px 30px;color:#fff;position:relative;overflow:hidden}.profile-hero:after{content:'';position:absolute;width:310px;height:310px;border:1px solid rgba(255,255,255,.16);border-radius:50%;right:-110px;bottom:-175px;box-shadow:0 0 0 34px rgba(255,255,255,.04),0 0 0 70px rgba(255,255,255,.025)}.profile-hero-content{position:relative;z-index:1}.profile-avatar{width:64px;height:64px;border-radius:18px;display:grid;place-items:center;background:#fff;color:#2563eb;font:800 1.5rem 'Plus Jakarta Sans',sans-serif;box-shadow:0 12px 26px rgba(0,0,0,.16)}.profile-card{border:1px solid #e5e9f1;border-radius:16px;background:#fff;box-shadow:0 8px 24px rgba(23,35,61,.045);height:100%}.profile-card-header{display:flex;align-items:flex-start;gap:14px;padding:24px 26px 0}.profile-card-icon{width:42px;height:42px;border-radius:12px;display:grid;place-items:center;background:#eaf2ff;color:#2563eb;font-size:1.15rem;flex:0 0 auto}.profile-card-icon.security{background:#e9f8f2;color:#15805d}.profile-card-icon.danger{background:#fff0f0;color:#c0393b}.profile-card-body{padding:22px 26px 26px}.profile-label{font-size:.82rem;font-weight:700;color:#17233d;margin-bottom:7px}.profile-input{min-height:48px;border:1px solid #dfe5ef;border-radius:10px;padding:.7rem .85rem}.profile-input:focus{border-color:#2563eb;box-shadow:0 0 0 .2rem rgba(37,99,235,.12)}.profile-help{font-size:.88rem;color:#718096}.profile-status{color:#15805d;font-size:.86rem;font-weight:700}.profile-danger{border-color:#f2d1d1}.profile-danger .profile-card-header{color:#8d2528}.profile-danger-copy{color:#718096;font-size:.88rem;line-height:1.55}.profile-page .btn-primary{background:#2563eb;border-color:#2563eb;border-radius:10px;font-weight:700}.profile-page .btn-outline-secondary{border-color:#dfe5ef;border-radius:10px;font-weight:600}.profile-page .btn-outline-danger{border-radius:10px;font-weight:700}@media(max-width:767px){.profile-hero{padding:22px}.profile-card-header,.profile-card-body{padding-left:20px;padding-right:20px}}
    </style>

    <div class="profile-page">
        <div class="profile-hero mb-4">
            <div class="profile-hero-content d-flex align-items-center gap-3">
                <div class="profile-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                <div>
                    <div class="small text-white-50 mb-1">Minha conta NexoEdu</div>
                    <h1 class="h3 mb-1" style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;letter-spacing:-.03em">Perfil e segurança</h1>
                    <p class="mb-0 text-white-50">Mantenha seus dados atualizados e seu acesso protegido.</p>
                </div>
            </div>
        </div>

        @if(session('status') === 'profile-updated' || session('status') === 'password-updated')
            <div class="alert alert-success border-0 shadow-sm d-flex align-items-center gap-2 mb-4" role="status">
                <i class="bi bi-check-circle-fill" aria-hidden="true"></i>
                <span>{{ session('status') === 'profile-updated' ? 'Dados do perfil atualizados com sucesso.' : 'Senha atualizada com sucesso.' }}</span>
            </div>
        @endif

        <div class="row g-4">
            <div class="col-lg-6">
                <div class="profile-card">
                    <div class="profile-card-header">
                        <div class="profile-card-icon"><i class="bi bi-person-vcard" aria-hidden="true"></i></div>
                        <div><h2 class="h5 mb-1">Dados pessoais</h2><p class="profile-help mb-0">Atualize seu nome e o e-mail usado no NexoEdu.</p></div>
                    </div>
                    <div class="profile-card-body">@include('profile.partials.update-profile-information-form')</div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="profile-card">
                    <div class="profile-card-header">
                        <div class="profile-card-icon security"><i class="bi bi-shield-lock" aria-hidden="true"></i></div>
                        <div><h2 class="h5 mb-1">Senha de acesso</h2><p class="profile-help mb-0">Use uma senha exclusiva para proteger seus dados pedagógicos.</p></div>
                    </div>
                    <div class="profile-card-body">@include('profile.partials.update-password-form')</div>
                </div>
            </div>
            <div class="col-12">
                <div class="profile-card profile-danger">
                    <div class="profile-card-header">
                        <div class="profile-card-icon danger"><i class="bi bi-exclamation-triangle" aria-hidden="true"></i></div>
                        <div><h2 class="h5 mb-1">Zona de segurança</h2><p class="profile-danger-copy mb-0">A exclusão da conta é permanente. Só continue se tiver certeza e se já tiver salvo as informações necessárias.</p></div>
                    </div>
                    <div class="profile-card-body">@include('profile.partials.delete-user-form')</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'CorrecaoQR' }} | CorrecaoQR</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @livewireStyles
    <style>
        :root{--ink:#17233d;--muted:#718096;--primary:#4568f5;--primary-soft:#edf1ff;--green:#20b486;--bg:#f6f8fc;--line:#e8edf5}
        *{box-sizing:border-box}body{font-family:'DM Sans',sans-serif;background:var(--bg);color:var(--ink);min-height:100vh}.brand-font,h1,h2,h3,h4,.navbar-brand{font-family:'Plus Jakarta Sans',sans-serif}.app-shell{display:flex;min-height:100vh}.sidebar{width:250px;background:#fff;border-right:1px solid var(--line);position:fixed;top:0;bottom:0;z-index:1040}.main-area{margin-left:250px;width:calc(100% - 250px)}.sidebar-brand{padding:28px 24px 25px;font-weight:800;font-size:1.12rem;color:var(--ink);text-decoration:none}.brand-mark{display:inline-grid;place-items:center;width:38px;height:38px;border-radius:12px;background:linear-gradient(135deg,#4568f5,#7c5cff);color:#fff;margin-right:10px}.nav-section{padding:0 14px}.nav-label{text-transform:uppercase;font-size:.68rem;font-weight:700;letter-spacing:.1em;color:#a1acbe;padding:20px 14px 9px}.side-link{display:flex;align-items:center;gap:12px;padding:12px 14px;margin:3px 0;border-radius:12px;color:#7c879b;text-decoration:none;font-weight:600;font-size:.9rem;transition:.2s}.side-link:hover,.side-link.active{background:var(--primary-soft);color:var(--primary)}.side-link i{font-size:1.1rem}.topbar{height:78px;background:#fff;border-bottom:1px solid var(--line);display:flex;align-items:center;justify-content:space-between;padding:0 32px}.page-content{padding:32px}.card-soft{border:1px solid var(--line);border-radius:18px;background:#fff;box-shadow:0 8px 30px rgba(42,56,85,.045)}.metric-card{position:relative;overflow:hidden;min-height:146px}.metric-icon{width:48px;height:48px;border-radius:15px;display:grid;place-items:center;font-size:1.25rem}.metric-blue{background:#edf1ff;color:var(--primary)}.metric-green{background:#e8faf4;color:var(--green)}.metric-purple{background:#f2edff;color:#7958e8}.metric-orange{background:#fff4e7;color:#e89527}.text-muted-custom{color:var(--muted)}.btn-primary{--bs-btn-bg:#4568f5;--bs-btn-border-color:#4568f5;--bs-btn-hover-bg:#3455de;--bs-btn-hover-border-color:#3455de;border-radius:10px;font-weight:600}.btn-light{border:1px solid var(--line);border-radius:10px;font-weight:600}.form-select,.form-control{border-color:#dfe5ef;border-radius:10px;padding:.72rem .9rem}.form-select:focus,.form-control:focus{border-color:#8fa3ff;box-shadow:0 0 0 .2rem rgba(69,104,245,.12)}.avatar{width:38px;height:38px;border-radius:50%;display:grid;place-items:center;background:#e5eaff;color:var(--primary);font-weight:700}.table> :not(caption)>*>*{padding:1rem .8rem}.badge-soft{background:var(--primary-soft);color:var(--primary);font-weight:600}.qr-card{transition:transform .2s,box-shadow .2s}.qr-card:hover{transform:translateY(-3px);box-shadow:0 14px 35px rgba(42,56,85,.1)}.qr-image{width:190px;height:190px;object-fit:contain}.scanner-box{border:2px dashed #cbd5ed;border-radius:18px;background:#fbfcff}.question-row{border:1px solid var(--line);border-radius:14px;padding:14px;background:#fbfcff}.question-number{width:34px;height:34px;border-radius:10px;background:var(--primary-soft);color:var(--primary);display:grid;place-items:center;font-weight:700}.empty-state{padding:56px 20px;color:var(--muted);text-align:center}.mobile-menu{display:none}@media(max-width:991px){.sidebar{transform:translateX(-100%);transition:.2s}.sidebar.show{transform:translateX(0)}.main-area{margin-left:0;width:100%}.mobile-menu{display:inline-flex}.page-content{padding:22px}.topbar{padding:0 20px}}
    </style>
    @stack('styles')
</head>
<body>
<div class="app-shell">
    <aside class="sidebar" id="appSidebar">
        <a href="{{ route('dashboard') }}" class="sidebar-brand d-flex align-items-center"><span class="brand-mark"><i class="bi bi-qr-code-scan"></i></span><span>Correcao<span class="text-primary">QR</span></span></a>
        <div class="nav-section"><div class="nav-label">Principal</div>
            <a href="{{ route('dashboard') }}" class="side-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"><i class="bi bi-grid-1x2-fill"></i> Visão geral</a>
            <a href="{{ route('corrigir.index') }}" class="side-link {{ request()->routeIs('corrigir.*') ? 'active' : '' }}"><i class="bi bi-camera-fill"></i> Corrigir prova</a>
            <a href="{{ route('qrcodes.index') }}" class="side-link {{ request()->routeIs('qrcodes.*') ? 'active' : '' }}"><i class="bi bi-qr-code"></i> QRCodes</a>
            @can('viewAny', \App\Models\Prova::class)
                <a href="{{ route('provas.index') }}" class="side-link {{ request()->routeIs('provas.*') || request()->routeIs('questoes.*') ? 'active' : '' }}"><i class="bi bi-journal-text"></i> Provas e questões</a>
            @endcan
            @can('viewAny', \App\Models\User::class)
                <a href="{{ route('usuarios.index') }}" class="side-link {{ request()->routeIs('usuarios.*') ? 'active' : '' }}"><i class="bi bi-people-fill"></i> Usuários</a>
            @endcan
        </div>
        <div class="nav-section"><div class="nav-label">Conta</div><a href="{{ route('profile.edit') }}" class="side-link"><i class="bi bi-person-circle"></i> Meu perfil</a><form method="POST" action="{{ route('logout') }}">@csrf<button type="submit" class="side-link border-0 bg-transparent w-100 text-start"><i class="bi bi-box-arrow-right"></i> Sair</button></form></div>
        <div class="position-absolute bottom-0 start-0 end-0 p-3"><div class="p-3 rounded-4" style="background:#f7f8fc"><div class="small fw-bold mb-1">Precisa de ajuda?</div><div class="small text-muted-custom mb-2">Acesse o guia rápido do sistema.</div><a href="{{ route('corrigir.index') }}" class="small text-primary text-decoration-none fw-bold">Começar agora <i class="bi bi-arrow-right"></i></a></div></div>
    </aside>
    <section class="main-area"><header class="topbar"><div class="d-flex align-items-center gap-3"><button class="btn btn-light mobile-menu" onclick="document.getElementById('appSidebar').classList.toggle('show')"><i class="bi bi-list"></i></button><div><div class="small text-muted-custom">{{ now()->translatedFormat('l, d \d\e F') }}</div><div class="fw-bold">Olá, {{ auth()->user()->name }}!</div></div></div><div class="d-flex align-items-center gap-3"><div class="text-end d-none d-sm-block"><div class="small fw-bold">{{ auth()->user()->name }}</div><div class="small text-muted-custom">{{ auth()->user()->role === 'admin' ? 'Administrador' : 'Professor' }}</div></div><div class="avatar">{{ strtoupper(substr(auth()->user()->name,0,1)) }}</div><form method="POST" action="{{ route('logout') }}" class="m-0">@csrf<button type="submit" class="btn btn-outline-danger btn-sm d-flex align-items-center gap-2" title="Encerrar sessão"><i class="bi bi-box-arrow-right"></i><span class="d-none d-md-inline">Sair</span></button></form></div></header><main class="page-content">{{ $slot }}</main></section>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@livewireScripts
@stack('scripts')
</body></html>

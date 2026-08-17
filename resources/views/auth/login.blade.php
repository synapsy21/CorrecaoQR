<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Entrar | NexoEdu</title>
    <link rel="icon" type="image/png" href="{{ asset('images/branding/nexoedu-favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        /* NexoEdu login: cartografia da aprendizagem em azul royal, com contraste sóbrio, marca conectada e foco no acesso rápido do professor. */
        :root {
            --navy: #071c3b;
            --navy-soft: #123a78;
            --royal: #2563eb;
            --royal-bright: #3b82f6;
            --cyan: #55c9e8;
            --ink: #17233d;
            --muted: #718096;
            --line: #dfe7f2;
            --surface: #f6f8fc;
        }

        * { box-sizing: border-box; }
        body { margin: 0; font-family: 'DM Sans', sans-serif; background: var(--surface); color: var(--ink); }
        .brand-font, h1, h2, h3 { font-family: 'Plus Jakarta Sans', sans-serif; }
        .login-wrap { min-height: 100vh; }
        .login-visual {
            position: relative;
            overflow: hidden;
            background: linear-gradient(145deg, var(--navy) 0%, #0d3570 48%, var(--royal) 100%);
        }
        .login-visual::before {
            content: '';
            position: absolute;
            width: 620px;
            height: 620px;
            right: -250px;
            bottom: -290px;
            border: 1px solid rgba(255,255,255,.18);
            border-radius: 50%;
            box-shadow: 0 0 0 58px rgba(255,255,255,.045), 0 0 0 118px rgba(255,255,255,.025);
        }
        .login-visual::after {
            content: '';
            position: absolute;
            width: 280px;
            height: 280px;
            left: -160px;
            top: -140px;
            border: 1px solid rgba(85,201,232,.24);
            border-radius: 50%;
        }
        .visual-content { position: relative; z-index: 1; max-width: 520px; margin: auto; }
        .brand-lockup { display: inline-flex; align-items: center; gap: 13px; }
        .brand-symbol {
            width: 48px;
            height: 48px;
            padding: 7px;
            object-fit: contain;
            border-radius: 14px;
            background: rgba(255,255,255,.98);
            box-shadow: 0 14px 34px rgba(0,0,0,.18);
        }
        .brand-wordmark { color: #fff; font-size: 1.4rem; font-weight: 800; letter-spacing: -.04em; }
        .brand-wordmark span { color: #8bdcf0; }
        .visual-title { color: #fff; font-size: clamp(2.4rem, 4vw, 4.1rem); line-height: 1.08; letter-spacing: -.055em; }
        .visual-copy { color: #c7d7ed; max-width: 470px; font-size: 1.08rem; line-height: 1.65; }
        .feature {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 16px 18px;
            color: #fff;
            border: 1px solid rgba(255,255,255,.18);
            border-radius: 16px;
            background: rgba(255,255,255,.09);
            backdrop-filter: blur(12px);
        }
        .feature-icon { color: var(--cyan); font-size: 1.55rem; }
        .feature small { color: #b9cbe4; }
        .login-panel { background: #fff; }
        .login-card { width: 100%; max-width: 430px; }
        .mobile-brand { display: none; }
        .eyebrow { color: var(--muted); font-size: .9rem; }
        .login-title { color: var(--ink); font-size: 2rem; letter-spacing: -.04em; }
        .login-description { color: var(--muted); }
        .form-label { color: var(--ink); }
        .form-control {
            min-height: 54px;
            padding: .82rem 1rem;
            color: var(--ink);
            border: 1px solid var(--line);
            border-radius: 12px;
            background: #fbfdff;
        }
        .form-control:focus { border-color: var(--royal-bright); box-shadow: 0 0 0 .22rem rgba(37,99,235,.13); }
        .btn-primary {
            min-height: 54px;
            border: 0;
            border-radius: 12px;
            background: var(--royal);
            font-weight: 700;
            box-shadow: 0 10px 22px rgba(37,99,235,.18);
            transition: transform .16s ease, background .16s ease, box-shadow .16s ease;
        }
        .btn-primary:hover { background: #1d4ed8; box-shadow: 0 13px 26px rgba(37,99,235,.25); }
        .btn-primary:active { transform: scale(.98); }
        .demo-note { color: var(--muted); }
        .text-primary { color: var(--royal) !important; }
        @media (max-width: 991.98px) {
            .mobile-brand { display: inline-flex; }
            .login-panel { min-height: 100vh; }
        }
        @media (prefers-reduced-motion: reduce) {
            .btn-primary { transition: none; }
        }
    </style>
</head>
<body>
    <div class="row g-0 login-wrap">
        <div class="col-lg-6 d-none d-lg-flex login-visual text-white p-5 align-items-center">
            <div class="visual-content">
                <div class="brand-lockup mb-5">
                    <img class="brand-symbol" src="{{ asset('images/branding/nexoedu-symbol-app.png') }}" alt="Símbolo NexoEdu">
                    <span class="brand-wordmark">Nexo<span>Edu</span></span>
                </div>
                <h1 class="brand-font visual-title fw-bold mb-4">Corrija provas com mais agilidade e confiança.</h1>
                <p class="visual-copy mb-5">Uma experiência simples para digitalizar a correção, acompanhar o desempenho da turma e transformar evidências em decisões pedagógicas.</p>
                <div class="feature">
                    <i class="bi bi-shield-check feature-icon" aria-hidden="true"></i>
                    <div>
                        <strong class="d-block">Seus dados protegidos</strong>
                        <small>Acesso seguro e controle por usuário.</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 d-flex align-items-center justify-content-center login-panel p-4 p-md-5">
            <div class="login-card">
                <div class="mobile-brand brand-lockup mb-5">
                    <img class="brand-symbol" src="{{ asset('images/branding/nexoedu-symbol-app.png') }}" alt="Símbolo NexoEdu">
                    <span class="brand-wordmark" style="color: var(--ink);">Nexo<span>Edu</span></span>
                </div>

                <div class="mb-5">
                    <div class="eyebrow mb-2">Bem-vindo de volta</div>
                    <h2 class="brand-font login-title fw-bold mb-2">Acesse sua conta</h2>
                    <p class="login-description mb-0">Entre para gerenciar suas correções.</p>
                </div>

                <x-auth-session-status class="alert alert-success" :status="session('status')" />
                @if($errors->any())
                    <div class="alert alert-danger border-0"><i class="bi bi-exclamation-circle me-2" aria-hidden="true"></i>{{ $errors->first() }}</div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">E-mail</label>
                        <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="voce@escola.com">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Senha</label>
                        <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" placeholder="Digite sua senha">
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <label class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember">
                            <span class="form-check-label small text-muted">Lembrar de mim</span>
                        </label>
                        @if(Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="small text-primary text-decoration-none fw-semibold">Esqueceu a senha?</a>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Entrar <i class="bi bi-arrow-right ms-2" aria-hidden="true"></i></button>
                </form>

                <div class="text-center small demo-note mt-5">Acesso demonstrativo: <strong>admin@teste.com</strong> / <strong>123456</strong></div>
            </div>
        </div>
    </div>
</body>
</html>

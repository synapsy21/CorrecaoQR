# CorrecaoQR

Aplicação web em **Laravel 11 + PHP 8.2+ + MySQL/MariaDB + Bootstrap 5 + Livewire 3** para correção de provas por QRCode, com dashboard moderno, cadastro de avaliações, questões, gabaritos e usuários.

## Recursos

O sistema possui autenticação Breeze, perfis de administrador e professor, dashboard com métricas e gráfico Chart.js, atualização automática com `wire:poll.3s`, geração de QRCodes individuais em SVG, leitura pela câmera com `html5-qrcode`, correção automática e relatórios recentes.

A área **Provas e questões** permite cadastrar uma prova, informar descrição, criar questões com enunciado, cinco alternativas e resposta correta, editar o conteúdo e visualizar o gabarito sincronizado automaticamente. A área **Usuários** é exclusiva do administrador e permite criar, editar e remover contas.

## Permissões

Administradores podem gerenciar usuários, criar e editar provas e questões, corrigir avaliações, visualizar relatórios e excluir provas. Professores podem criar e editar provas e questões, visualizar gabaritos, gerar QRCodes, corrigir provas e consultar o dashboard. A exclusão de usuários e provas é restrita ao administrador.

## Requisitos

Use PHP 8.2 ou superior, Composer, Node.js/NPM e MySQL 8 ou MariaDB. A extensão PHP GD não é necessária para o QRCode padrão em SVG, mas recomenda-se manter PDO MySQL, Mbstring, XML, Ctype, JSON e OpenSSL habilitadas.

## Instalação local

Abra a pasta que contém diretamente `artisan` e `composer.json`:

```powershell
cd "C:\Users\Antonio Almeida\Projetos\CorrecaoQR"
composer install
npm install
Copy-Item .env.example .env
php artisan key:generate
npm run build
```

Crie o banco `correcao_qr` no MySQL/MariaDB e ajuste o `.env`:

```dotenv
APP_NAME=CorrecaoQR
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8090

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=correcao_qr
DB_USERNAME=root
DB_PASSWORD=
```

Depois execute:

```powershell
php artisan migrate --seed
```

Se `php artisan serve` não encontrar uma porta disponível, use diretamente:

```powershell
php -S 127.0.0.1:8090 -t public
```

Acesse `http://127.0.0.1:8090/login`.

| Usuário | Senha | Perfil |
|---|---|---|
| admin@teste.com | 123456 | Administrador |

## Atualizar uma instalação existente

Depois de copiar os arquivos atualizados para sua instalação local, execute:

```powershell
composer dump-autoload
php artisan migrate
php artisan db:seed --class=CorrecaoQrSeeder
php artisan view:clear
npm install
npm run build
```

Em um banco de testes, é possível recriar tudo com:

```powershell
php artisan migrate:fresh --seed
```

Atenção: `migrate:fresh` apaga todas as tabelas e dados do banco selecionado.

## Fluxo de uso

O administrador ou professor acessa **Provas e questões**, cria uma prova e adiciona cada questão com enunciado, alternativas A-E e resposta correta. O sistema mantém o gabarito da prova sincronizado. Em seguida, o professor acessa **QRCodes**, gera os cartões, realiza a leitura na tela **Corrigir prova** e acompanha os resultados no dashboard.

## Comandos Artisan principais

```bash
php artisan migrate --seed
php artisan route:list
php artisan view:clear
php artisan optimize
```

## Produção

Configure `APP_ENV=production`, `APP_DEBUG=false`, uma chave segura, credenciais MySQL próprias e HTTPS. Execute `php artisan config:cache`, `php artisan route:cache` e `php artisan view:cache`. Para o uso da câmera em celulares, disponibilize o site via HTTPS.

<?php
// auth.php já carrega functions.php (função e() para escapar texto) e inicia a sessão
require_once __DIR__ . '/../../../includes/auth.php';
$erroLogin    = pegar_erro('login');      // erros aparecem uma única vez
$erroCadastro = pegar_erro('cadastro');
$antigo       = pegar_antigo();           // valores digitados no cadastro
$aba          = $erroCadastro ? 'cadastro' : 'login';

// Links do menu (a landing page tem as seções #sobre e #pacotes)
$landing = '../../client/landingpage/index.php';

// Equipe repetida nos 3 projetos
$equipe = [
  'Arthur Alencar (Back-End Developer)',
  'Lucas Gallo (Project Manager)',
  'Lucas Rolim (Database Lead)',
  'Vanessa Balbino (Designer & Front-End Developer)',
];

// Um item por projeto. Cada projeto tem as imagens (cada uma é um card), equipe, texto e 4 cores.
$projetos = [
  [
    'nome'    => 'Deu Bug!',
    'equipe'  => $equipe,
    'sobre'   => 'Consultoria digital que une tecnologia, design e criatividade para ajudar pequenas e médias empresas a crescerem no ambiente online.',
    'imagens' => [
      'deubug-versions.png',
      'deubug-character.png',
      'deubug-logo-variants.png',
      'deubug-social-media-aplication.png',
    ],
    'cores'   => ['#7b4bb3', '#9d7ec0', '#d6c7e7', '#f5f5f5'],
  ],
  [
    'nome'    => 'Cafeteria Pausa & Prosa',
    'equipe'  => $equipe,
    'sobre'   => 'Identidade visual e site para uma cafeteria acolhedora, pensada para boas conversas. Paleta em tons de café e bege, com foco em aconchego.',
    'imagens' => [
      'cafe&prosa-versions.png',
      'cafe&prosa-logo-variants.png',
      'cafe&prosa-social-media.png',
      'cafe&prosa-applications.png',
    ],
    'cores'   => ['#3b1f14', '#6b3a26', '#c8a27a', '#f1eeea'],
  ],
  [
    'nome'    => 'Panacuca Cozinha e Vinho',
    'equipe'  => $equipe,
    'sobre'   => 'Identidade visual e site para um restaurante de cozinha autêntica e vinhos selecionados, com visual sofisticado em marrom e laranja.',
    'imagens' => [
      'panacuca-versions.png',
      'panacuca-logo-variants.png',
      'panacuca-social-media.png',
      'panacuca-applications.png',
    ],
    'cores'   => ['#1f0f0b', '#7a2310', '#e8891c', '#f5b04c'],
  ],
];

$pastaImagens = '../../../../assets/images/portfolio-assets/';
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Portfólio - Deu Bug! Consultoria Digital</title>
  <link rel="shortcut icon" href="../../../assets/images/DeuBug_favIcon.ico" type="image/x-icon">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Jersey+10&family=Nunito:wght@200..1000&family=Tiny5&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="portfolio.css">
</head>

<body>
  <!-- Filtro Liquid Glass -->
  <svg class="svg-filter" aria-hidden="true">
    <filter id="liquid-distortion" x="-20%" y="-20%" width="140%" height="140%">
      <feTurbulence type="fractalNoise" baseFrequency="0.009 0.009" numOctaves="2" seed="6" result="noise" />
      <feDisplacementMap in="SourceGraphic" in2="noise" scale="40" xChannelSelector="R" yChannelSelector="G" />
    </filter>
  </svg>

  <!-- Header -->
  <header class="site-header">
    <nav class="navbar liquid-glass">
      <div class="navbar__links">
        <a href="#portfolio" aria-current="page">PROJETOS</a>
        <a href="<?= $landing ?>#pacotes">PACOTES</a>
        <a href="<?= $landing ?>#sobre">SOBRE</a>
      </div>
      <a href="<?= $landing ?>" aria-label="Voltar para a página inicial"><img src="../../../assets/images/ReducedLogo_DeuBug.png" alt="Deu Bug Logo" class="navbar__logo"></a>
      <div class="navbar__spacer"></div>
    </nav>
    <button id="button-login" class="btn-glass liquid-glass" type="button">Login</button>
  </header>

  <!-- Modais de login e cadastro (mesmos formulários da landing page) -->
  <div class="modals<?= ($erroLogin || $erroCadastro) ? ' active' : '' ?>" data-active="<?= $aba ?>">
    <div class="switch-login">
      <button class="switch-button<?= $aba === 'login' ? ' active' : '' ?>" data-value="login" type="button">Login</button>
      <button class="switch-button<?= $aba === 'cadastro' ? ' active' : '' ?>" data-value="cadastro" type="button">Cadastro</button>
      <div class="switch-bg"></div>
    </div>

    <!-- Login -->
    <form class="modal-login" action="../../../actions/login.php" method="post">
      <?php if ($erroLogin): ?>
        <div class="form-erro" role="alert"><?= e($erroLogin) ?></div>
      <?php endif; ?>
      <label for="login-email">E-mail</label>
      <input id="login-email" type="email" name="email" required autocomplete="email">
      <label for="login-senha">Senha</label>
      <input id="login-senha" type="password" name="senha" required autocomplete="current-password">
      <a href="#" class="modal-login__forgot">Esqueci minha senha</a>
      <button class="modal-btn" type="submit">Login</button>
      <a href="#" class="google-btn" aria-label="Entrar com Google">
        <img src="../../../assets/images/Google Logo.svg" alt="">
      </a>
    </form>

    <!-- Cadastro -->
    <form class="modal-register" action="../../../actions/register.php" method="post">
      <?php if ($erroCadastro): ?>
        <div class="form-erro" role="alert"><?= e($erroCadastro) ?></div>
      <?php endif; ?>
      <div class="register-name">
        <div>
          <label for="cad-nome">Primeiro Nome</label>
          <input id="cad-nome" type="text" name="nome" maxlength="100" required autocomplete="given-name" value="<?= e($antigo['nome'] ?? '') ?>">
        </div>
        <div>
          <label for="cad-sobrenome">Sobrenome</label>
          <input id="cad-sobrenome" type="text" name="sobrenome" maxlength="100" required autocomplete="family-name" value="<?= e($antigo['sobrenome'] ?? '') ?>">
        </div>
      </div>
      <label for="cad-email">E-mail</label>
      <input id="cad-email" type="email" name="email" maxlength="255" required autocomplete="email" value="<?= e($antigo['email'] ?? '') ?>">
      <label for="cad-tel">Telefone</label>
      <input id="cad-tel" type="tel" name="telefone" maxlength="20" required autocomplete="tel" placeholder="(11) 91111-1111" value="<?= e($antigo['telefone'] ?? '') ?>">
      <hr class="modal-register__divider">
      <label for="cad-senha">Senha</label>
      <input id="cad-senha" type="password" name="senha" minlength="8" maxlength="72" required autocomplete="new-password">
      <label for="cad-senha2">Confirme sua senha</label>
      <input id="cad-senha2" type="password" name="confirmar_senha" minlength="8" maxlength="72" required autocomplete="new-password">
      <button class="modal-btn" type="submit">Cadastro</button>
    </form>
  </div>

  <main>
    <!-- Hero -->
    <section class="hero">
      <div class="hero__title">
        <h2>EXPLORE</h2>
        <h2 class="hero__title-animated">NOSSAS</h2>
        <h2 class="hero__title-hover">CRIAÇÕES</h2>
      </div>

      <a href="#portfolio" class="scrolldown" aria-label="Rolar para os projetos">
        <span class="chevrons">
          <span class="chevrondown"></span>
          <span class="chevrondown"></span>
        </span>
      </a>
    </section>

    <!-- Projetos -->
    <section id="portfolio" class="projects">
      <?php foreach ($projetos as $p): ?>
        <article class="project-row">

          <!-- Galeria: cada card é só a imagem -->
          <div class="ag">
            <?php foreach ($p['imagens'] as $i => $img): ?>
              <div class="ag-panel" tabindex="0">
                <span class="ag-media">
                  <img src="<?= e($pastaImagens . rawurlencode($img)) ?>"
                       alt="<?= e($p['nome']) ?> - imagem <?= $i + 1 ?>"
                       draggable="false">
                </span>
              </div>
            <?php endforeach; ?>
          </div>

          <!-- Informações do projeto -->
          <div class="project-info">
            <p class="project-info__label">PROJETO:</p>
            <p class="project-info__text"><?= e($p['nome']) ?></p>

            <p class="project-info__label">EQUIPE RESPONSÁVEL:</p>
            <?php foreach ($p['equipe'] as $membro): ?>
              <p class="project-info__text"><?= e($membro) ?></p>
            <?php endforeach; ?>

            <p class="project-info__label">SOBRE:</p>
            <p class="project-info__text"><?= e($p['sobre']) ?></p>

            <!-- Paleta: o hex aparece no hover -->
            <div class="palette">
              <?php foreach ($p['cores'] as $cor): ?>
                <div class="palette__color" style="background-color: <?= e($cor) ?>">
                  <span class="palette__hex"><?= e($cor) ?></span>
                </div>
              <?php endforeach; ?>
            </div>
          </div>

        </article>
      <?php endforeach; ?>
    </section>
  </main>

  <!-- Footer -->
  <footer class="footer">
    <div class="footer__top">
      <div class="footer__social">
        <a href="#"><img src="../../../assets/images/Github Icon.svg" alt="GitHub"></a>
        <a href="#"><img src="../../../assets/images/Instagram Icon.svg" alt="Instagram"></a>
        <a href="#"><img src="../../../assets/images/LinkedIn Icon.svg" alt="LinkedIn"></a>
        <a href="#"><img src="../../../assets/images/Whatsapp Icon.svg" alt="WhatsApp"></a>
      </div>

      <div class="newsletter">
        <h2>Assine nossa Newsletter!</h2>
        <label for="news-email">Fique por dentro de todas as novidades da Deu Bug!</label>
        <div class="newsletter__form">
          <input id="news-email" type="email" placeholder="Digite o seu email">
          <button type="button">Assinar</button>
        </div>
        <p>By subscribing you agree to with our <span>Privacy Policy</span></p>
      </div>
    </div>

    <hr class="footer__divider">

    <div class="footer__terms">
      <div class="footer__links">
        <a href="#">Privacy Policy</a>
        <a href="#">Terms of Service</a>
        <a href="#">Cookies Settings</a>
      </div>
      <p>© 2026 Deu Bug!. All rights reserved.</p>
    </div>
  </footer>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
  <script src="./portfolio.js"></script>
</body>

</html>
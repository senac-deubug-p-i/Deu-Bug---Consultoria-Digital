<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <link rel="shortcut icon" href="../../assets/images/DeuBug_favIcon.ico" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Jersey+10&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Tiny5&display=swap"
        rel="stylesheet">

    <title>Deu Bug! - Consultoria Digital</title>
</head>

<body>
    <!-- Filtro LiquidGlass -->
    <svg style="display:none">
        <filter id="liquid-distortion" x="-20%" y="-20%" width="140%" height="140%">
            <feTurbulence type="fractalNoise" baseFrequency="0.009 0.009" numOctaves="2" seed="6" result="noise" />
            <feDisplacementMap in="SourceGraphic" in2="noise" scale="80" xChannelSelector="R" yChannelSelector="G" />
        </filter>
    </svg>


    <!-- Header -->
    <section class="section-header">

        <!-- Navigation -->
        <header>
            <nav class="navbar-header">
                <div>
                    <a href="">PROJETOS</a>
                    <a href="">PACOTES</a>
                    <a href="">SOBRE</a>
                </div>
                <img src="../../assets/images/ReducedLogo_DeuBug.png" alt="Deu_Bug Logo">
                <div></div>
            </nav>
            <button id="button-login">Login</button>
            <button id="">temporario</button>
        </header>

        <div class="modals" data-active="login">
            <div class="switch-login">
                <button class="switch-button active" data-value="login">Login</button>
                <button class="switch-button" data-value="cadastro">Cadastro</button>
                <div class="switch-bg"></div>
            </div>

            <!-- Login Modal -->
            <div class="modal-login">
                <p>E-mail</p>
                <input type="text">
                <p>Senha</p>
                <input type="text">
                <a href="">Esqueci minha senha</a>
                <button>Login</button>
                <a href="" id="google-btn"><img src="../../assets/images/Google Logo.svg" alt=""></a>
            </div>

            <!-- Register Modal -->
            <div class="modal-register">
                <div class="register-name">
                    <div>
                        <p>Primeiro Nome</p>
                        <input type="text">
                    </div>
                    <div>
                        <p>Sobrenome</p>
                        <input type="text">
                    </div>
                </div>
                <p>E-mail</p>
                <input type="text">
                <p>Telefone</p>
                <input type="text">
                <hr style="border-width: 1px; background-color: #ffffff67; width: 100%; height: 1px; margin-top: 13px;">
                <p>Senha</p>
                <input type="text">
                <p>Confirme sua senha</p>
                <input type="text">

                <button>Cadastro</button>
            </div>
        </div>

        <!-- Função para trocar Modal de Login para o de Registro -->
        <script>
            const modals = document.querySelector('.modals');
            const toggle = modals.querySelector('.switch-login');
            const options = toggle.querySelectorAll('.switch-button');

            options.forEach((btn) => {
            btn.addEventListener('click', () => {
                const value = btn.dataset.value;
                modals.dataset.active = value; // muda no .modals, não no .switch-login

                options.forEach((b) => b.classList.remove('active'));
                btn.classList.add('active');
            });
            });
        </script>

        <!-- Função para esconder e mostrar o modal -->
        <script>
            const loginBtn = document.getElementById('button-login');
            const modal = document.querySelector('.modals');

            loginBtn.addEventListener('click', () => {
            modal.classList.toggle('active');
            });

            document.addEventListener('click', (e) => {
            const clickedInside = modals.contains(e.target) || loginBtn.contains(e.target);
            if (!clickedInside && modals.classList.contains('active')) {
                modals.classList.remove('active');
            }
            });
        </script>

        <div class="cta-section">
            <div>
                <div class="hero-header-title">
                    <h2>CRIE.</h2>
                    <h2>CONECTE.</h2>
                    <h2>EVOLUA.</h2>
                </div>
                <div class="button-swap">
                    <button>Saiba Mais</button>
                    <button>Contato</button>
                </div>
            </div>
            <video src="../../assets/videos/bug-avatar-rotate.webm" autoplay loop muted></video>
        </div>
    </section>

    <section class="data-section">
        <div>
            <h3>+150</h3>
            <p>Projetos Desenvolvidos por nossa Equipe</p>
        </div>
        <div>
            <h3>+150</h3>
            <p>Projetos Desenvolvidos por nossa Equipe</p>
        </div>
        <div>
            <h3>+150</h3>
            <p>Projetos Desenvolvidos por nossa Equipe</p>
        </div>
        <div>
            <h3>+150</h3>
            <p>Projetos Desenvolvidos por nossa Equipe</p>
        </div>
    </section>

    <section class="about-us">
        <h2>Deu Bug! E agora? A gente resolve.</h2>
        <hr style="border: 1px solid #7B4BB3; width: 500px; margin-top: 8px;">

        <div>
            <p>Somos uma consultoria digital que une tecnologia, design e criatividade para ajudar pequenas e médias empresas a terem uma presença digital profissional, funcional e autêntica.<br/>
                Do briefing à entrega, criamos soluções que fazem sentido para cada negócio.</p>

            <div class="blocks-wrapper">
                <div>
                    <span class="aboutcard1">DESENVOLVIMENTO</span>
                    <span class="aboutcard2">SITES E SOLUÇÕES DIGITAIS RESPONSIVAS E OTIMIZADAS.</span>
                </div>
                <div>
                    <span class="aboutcard1">DESIGN & IDENTIDADE</span>
                    <span class="aboutcard2">INTERFACES E IDENTIDADES VISUAIS COM PERSONALIDADE.</span>
                </div>
                <div>
                    <span class="aboutcard1">CONSULTORIA DIGITAL</span>
                    <span class="aboutcard2">INTERFACES E IDENTIDADES VISUAIS COM PERSONALIDADE.</span>
                </div>
                <div>
                    <span class="aboutcard1">GESTÃO DE PROJETOS</span>
                    <span class="aboutcard2">SITES E SOLUÇÕES DIGITAIS RESPONSIVAS E OTIMIZADAS.</span>
                </div>
            </div>
        </div>
    </section>

    <script>
        const cards = document.querySelectorAll('.blocks-wrapper > div');
        const maxTilt = 10;

        cards.forEach((card) => {
            card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            const rotateY = ((x / rect.width) - 0.5) * maxTilt * 2;
            const rotateX = -((y / rect.height) - 0.5) * maxTilt * 2;

            card.classList.remove('reset');
            card.style.transform =
                `perspective(800px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale(1.03)`;
            });

            card.addEventListener('mouseleave', () => {
            card.classList.add('reset');
            card.style.transform =
                'perspective(800px) rotateX(0deg) rotateY(0deg) scale(1)';
            });
        });
    </script>

    <section class="services">
        <h2>PACOTES & SERVIÇOS</h2>
        <div class="packages">
            <div>
                <h2>Starter</h2>
                <label>Identidade Visual</label>

                <h3>R$ 500</h3>
                <button>Comprar</button>
                <ul>
                    <li>Logomarca</li>
                    <li>Paleta de Cores</li>
                    <li>Mockup</li>
                </ul>
            </div>

            <div>
                <h2>Intermediate</h2>
                <label>Site Estático</label>

                <h3>R$ 2.000</h3>
                <button>Comprar</button>
                <ul>
                    <li>Logomarca</li>
                    <li>Paleta de Cores</li>
                    <li>Mockup</li>
                </ul>
            </div>

            <div>
                <h2>Premium</h2>
                <label>Site Dinâmico</label>

                <h3>R$ 3.500</h3>
                <button>Comprar</button>
                <ul>
                    <li>Logomarca</li>
                    <li>Paleta de Cores</li>
                    <li>Mockup</li>
                </ul>
            </div>
        </div>
        <div class="gradient"></div>
    </section>

    <footer>
        <div class="news-swap">
            <div class="social">
                <a href=""><img src="../../assets/images/Github Icon.svg" alt="GitHub Icon"></a>
                <a href=""><img src="../../assets/images/Instagram Icon.svg" alt="Instagram Logo"></a>
                <a href=""><img src="../../assets/images/LinkedIn Icon.svg" alt="LinkedIn Logo"></a>
                <a href=""><img src="../../assets/images/Whatsapp Icon.svg" alt="Whatsapp Logo"></a>
            </div>
            <div class="newsletter">
                <h2>Assine nossa Newsletter!</h2>
                <label>Fique por dentro de todas as novidades da Deu Bug!</label>
                <div>
                    <input type="text" placeholder="Digite o seu email">
                    <button>Assinar</button>
                </div>
                <p>By subscribing you agree to with our <span>Privacy Policy</span></p>
            </div>
        </div>

        <hr style="background-color: #7B4BB3; width: 100%; height: 1px; margin: 40px 0px">

        <div class="terms">
            <div>
                <a href="">Privacy Policy</a>
                <a href="">Terms of Service</a>
                <a href="">Cookies Settings</a>
            </div>

            <p>© 2026 Deu Bug!. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>
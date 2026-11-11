<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="index.css">
        <link rel="shortcut icon" href="../../../assets/images/DeuBug_favIcon.ico" type="image/x-icon">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Jersey+10&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Tiny5&display=swap"
            rel="stylesheet">

        <title>Deu Bug! - Consultoria Digital</title>
    </head>
    <body>
        <!-- Inserção do Header -->
        <?php
            require __DIR__ . '/../../../includes/client-header.php';
        ?>

        <section class="hero-header">
            <div class="hero-title">
                <h3>LandingPage</h3>
                <h2>Barbearia Luck Shot</h2>
                <div class="project-status">
                    <div></div>
                    <p>Em Desenvolvimento</p>
                </div>
            </div>

            <div class="hero-contact">
                <button>Falar sobre este projeto</button>
                <button style="background-color: transparent;">Ver arquivos</button>
            </div>
        </section>

        <section class="progress-status">
            <div class="data-progress">
                <div class="progress-percent">
                    <div>
                        <h3>Progresso geral</h3>
                        <h2>62%</h2>
                    </div>
                    <div class="progress-bar">
                        <div></div>
                    </div>
                </div>

                <div class="data-info">
                    <p>Início</p>
                    <h3>12 de Setembro</h3>
                </div>
                
                <div class="data-info">
                    <p>Prazo Estimado</p>
                    <h3>14 de Setembro</h3>
                </div>

                <div class="data-info">
                    <p>Responsável</p>
                    <h3>Vanessa Balbino</h3>
                </div>
            </div>

            <div class="data-status">
                <div class="progress-stage">
                    <div></div>
                </div>
                <div class="data-stage">
                    <div></div>
                    <h3>Briefing</h3>
                    <p>12 a 20 set</p>
                </div>

                <div class="data-stage">
                    <div></div>
                    <h3>Design</h3>
                    <p>12 a 20 set</p>
                </div>

                <div class="data-stage">
                    <div></div>
                    <h3>Desenvolvimento</h3>
                    <p>12 a 20 set</p>
                </div>

                <div class="data-stage">
                    <div></div>
                    <h3>Revisão</h3>
                    <p>12 a 20 set</p>
                </div>

                <div class="data-stage">
                    <div></div>
                    <h3>Publicação</h3>
                    <p>12 a 20 set</p>
                </div>
            </div>
        </section>

        <section class="stage-previews">
            <section class="left-stages">

                <div class="to-approve">
                    <h2>Para aprovar</h2>
                    <img src="../../../assets/images/design-model.png" alt="Model-Design">
                    <p>Página de produtos, versão 3. Enviada por Lucas Gallo hoje às 10:42</p>
                    <div>
                        <button>Aprovar</button>
                        <button>Ver arquivos</button>
                    </div>
                </div>

                <div class="project-team">
                    <h2>Equipe do Projeto</h2>

                    <div class="project-partner">
                        <div>
                            <img src="" alt="Partner-Photo">
                            <div>
                                <h3>Lucas Gallo</h3>
                                <p>Gestor do Projeto</p>
                            </div>
                        </div>
                        <button>Mensagem</button>
                    </div>

                    <div class="project-partner">
                        <div>
                            <img src="" alt="Partner-Photo">
                            <div>
                                <h3>Lucas Gallo</h3>
                                <p>Gestor do Projeto</p>
                            </div>
                        </div>
                        <button>Mensagem</button>
                    </div>

                    <div class="project-partner">
                        <div>
                            <img src="" alt="Partner-Photo">
                            <div>
                                <h3>Lucas Gallo</h3>
                                <p>Gestor do Projeto</p>
                            </div>
                        </div>
                        <button>Mensagem</button>
                    </div>

                    <div class="project-partner">
                        <div>
                            <img src="" alt="Partner-Photo">
                            <div>
                                <h3>Lucas Gallo</h3>
                                <p>Gestor do Projeto</p>
                            </div>
                        </div>
                        <button>Mensagem</button>
                    </div>
                </div>

                <div class="update-history">
                    <h2>Histórico de Atualizações</h2>

                    <div class="cards-grid">
                        <div class="update-card">
                            <div class="status-history"></div>
                            <div>
                                <h3>Layout da home enviado para aprovação</h3>
                                <p>Hoje, 10:42 - Lucas Gallo</p>
                            </div>
                        </div>

                        <div class="update-card">
                            <div class="status-history"></div>
                            <div>
                                <h3>Layout da home enviado para aprovação</h3>
                                <p>Hoje, 10:42 - Lucas Gallo</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="right-stages">
                <div class="approved-deliveries">
                    <h2>Entregas Aprovada</h2>

                    <div class="deliveries-grid">

                        <div class="deliveries-card">
                            <div>
                                <h3>Layout da home v3</h3>
                                <p>Aprovado em 14 out</p>
                            </div>
    
                            <button>Baixar</button>
                        </div>

                    </div>
                </div>

                <div class="development-stage">
                    <div class="development-title">
                        <h2>3. Desenvolvimento</h2>

                        <div class="development-status">
                            <div></div>
                            <p>Em Desenvolvimento</p>
                        </div>
                    </div>

                    <div class="development-grid">
                        <div class="development-processes">
                            <div>
                                <div class="development-status-ball"></div>
                                <h2>Estrutura da loja e menu</h2>
                            </div>

                            <h3>Feito</h3>
                        </div>
                    </div>
                </div>

                <div class="design-stage">
                    <div class="design-title">
                        <h2>2. Design</h2>
                        <div class="design-status">
                            <div></div>
                            <p>Aprovado em 14 out</p>
                        </div>
                    </div>

                    <p>Layout da home, página de produtos e carrinho com paleta da marca.</p>
                </div>

                <div class="briefing-stage">
                    <div class="briefing-title">
                        <h2>1. Briefing</h2>
                        <div class="briefing-status">
                            <div></div>
                            <p>Aprovado em 14 out</p>
                        </div>
                    </div>

                    <p>Objetivos da loja, produtos, público e refêrencia definidos juntos com você.</p>
                </div>

                <div class="review-stage">
                    <div class="review-title">
                        <h2>4. Revisão e 5. Publicação</h2>
                    </div>

                    <p>Começam depois do desenvolvimento. Você revisa a loja pronta e nós publicamos no seu domínio.</p>
                </div>
            </section>
        </section>
    </body>
</html>
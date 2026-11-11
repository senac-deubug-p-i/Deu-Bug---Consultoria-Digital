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
                <h3>Barbearia Lucky Shot - Domingo, 18 de Outubro</h3>
                <h2>Olá, Eduardo!</h2>
                <p>Seus projetos estão andando bem. Tem 2 coisas esperando por você.</p>
            </div>

            <div class="hero-contact">
                <button>
                    <img src="../../../assets/images/chat-message-icon.svg" alt="">
                    Falar com a equipe
                </button>
                <button style="background-color: transparent;">Abrir Solicitação</button>
            </div>
        </section>

        <section class="data-boxes">
            <div>
                <div>
                    <h3>Projetos Ativos</h3>
                    <h2>2</h2>
                </div>

                <p>1 loja virtual e 1 site institucional</p>
            </div>

            <div>
                <div>
                    <h3>Previsão da próxima entrega</h3>
                    <h2>24 out</h2>
                </div>

                <p>Layout da página de produtos</p>
            </div>

            <div>
                <div>
                    <h3>Mensagens não lidas</h3>
                    <h2>2</h2>
                </div>

                <p>Ler agora</p>
            </div>

            <div style="background-color: #7B4BB3; border-color: #FFF;">
                <div>
                    <h3>Precisa da sua atenção</h3>
                    <h2>2</h2>
                </div>

                <p>Aprovar layout - Enviar fotos dos produtos</p>
            </div>
        </section>

        <section class="info-boxes">
            <div class="activity">
                <h2>Atividade recente</h2>

                <div class="infosscreen">
                    <div class="info-activity">
                        <div class="status-activity"></div>
                        <div>
                            <h3>Layout da home enviado para aprovação</h3>
                            <p>Hoje, 10:42 - Lucas Gallo</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="requests">
                <h2>Pendências</h2>

                <div class="pendencys">
                    <div class="pendency-box">
                        <div>
                            <h3>Aprovar layout de produtos</h3>
                            <p>Barbearia Lucky Shot - 22 out</p>
                        </div>
                        <button>Aprovar</button>
                    </div>
                </div>
            </div>

            <div class="payments">
                <h2>Faturas e pagamentos</h2>

                <div class="next-payment">
                    <h3>Próximo vencimento</h3>
                    <h2>R$ 1250,00</h2>
                    <p>Parcela 3 de 4 - vence em 25 de outubro</p>
                </div>

                <div class="others-payment">
                    <p>Parcela 2 - 25 set</p>

                    <div class="status-payment">
                        <h3>Paga</h3>
                    </div>
                </div>

                <div class="button-switch-payment">
                    <button>Ver Boleto</button>
                    <button style="background-color: transparent;">Recibos</button>
                </div>
            </div>
        </section>
    </body>
</html>
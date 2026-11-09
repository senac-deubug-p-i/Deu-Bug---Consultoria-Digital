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
        <header>
            <div class="logoheader">
                <img src="../../../assets/images/WhiteLogo_DeuBug.svg" alt="DeuBug-Logo">
                <h2>Deu Bug!</h2>
            </div>

            <nav>
                <a href="../client-area/index.php">Visão Geral</a>
                <a href="../projects-area/index.php">Meus Projetos</a>
                <a href="../support-area/index.php">Suporte</a>
            </nav>

            <div class="user-group">
                <section class="notification-group">
                    <div class="bell-group">
                        <h2>2</h2>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                            <path d="M320 64C306.7 64 296 74.7 296 88L296 97.7C214.6 109.3 152 179.4 152 264L152 278.5C152 316.2 142 353.2 123 385.8L101.1 423.2C97.8 429 96 435.5 96 442.2C96 463.1 112.9 480 133.8 480L506.2 480C527.1 480 544 463.1 544 442.2C544 435.5 542.2 428.9 538.9 423.2L517 385.7C498 353.1 488 316.1 488 278.4L488 263.9C488 179.3 425.4 109.2 344 97.6L344 87.9C344 74.6 333.3 63.9 320 63.9zM488.4 432L151.5 432L164.4 409.9C187.7 370 200 324.6 200 278.5L200 264C200 197.7 253.7 144 320 144C386.3 144 440 197.7 440 264L440 278.5C440 324.7 452.3 370 475.5 409.9L488.4 432zM252.1 528C262 556 288.7 576 320 576C351.3 576 378 556 387.9 528L252.1 528z"/>
                        </svg>
                    </div>

                    <div class="notifications-screen">

                    </div>
                </section>

                <section class="user-section">
                    <h2>EI</h2>
                    <div>
                        <h3>Eduardo Inocencio</h3>
                        <p>Plano Gold</p>
                    </div>
                </section>

                <button>Sair</button>
            </div>
        </header>

        <section class="support-screen">
            <div class="support-title-screen">
                <h2>Fale com a equipe</h2>
                <p>Tire dúvidas, peça ajustes ou abra uma solicitação. A gente responde rápido.</p>
            </div>

            <div class="support-modals">

                <div class="chats-request">
                    <div class="support-chats">
                        <h2>Conversas</h2>
                        
                        <div class="chats-grid">

                            <div class="chat-card">
                                <img src="" alt="user-icon">
                                <h3>Barbearia Luck Shot</h3>
                            </div>
                        </div>
                    </div>

                    <div class="open-request">
                        <h2>Abrir solicitação</h2>

                        <div class="input-request">
                            <h4>Assunto</h4>
                            <input type="text" placeholder="Ex:.. Trocar o texto da página inicial">
                        </div>

                        <div class="input-request">
                            <h4>Projeto Relacionado</h4>
                            <input type="text" placeholder="Dropdown-need to make">
                        </div>

                        <div class="input-request">
                            <h4>Descrição</h4>
                            <textarea name="" id="" placeholder="Conte o que você precisa"></textarea>
                        </div>

                        <button id="request-archive-btn">Anexar arquivo ou imagem</button>
                        <button>Enviar Solicitação</button>
                    </div>
                </div>

                <div class="contact-modals">
                    <div class="chat-modal">
                        <div class="chat-modal-header">
                            <img src="" alt="user-image">
                            <h2>Barbearia Luck Shot</h2>
                        </div>

                        <div class="chat-modal-messages">
                            <div class="left-message">
                                <h3>Lucas Gallo - Gestor</h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint, id perspiciatis eius voluptatem ratione cum magni fugit laudantium vitae iusto optio facilis quidem? Ipsa excepturi ut temporibus modi et mollitia.</p>
                            </div>

                            <div class="right-message">
                                <h3>Lucas Gallo - Gestor</h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint, id perspiciatis eius voluptatem ratione cum magni fugit laudantium vitae iusto optio facilis quidem? Ipsa excepturi ut temporibus modi et mollitia.</p>
                            </div>

                        </div>

                        <div class="chat-modal-inputs">
                            <button id="btn-archive"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M288.6 76.8C344.8 20.6 436 20.6 492.2 76.8C548.4 133 548.4 224.2 492.2 280.4L328.2 444.4C293.8 478.8 238.1 478.8 203.7 444.4C169.3 410 169.3 354.3 203.7 319.9L356.5 167.3C369 154.8 389.3 154.8 401.8 167.3C414.3 179.8 414.3 200.1 401.8 212.6L249 365.3C239.6 374.7 239.6 389.9 249 399.2C258.4 408.5 273.6 408.6 282.9 399.2L446.9 235.2C478.1 204 478.1 153.3 446.9 122.1C415.7 90.9 365 90.9 333.8 122.1L169.8 286.1C116.7 339.2 116.7 425.3 169.8 478.4C222.9 531.5 309 531.5 362.1 478.4L492.3 348.3C504.8 335.8 525.1 335.8 537.6 348.3C550.1 360.8 550.1 381.1 537.6 393.6L407.4 523.6C329.3 601.7 202.7 601.7 124.6 523.6C46.5 445.5 46.5 318.9 124.6 240.8L288.6 76.8z"/></svg></button>
                            <input type="text" placeholder="Digite sua mensagem">
                            <button>Enviar</button>
                        </div>
                    </div>

                    <div class="contact-card">
                        <h3>Prefere outro canal?</h3>
                        <div>
                            <div>
                                <img src="../../../assets/images/basil_whatsapp-outline.svg" alt="whatsapp-logo">
                                <p>(11) 90000-0000</p>
                            </div>
                            <div>
                                <img src="../../../assets/images/clarity_email-line.svg" alt="email-logo">
                                <p>ola@gmail.com</p>
                            </div>
                        </div>
                        <hr style="border: 1px solid #ffffff62; width: 60%; border-radius: 24px;">
                        <p>Atendimento de segunda a sexta, das 9h às 18h. Respondemos em até 1 dia útil.</p>
                    </div>
                </div>
            </div>
        </section>

    </body>
</html>
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
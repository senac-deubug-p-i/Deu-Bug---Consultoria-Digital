DROP DATABASE IF EXISTS deubug;
CREATE DATABASE deubug CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE deubug;

CREATE TABLE usuario(
    usuario_id INT PRIMARY KEY AUTO_INCREMENT,
    usuario_nome VARCHAR(255) NOT NULL,
    usuario_email VARCHAR(255) NOT NULL UNIQUE,
    usuario_senha VARCHAR(255) NOT NULL,
    usuario_telefone VARCHAR(30) NOT NULL,
    usuario_tipo ENUM('cliente', 'admin') NOT NULL DEFAULT 'cliente',
    usuario_empresa VARCHAR(150) NULL,
    usuario_cargo VARCHAR(60) NULL,
    usuario_ultimo_acesso DATETIME NULL,
    usuario_notif_visto_em DATETIME NULL,
    usuario_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS solicitacao_projeto(
    solicitacao_id              INT PRIMARY KEY AUTO_INCREMENT,
    usuario_id                  INT NOT NULL,
    solicitacao_empresa         VARCHAR(150) NOT NULL,
    solicitacao_tipo            VARCHAR(30)  NOT NULL,
    solicitacao_descricao       TEXT         NOT NULL,
    solicitacao_status          ENUM('pendente', 'em_contato', 'aprovada', 'recusada') NOT NULL DEFAULT 'pendente',
    solicitacao_previsao_contato DATE        NOT NULL,
    solicitacao_responsavel_id  INT NULL,
    solicitacao_prioridade      ENUM('baixa', 'normal', 'alta') NOT NULL DEFAULT 'normal',
    solicitacao_criacao         TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuario (usuario_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (solicitacao_responsavel_id) REFERENCES usuario (usuario_id) ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE conversa(
    conversa_id INT PRIMARY KEY AUTO_INCREMENT,
    conversa_horacriacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    conversa_atualizacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    conversa_status ENUM ('ativa', 'arquivada', 'finalizada') DEFAULT 'ativa',
    usuario_id INT NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuario (usuario_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE mensagem(
    mensagem_id INT PRIMARY KEY AUTO_INCREMENT,
    mensagem_remetente ENUM ('IA', 'Usuario'),
    mensagem_conteudo TEXT,
    mensagem_horaenvio TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    conversa_id INT NOT NULL,
    FOREIGN KEY (conversa_id) REFERENCES conversa (conversa_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE servico(
    servico_id INT PRIMARY KEY AUTO_INCREMENT,
    servico_nome VARCHAR(255) NOT NULL,
    servico_descricao TEXT,
    servico_link TEXT,
    servico_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE imagem(
    imagem_id INT PRIMARY KEY AUTO_INCREMENT,
    imagem_caminho VARCHAR(255) NOT NULL,
    servico_id INT NOT NULL,
    FOREIGN KEY (servico_id) REFERENCES servico (servico_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE ferramenta(
    ferramenta_id INT PRIMARY KEY AUTO_INCREMENT,
    ferramenta_nome VARCHAR(255) NOT NULL,
    ferramenta_icone VARCHAR(255) NOT NULL
);

CREATE TABLE servico_ferramenta(
    servico_id INT NOT NULL,
    ferramenta_id INT NOT NULL,
    PRIMARY KEY (servico_id, ferramenta_id),
    FOREIGN KEY (servico_id) REFERENCES servico (servico_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (ferramenta_id) REFERENCES ferramenta (ferramenta_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE categoria(
    categoria_id INT PRIMARY KEY AUTO_INCREMENT,
    categoria_nome VARCHAR(255) NOT NULL
);

CREATE TABLE categoria_servico(
    servico_id INT NOT NULL,
    categoria_id INT NOT NULL,
    PRIMARY KEY (servico_id, categoria_id),
    FOREIGN KEY (servico_id) REFERENCES servico (servico_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (categoria_id) REFERENCES categoria (categoria_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE plano (
    plano_id INT AUTO_INCREMENT PRIMARY KEY,
    plano_nome VARCHAR(50) NOT NULL,
    plano_descricao TEXT,
    plano_preco DECIMAL(10,2) NOT NULL,
    plano_periodo ENUM('mensal', 'anual') DEFAULT 'mensal',
    plano_ativo BOOLEAN DEFAULT TRUE
);

CREATE TABLE assinatura (
    assinatura_id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    plano_id INT NOT NULL,
    assinatura_datainicio DATE NOT NULL,
    assinatura_datafim DATE,
    assinatura_status ENUM('ativa', 'cancelada', 'expirada', 'inadimplente') DEFAULT 'ativa',
    FOREIGN KEY (usuario_id) REFERENCES usuario(usuario_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (plano_id) REFERENCES plano(plano_id) ON DELETE CASCADE ON UPDATE CASCADE
);

DELIMITER $$

CREATE TRIGGER trg_assinatura_unica_ativa_insert
BEFORE INSERT ON assinatura
FOR EACH ROW
BEGIN
    IF NEW.assinatura_status = 'ativa' AND EXISTS (
        SELECT 1 FROM assinatura
        WHERE usuario_id = NEW.usuario_id
          AND assinatura_status = 'ativa'
    ) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Usuário já possui uma assinatura ativa';
    END IF;
END$$

CREATE TRIGGER trg_assinatura_unica_ativa_update
BEFORE UPDATE ON assinatura
FOR EACH ROW
BEGIN
    IF NEW.assinatura_status = 'ativa' AND EXISTS (
        SELECT 1 FROM assinatura
        WHERE usuario_id = NEW.usuario_id
          AND assinatura_status = 'ativa'
          AND assinatura_id != NEW.assinatura_id
    ) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Usuário já possui uma assinatura ativa';
    END IF;
END$$

DELIMITER ;

-- =====================================================================
-- ÁREA ADMIN: projetos, aprovações, tarefas, arquivos, notas e conversa
-- (o módulo de pagamentos/planos foi removido da interface; as tabelas
--  plano/assinatura continuam no banco, mas nenhuma tela as usa mais)
-- =====================================================================

-- Projeto de verdade (nasce de uma solicitação aprovada ou é criado pelo admin)
CREATE TABLE IF NOT EXISTS projeto(
    projeto_id          INT PRIMARY KEY AUTO_INCREMENT,
    usuario_id          INT NOT NULL,                       -- cliente dono do projeto
    solicitacao_id      INT NULL,                           -- solicitação que originou (opcional)
    responsavel_id      INT NULL,                           -- membro da equipe (usuario_tipo = 'admin')
    projeto_titulo      VARCHAR(150) NOT NULL,
    projeto_empresa     VARCHAR(150) NOT NULL,
    projeto_tipo        VARCHAR(30)  NULL,
    projeto_etapa       TINYINT NOT NULL DEFAULT 0,         -- 0 Briefing, 1 Design, 2 Desenvolvimento, 3 Revisão, 4 Publicado
    projeto_progresso   TINYINT NOT NULL DEFAULT 0,         -- 0 a 100
    projeto_prazo       DATE NULL,
    projeto_pausado     TINYINT(1) NOT NULL DEFAULT 0,
    projeto_tag         VARCHAR(60) NULL,                   -- ex.: "Fotos pendentes"
    projeto_tag_estilo  VARCHAR(10) NULL,                   -- warn | red | org | ok
    projeto_inicio      DATE NOT NULL,
    projeto_publicado_em DATE NULL,
    projeto_criacao     TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id)     REFERENCES usuario (usuario_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (responsavel_id) REFERENCES usuario (usuario_id) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (solicitacao_id) REFERENCES solicitacao_projeto (solicitacao_id) ON DELETE SET NULL ON UPDATE CASCADE
);

-- Log de atualizações da equipe (alimenta o dashboard do admin e a "Atividade recente" do cliente)
CREATE TABLE IF NOT EXISTS projeto_atualizacao(
    atualizacao_id       INT PRIMARY KEY AUTO_INCREMENT,
    projeto_id           INT NOT NULL,
    autor_id             INT NULL,
    atualizacao_titulo   VARCHAR(200) NOT NULL,
    atualizacao_mensagem TEXT NULL,
    atualizacao_visivel  TINYINT(1) NOT NULL DEFAULT 1,     -- 1 = o cliente vê; 0 = nota interna
    atualizacao_cor      VARCHAR(10) NOT NULL DEFAULT 'blue', -- blue | green | yellow
    atualizacao_criacao  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (projeto_id) REFERENCES projeto (projeto_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (autor_id)   REFERENCES usuario (usuario_id) ON DELETE SET NULL ON UPDATE CASCADE
);

-- Itens que precisam do OK do cliente ("Pendências" no painel dele)
CREATE TABLE IF NOT EXISTS projeto_aprovacao(
    aprovacao_id          INT PRIMARY KEY AUTO_INCREMENT,
    projeto_id            INT NOT NULL,
    aprovacao_titulo      VARCHAR(200) NOT NULL,
    aprovacao_descricao   TEXT NULL,
    aprovacao_status      ENUM('pendente', 'aprovada') NOT NULL DEFAULT 'pendente',
    aprovacao_prazo       DATE NULL,
    aprovacao_lembrete_em DATETIME NULL,
    aprovacao_resposta_em DATETIME NULL,
    aprovacao_criacao     TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (projeto_id) REFERENCES projeto (projeto_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS projeto_tarefa(
    tarefa_id        INT PRIMARY KEY AUTO_INCREMENT,
    projeto_id       INT NOT NULL,
    responsavel_id   INT NULL,
    tarefa_titulo    VARCHAR(200) NOT NULL,
    tarefa_concluida TINYINT(1) NOT NULL DEFAULT 0,
    tarefa_criacao   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (projeto_id)     REFERENCES projeto (projeto_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (responsavel_id) REFERENCES usuario (usuario_id) ON DELETE SET NULL ON UPDATE CASCADE
);

-- Arquivos enviados pela equipe ($_FILES). O arquivo fica em uploads/projetos/, fora do acesso público.
CREATE TABLE IF NOT EXISTS projeto_arquivo(
    arquivo_id            INT PRIMARY KEY AUTO_INCREMENT,
    projeto_id            INT NOT NULL,
    enviado_por           INT NULL,
    arquivo_nome_original VARCHAR(255) NOT NULL,
    arquivo_nome_salvo    VARCHAR(100) NOT NULL,
    arquivo_tamanho       INT NOT NULL,
    arquivo_criacao       TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (projeto_id)  REFERENCES projeto (projeto_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (enviado_por) REFERENCES usuario (usuario_id) ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS cliente_nota(
    nota_id       INT PRIMARY KEY AUTO_INCREMENT,
    usuario_id    INT NOT NULL,                              -- cliente
    autor_id      INT NULL,
    nota_texto    VARCHAR(500) NOT NULL,
    nota_criacao  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuario (usuario_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (autor_id)   REFERENCES usuario (usuario_id) ON DELETE SET NULL ON UPDATE CASCADE
);

-- Respostas da equipe (e notas internas) em cada solicitação de projeto
CREATE TABLE IF NOT EXISTS solicitacao_mensagem(
    mensagem_id     INT PRIMARY KEY AUTO_INCREMENT,
    solicitacao_id  INT NOT NULL,
    autor_id        INT NULL,
    msg_texto       TEXT NOT NULL,
    msg_interna     TINYINT(1) NOT NULL DEFAULT 0,           -- 1 = nota interna (cliente nunca vê)
    msg_criacao     TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (solicitacao_id) REFERENCES solicitacao_projeto (solicitacao_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (autor_id)       REFERENCES usuario (usuario_id) ON DELETE SET NULL ON UPDATE CASCADE
);

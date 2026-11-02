DROP DATABASE IF EXISTS deubug;
CREATE DATABASE deubug CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE deubug;

CREATE TABLE usuario(
    usuario_id INT PRIMARY KEY AUTO_INCREMENT,
    usuario_nome VARCHAR(255) NOT NULL,
    usuario_email VARCHAR(255) NOT NULL UNIQUE,
    usuario_senha VARCHAR(255) NOT NULL,
    usuario_telefone VARCHAR(30) NOT NULL,
    usuario_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
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

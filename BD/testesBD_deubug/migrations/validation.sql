USE deubug;

DROP PROCEDURE IF EXISTS sp_validacao;

DELIMITER $$

CREATE PROCEDURE sp_validacao()
BEGIN
    DECLARE v_qtd INT;

    -- T1: trigger de INSERT bloqueia segunda assinatura ativa
    BEGIN
        DECLARE EXIT HANDLER FOR SQLSTATE '45000'
            SELECT 'T1 OK - insert de 2ª assinatura ativa bloqueado' AS resultado;
        INSERT INTO assinatura (usuario_id, plano_id, assinatura_datainicio, assinatura_status)
        VALUES (1, 2, CURDATE(), 'ativa');
        SELECT 'T1 FALHOU - inseriu assinatura ativa duplicada' AS resultado;
    END;

    -- T2: trigger de UPDATE bloqueia reativar assinatura quando já existe uma ativa
    BEGIN
        DECLARE EXIT HANDLER FOR SQLSTATE '45000'
            SELECT 'T2 OK - update para ativa bloqueado' AS resultado;
        UPDATE assinatura SET assinatura_status = 'ativa'
        WHERE usuario_id = 1 AND assinatura_status = 'expirada' LIMIT 1;
        SELECT 'T2 FALHOU - update permitiu duas ativas' AS resultado;
    END;

    -- T3: assinatura não ativa pode ser inserida normalmente
    START TRANSACTION;
    INSERT INTO assinatura (usuario_id, plano_id, assinatura_datainicio, assinatura_status)
    VALUES (1, 1, CURDATE(), 'cancelada');
    SELECT 'T3 OK - assinatura cancelada inserida sem erro' AS resultado;
    ROLLBACK;

    -- T4: e-mail duplicado viola UNIQUE (erro 1062)
    BEGIN
        DECLARE EXIT HANDLER FOR 1062
            SELECT 'T4 OK - e-mail duplicado bloqueado' AS resultado;
        INSERT INTO usuario (usuario_nome, usuario_email, usuario_senha, usuario_telefone)
        VALUES ('Teste', 'ana.souza@email.com', 'x', '000');
        SELECT 'T4 FALHOU - e-mail duplicado aceito' AS resultado;
    END;

    -- T5: FK impede conversa de usuário inexistente (erro 1452)
    BEGIN
        DECLARE EXIT HANDLER FOR 1452
            SELECT 'T5 OK - FK de conversa->usuario protegida' AS resultado;
        INSERT INTO conversa (usuario_id) VALUES (9999);
        SELECT 'T5 FALHOU - conversa órfã aceita' AS resultado;
    END;

    -- T6: NOT NULL em campo obrigatório (erro 1048)
    BEGIN
        DECLARE EXIT HANDLER FOR 1048
            SELECT 'T6 OK - NOT NULL em usuario_nome respeitado' AS resultado;
        INSERT INTO usuario (usuario_nome, usuario_email, usuario_senha, usuario_telefone)
        VALUES (NULL, 'nulo@email.com', 'x', '000');
        SELECT 'T6 FALHOU - NULL aceito em campo obrigatório' AS resultado;
    END;

    -- T7: ENUM inválido é rejeitado (erro 1265 / 1366 conforme sql_mode)
    BEGIN
        DECLARE EXIT HANDLER FOR 1265, 1366
            SELECT 'T7 OK - valor inválido de ENUM rejeitado' AS resultado;
        INSERT INTO conversa (conversa_status, usuario_id) VALUES ('invalido', 1);
        SELECT 'T7 FALHOU - ENUM inválido aceito' AS resultado;
    END;

    -- T8: ON DELETE CASCADE usuario -> conversa -> mensagem
    START TRANSACTION;
    INSERT INTO usuario (usuario_nome, usuario_email, usuario_senha, usuario_telefone)
    VALUES ('Temp', 'temp@email.com', 'x', '000');
    SET @uid = LAST_INSERT_ID();
    INSERT INTO conversa (usuario_id) VALUES (@uid);
    SET @cid = LAST_INSERT_ID();
    INSERT INTO mensagem (mensagem_remetente, mensagem_conteudo, conversa_id)
    VALUES ('Usuario', 'teste cascade', @cid);
    DELETE FROM usuario WHERE usuario_id = @uid;
    SELECT COUNT(*) INTO v_qtd FROM mensagem WHERE conversa_id = @cid;
    SELECT IF(v_qtd = 0, 'T8 OK - cascade apagou conversas e mensagens',
                         'T8 FALHOU - sobraram mensagens órfãs') AS resultado;
    ROLLBACK;

    -- T9: ON DELETE CASCADE servico -> tabelas de ligação e imagens
    START TRANSACTION;
    DELETE FROM servico WHERE servico_id = 1;
    SELECT COUNT(*) INTO v_qtd FROM (
        SELECT servico_id FROM imagem WHERE servico_id = 1
        UNION ALL SELECT servico_id FROM servico_ferramenta WHERE servico_id = 1
        UNION ALL SELECT servico_id FROM categoria_servico WHERE servico_id = 1
    ) t;
    SELECT IF(v_qtd = 0, 'T9 OK - cascade de servico funcionando',
                         'T9 FALHOU - registros órfãos de servico') AS resultado;
    ROLLBACK;

    -- T10: PK composta impede duplicidade em servico_ferramenta
    BEGIN
        DECLARE EXIT HANDLER FOR 1062
            SELECT 'T10 OK - PK composta impede par duplicado' AS resultado;
        INSERT INTO servico_ferramenta (servico_id, ferramenta_id) VALUES (1, 1);
        SELECT 'T10 FALHOU - par duplicado aceito' AS resultado;
    END;

    -- T11: nenhum usuário com mais de uma assinatura ativa
    SELECT COUNT(*) INTO v_qtd FROM (
        SELECT usuario_id FROM assinatura
        WHERE assinatura_status = 'ativa'
        GROUP BY usuario_id HAVING COUNT(*) > 1
    ) t;
    SELECT IF(v_qtd = 0, 'T11 OK - nenhum usuário com 2+ assinaturas ativas',
                         'T11 FALHOU - existem duplicidades') AS resultado;

    -- T12: DEFAULTs (status 'ativa' e período 'mensal')
    START TRANSACTION;
    INSERT INTO conversa (usuario_id) VALUES (2);
    SELECT IF(conversa_status = 'ativa', 'T12a OK - default de conversa_status',
                                         'T12a FALHOU - default incorreto') AS resultado
    FROM conversa WHERE conversa_id = LAST_INSERT_ID();
    INSERT INTO plano (plano_nome, plano_preco) VALUES ('Teste', 1.00);
    SELECT IF(plano_periodo = 'mensal', 'T12b OK - default de plano_periodo',
                                        'T12b FALHOU - default incorreto') AS resultado
    FROM plano WHERE plano_id = LAST_INSERT_ID();
    ROLLBACK;
END$$

DELIMITER ;

CALL sp_validacao();

-- Contagem de registros por tabela (sanidade da carga do dml.sql)
SELECT 'usuario' AS tabela, COUNT(*) AS total FROM usuario
UNION ALL SELECT 'conversa', COUNT(*) FROM conversa
UNION ALL SELECT 'mensagem', COUNT(*) FROM mensagem
UNION ALL SELECT 'servico', COUNT(*) FROM servico
UNION ALL SELECT 'imagem', COUNT(*) FROM imagem
UNION ALL SELECT 'ferramenta', COUNT(*) FROM ferramenta
UNION ALL SELECT 'servico_ferramenta', COUNT(*) FROM servico_ferramenta
UNION ALL SELECT 'categoria', COUNT(*) FROM categoria
UNION ALL SELECT 'categoria_servico', COUNT(*) FROM categoria_servico
UNION ALL SELECT 'plano', COUNT(*) FROM plano
UNION ALL SELECT 'assinatura', COUNT(*) FROM assinatura;

DROP PROCEDURE IF EXISTS sp_validacao;

-- =====================================================================
-- DADOS DE DEMONSTRAÇÃO (opcional) — deixa os dashboards cheios para testar.
-- Rode DEPOIS de admin-migracao.sql e admin-seed.sql. Rode uma vez só.
-- Senha de todas as contas demo: Demo@1234
-- Para apagar tudo depois:  DELETE FROM usuario WHERE usuario_email LIKE '%@demo.deubug.test';
-- =====================================================================
USE deubug;

SET @admin := (SELECT usuario_id FROM usuario WHERE usuario_email = 'admin@deubug.com.br');

-- Equipe
INSERT INTO usuario (usuario_nome, usuario_email, usuario_senha, usuario_telefone, usuario_tipo, usuario_cargo) VALUES
 ('Ana Costa',     'ana@demo.deubug.test',   '$2y$10$xqlVdW0ZtNd9lxwyhJcNtORJ8EJYmCMXAsd5zfEvUhOIOGqvoD8Ne', '(11) 90000-0001', 'admin', 'Designer'),
 ('Lucas Almeida', 'lucas@demo.deubug.test', '$2y$10$xqlVdW0ZtNd9lxwyhJcNtORJ8EJYmCMXAsd5zfEvUhOIOGqvoD8Ne', '(11) 90000-0002', 'admin', 'Desenvolvedor');
SET @ana   := (SELECT usuario_id FROM usuario WHERE usuario_email = 'ana@demo.deubug.test');
SET @lucas := (SELECT usuario_id FROM usuario WHERE usuario_email = 'lucas@demo.deubug.test');

-- Clientes
INSERT INTO usuario (usuario_nome, usuario_email, usuario_senha, usuario_telefone, usuario_empresa) VALUES
 ('Marina Rocha',  'marina@demo.deubug.test', '$2y$10$xqlVdW0ZtNd9lxwyhJcNtORJ8EJYmCMXAsd5zfEvUhOIOGqvoD8Ne', '(11) 91111-2222', 'Padaria Doce Trigo'),
 ('Camila Duarte', 'camila@demo.deubug.test', '$2y$10$xqlVdW0ZtNd9lxwyhJcNtORJ8EJYmCMXAsd5zfEvUhOIOGqvoD8Ne', '(11) 92222-3333', 'Studio Aurora Pilates'),
 ('Tiago Mendes',  'tiago@demo.deubug.test',  '$2y$10$xqlVdW0ZtNd9lxwyhJcNtORJ8EJYmCMXAsd5zfEvUhOIOGqvoD8Ne', '(11) 94444-5555', 'Café Girassol');
SET @marina := (SELECT usuario_id FROM usuario WHERE usuario_email = 'marina@demo.deubug.test');
SET @camila := (SELECT usuario_id FROM usuario WHERE usuario_email = 'camila@demo.deubug.test');
SET @tiago  := (SELECT usuario_id FROM usuario WHERE usuario_email = 'tiago@demo.deubug.test');

-- Projetos (etapa: 0 Briefing, 1 Design, 2 Desenvolvimento, 3 Revisão, 4 Publicado)
INSERT INTO projeto (usuario_id, responsavel_id, projeto_titulo, projeto_empresa, projeto_etapa, projeto_progresso, projeto_prazo, projeto_inicio, projeto_tag, projeto_tag_estilo) VALUES
 (@marina, @lucas, 'Loja online Doce Trigo',   'Padaria Doce Trigo',    2, 62, CURDATE() + INTERVAL 10 DAY, CURDATE() - INTERVAL 40 DAY, NULL, NULL),
 (@marina, @ana,   'Site Doce Trigo',          'Padaria Doce Trigo',    3, 88, CURDATE() + INTERVAL 3 DAY,  CURDATE() - INTERVAL 60 DAY, NULL, NULL),
 (@camila, @admin, 'Landing Aurora Pilates',   'Studio Aurora Pilates', 0,  8, CURDATE() + INTERVAL 20 DAY, CURDATE() - INTERVAL 6 DAY,  'Fotos pendentes', 'warn'),
 (@tiago,  @lucas, 'Loja Café Girassol',       'Café Girassol',         2, 48, CURDATE() - INTERVAL 2 DAY,  CURDATE() - INTERVAL 50 DAY, NULL, NULL);
SET @p1 := (SELECT projeto_id FROM projeto WHERE projeto_titulo = 'Loja online Doce Trigo');
SET @p2 := (SELECT projeto_id FROM projeto WHERE projeto_titulo = 'Site Doce Trigo');
SET @p3 := (SELECT projeto_id FROM projeto WHERE projeto_titulo = 'Landing Aurora Pilates');
SET @p4 := (SELECT projeto_id FROM projeto WHERE projeto_titulo = 'Loja Café Girassol');

-- Aprovações que dependem do cliente
INSERT INTO projeto_aprovacao (projeto_id, aprovacao_titulo, aprovacao_descricao, aprovacao_prazo) VALUES
 (@p1, 'Aprovar layout de produtos', 'Página de produtos, versão 3.', CURDATE() + INTERVAL 3 DAY),
 (@p2, 'Aprovar versão final do site', 'Revise textos e imagens antes da publicação.', CURDATE() + INTERVAL 2 DAY);

-- Log da equipe
INSERT INTO projeto_atualizacao (projeto_id, autor_id, atualizacao_titulo, atualizacao_visivel, atualizacao_cor, atualizacao_criacao) VALUES
 (@p1, @ana,   'Layout da página de produtos enviado para aprovação', 1, 'blue',  NOW() - INTERVAL 3 HOUR),
 (@p1, @lucas, 'Catálogo de produtos concluído',                      1, 'green', NOW() - INTERVAL 1 DAY),
 (@p2, @ana,   'Site enviado para revisão final',                     1, 'blue',  NOW() - INTERVAL 2 DAY),
 (@p4, @admin, 'Cliente pediu ajuste no escopo (avaliar)',            0, 'yellow', NOW() - INTERVAL 2 DAY);

-- Tarefas
INSERT INTO projeto_tarefa (projeto_id, responsavel_id, tarefa_titulo, tarefa_concluida) VALUES
 (@p1, @lucas, 'Estrutura da loja e menu', 1),
 (@p1, @lucas, 'Catálogo de produtos', 1),
 (@p1, @lucas, 'Carrinho e finalização da compra', 0),
 (@p1, @ana,   'Painel para acompanhar pedidos', 0);

-- Solicitações de novos projetos
INSERT INTO solicitacao_projeto (usuario_id, solicitacao_empresa, solicitacao_tipo, solicitacao_descricao, solicitacao_status, solicitacao_previsao_contato) VALUES
 (@camila, 'Studio Aurora Pilates', 'institucional', 'Queremos um site institucional com página de planos e agendamento de aulas.', 'pendente', CURDATE() + INTERVAL 2 DAY),
 (@tiago,  'Café Girassol', 'blog', 'Blog com receitas e novidades do café.', 'pendente', CURDATE() + INTERVAL 2 DAY);

INSERT INTO cliente_nota (usuario_id, autor_id, nota_texto) VALUES
 (@marina, @admin, 'Prefere conversar por WhatsApp. Responde melhor à noite.');

-- Chat de demonstração (suporte geral da Marina + chat do projeto dela)
INSERT INTO chat_conversa (usuario_id, projeto_id, chat_ultima_em) VALUES
 (@marina, NULL, NOW()), (@marina, @p1, NOW());
SET @chatGeral := (SELECT chat_id FROM chat_conversa WHERE usuario_id = @marina AND projeto_id IS NULL);
SET @chatP1    := (SELECT chat_id FROM chat_conversa WHERE usuario_id = @marina AND projeto_id = @p1);
INSERT INTO chat_mensagem (chat_id, msg_remetente, autor_id, msg_texto, msg_criacao) VALUES
 (@chatP1, 'equipe',  @lucas, 'Oi Marina! Já enviamos o layout da página de produtos para a sua aprovação.', NOW() - INTERVAL 2 HOUR),
 (@chatP1, 'cliente', @marina, 'Oi! Vou olhar hoje à noite e te falo.', NOW() - INTERVAL 1 HOUR),
 (@chatGeral, 'equipe', @admin, 'Olá! Este é o seu canal de suporte geral. Como podemos ajudar?', NOW() - INTERVAL 1 DAY);

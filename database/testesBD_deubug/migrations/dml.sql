USE deubug;

INSERT INTO usuario (usuario_nome, usuario_email, usuario_senha, usuario_telefone) VALUES
('Ana Souza',      'ana.souza@email.com',      '1234',    '(11) 91111-1111'),
('Bruno Lima',     'bruno.lima@email.com',     '1234',  '(11) 92222-2222'),
('Carla Mendes',   'carla.mendes@email.com',   '1234',  '(11) 93333-3333'),
('Diego Alves',    'diego.alves@email.com',    '1234',  '(11) 94444-4444'),
('Elisa Ferreira', 'elisa.ferreira@email.com', '1234',  '(11) 95555-5555');

INSERT INTO plano (plano_nome, plano_descricao, plano_preco, plano_periodo, plano_ativo) VALUES
('Silver',        '1 ano de suporte ao site', 0.00, 'mensal', TRUE),
('Gold',         '1 ano de suporte ao site', 29.90, 'mensal', TRUE),
('Diamond',   '1 ano de suporte ao site', 299.00, 'anual',  TRUE);

-- Regra: apenas UMA assinatura 'ativa' por usuário (trigger)
INSERT INTO assinatura (usuario_id, plano_id, assinatura_datainicio, assinatura_datafim, assinatura_status) VALUES
(1, 1, '2025-01-10', '2025-06-10', 'expirada'),
(1, 2, '2025-06-11', NULL,         'ativa'),
(2, 3, '2025-03-01', NULL,         'ativa'),
(3, 1, '2025-02-15', '2025-04-15', 'cancelada'),
(4, 2, '2025-05-20', NULL,         'inadimplente'),
(5, 3, '2025-07-01', NULL,         'ativa');

INSERT INTO conversa (conversa_status, usuario_id) VALUES
('ativa',      1),
('finalizada', 1),
('ativa',      2),
('arquivada',  3),
('ativa',      5);

INSERT INTO mensagem (mensagem_remetente, mensagem_conteudo, conversa_id) VALUES
('Usuario', 'Preciso de um site institucional para minha empresa.',          1),
('IA',      'Posso indicar nosso serviço de Desenvolvimento Web. Quer ver?', 1),
('Usuario', 'Quero sim, com quais ferramentas vocês trabalham?',             1),
('IA',      'Trabalhamos com React, Node.js e MySQL.',                       1),
('Usuario', 'Tenho um dashboard quebrado no Power BI.',                      2),
('IA',      'Nosso serviço de Consultoria em Dados pode ajudar.',            2),
('Usuario', 'Preciso redesenhar o app da minha loja.',                       3),
('IA',      'Indico o serviço de Design UI/UX.',                             3),
('Usuario', 'Meu computador não liga.',                                      4),
('IA',      'Sugiro o serviço de Suporte Técnico.',                          4),
('Usuario', 'Quero automatizar relatórios semanais.',                        5),
('IA',      'A Automação de Processos com Python resolve isso.',             5);

INSERT INTO servico (servico_nome, servico_descricao, servico_link) VALUES
('Desenvolvimento Web',     'Criação de sites e sistemas web sob medida.',        'https://deubug.com/servicos/dev-web'),
('Consultoria em Dados',    'Análise, modelagem e dashboards de dados.',          'https://deubug.com/servicos/dados'),
('Design UI/UX',            'Protótipos de alta fidelidade e design systems.',    'https://deubug.com/servicos/ui-ux'),
('Suporte Técnico',         'Manutenção e suporte de hardware e software.',       'https://deubug.com/servicos/suporte'),
('Automação de Processos',  'Scripts e integrações para automatizar tarefas.',    'https://deubug.com/servicos/automacao');

INSERT INTO imagem (imagem_caminho, servico_id) VALUES
('/img/servicos/dev-web-1.png',  1),
('/img/servicos/dev-web-2.png',  1),
('/img/servicos/dados-1.png',    2),
('/img/servicos/ui-ux-1.png',    3),
('/img/servicos/suporte-1.png',  4),
('/img/servicos/automacao-1.png',5);

INSERT INTO ferramenta (ferramenta_nome, ferramenta_icone) VALUES
('React',    '/icons/react.svg'),
('Node.js',  '/icons/nodejs.svg'),
('MySQL',    '/icons/mysql.svg'),
('Figma',    '/icons/figma.svg'),
('Power BI', '/icons/powerbi.svg'),
('Python',   '/icons/python.svg');

INSERT INTO servico_ferramenta (servico_id, ferramenta_id) VALUES
(1, 1), (1, 2), (1, 3),
(2, 3), (2, 5), (2, 6),
(3, 4),
(5, 6), (5, 2);

INSERT INTO categoria (categoria_nome) VALUES
('Desenvolvimento'), ('Design'), ('Dados'), ('Suporte'), ('Automação');

INSERT INTO categoria_servico (servico_id, categoria_id) VALUES
(1, 1),
(2, 3),
(3, 2),
(4, 4),
(5, 5), (5, 1);

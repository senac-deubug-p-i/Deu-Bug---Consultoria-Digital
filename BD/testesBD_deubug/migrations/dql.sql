USE deubug;


SELECT u.usuario_nome, p.plano_nome, p.plano_preco, a.assinatura_datainicio
FROM usuario u
JOIN assinatura a ON a.usuario_id = u.usuario_id
JOIN plano p      ON p.plano_id = a.plano_id
WHERE a.assinatura_status = 'ativa'
ORDER BY u.usuario_nome;


SELECT assinatura_status, COUNT(*) AS total
FROM assinatura
GROUP BY assinatura_status;


SELECT ROUND(SUM(CASE WHEN p.plano_periodo = 'anual'
                      THEN p.plano_preco / 12
                      ELSE p.plano_preco END), 2) AS receita_mensal_prevista
FROM assinatura a
JOIN plano p ON p.plano_id = a.plano_id
WHERE a.assinatura_status = 'ativa';


SELECT u.usuario_nome, u.usuario_email, u.usuario_telefone
FROM usuario u
JOIN assinatura a ON a.usuario_id = u.usuario_id
WHERE a.assinatura_status = 'inadimplente';


SELECT u.usuario_nome,
       COUNT(DISTINCT c.conversa_id) AS total_conversas,
       COUNT(m.mensagem_id)          AS total_mensagens
FROM usuario u
LEFT JOIN conversa c ON c.usuario_id = u.usuario_id
LEFT JOIN mensagem m ON m.conversa_id = c.conversa_id
GROUP BY u.usuario_id, u.usuario_nome
ORDER BY total_mensagens DESC;


SELECT m.mensagem_horaenvio, m.mensagem_remetente, m.mensagem_conteudo
FROM mensagem m
WHERE m.conversa_id = 1
ORDER BY m.mensagem_horaenvio, m.mensagem_id;


SELECT s.servico_nome,
       GROUP_CONCAT(DISTINCT c.categoria_nome  ORDER BY c.categoria_nome  SEPARATOR ', ') AS categorias,
       GROUP_CONCAT(DISTINCT f.ferramenta_nome ORDER BY f.ferramenta_nome SEPARATOR ', ') AS ferramentas
FROM servico s
LEFT JOIN categoria_servico cs  ON cs.servico_id = s.servico_id
LEFT JOIN categoria c           ON c.categoria_id = cs.categoria_id
LEFT JOIN servico_ferramenta sf ON sf.servico_id = s.servico_id
LEFT JOIN ferramenta f          ON f.ferramenta_id = sf.ferramenta_id
GROUP BY s.servico_id, s.servico_nome;


SELECT f.ferramenta_nome, COUNT(sf.servico_id) AS qtd_servicos
FROM ferramenta f
LEFT JOIN servico_ferramenta sf ON sf.ferramenta_id = f.ferramenta_id
GROUP BY f.ferramenta_id, f.ferramenta_nome
ORDER BY qtd_servicos DESC;


SELECT s.servico_nome
FROM servico s
LEFT JOIN imagem i ON i.servico_id = s.servico_id
WHERE i.imagem_id IS NULL;


SELECT u.usuario_nome
FROM usuario u
WHERE NOT EXISTS (SELECT 1 FROM conversa c WHERE c.usuario_id = u.usuario_id);


SELECT p.plano_nome, COUNT(a.assinatura_id) AS total_assinaturas
FROM plano p
LEFT JOIN assinatura a ON a.plano_id = p.plano_id
GROUP BY p.plano_id, p.plano_nome
ORDER BY total_assinaturas DESC;


SELECT c.conversa_id, u.usuario_nome, c.conversa_atualizacao
FROM conversa c
JOIN usuario u ON u.usuario_id = c.usuario_id
WHERE c.conversa_status = 'ativa'
ORDER BY c.conversa_atualizacao DESC;

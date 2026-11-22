-- =====================================================================
-- SEED DO ADMIN  (rodar UMA vez, depois da migração)
-- Login:  admin@deubug.com.br   Senha: Admin@123   <-- TROQUE depois!
--
-- Para transformar uma conta que você JÁ criou em admin, use:
--   UPDATE usuario SET usuario_tipo = 'admin', usuario_cargo = 'Gerente de projetos'
--    WHERE usuario_email = 'seu-email@exemplo.com';
-- =====================================================================
USE deubug;

INSERT INTO usuario (usuario_nome, usuario_email, usuario_senha, usuario_telefone, usuario_tipo, usuario_cargo)
VALUES ('Administrador Deu Bug', 'admin@deubug.com.br', '$2y$10$Z0woWpWBHXNIGDzT0Bgf6.8Z9GCYkrDhYOnlSAV4OKuyJXxpnZILe', '(00) 00000-0000', 'admin', 'Gerente de projetos');

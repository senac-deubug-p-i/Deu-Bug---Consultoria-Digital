# Admin integrado ao backend — como aplicar

## 1) Arquivos
Extraia o zip na RAIZ do projeto (mesclando pastas). **Apague** `pages/client/admin-area/finance.php`.
`includes/functions.php` só ganhou funções de data no final (se você mexeu nele, cole só o trecho "Datas e textos em português").

## 2) Banco (phpMyAdmin → aba SQL, banco `deubug` selecionado), nesta ordem
1. `database/admin-migracao.sql`  — colunas novas em `usuario`/`solicitacao_projeto` + 7 tabelas novas (rodar de novo não dá erro; requer MariaDB do XAMPP)
2. `database/admin-seed.sql`      — cria o admin: `admin@deubug.com.br` / `Admin@123` (TROQUE a senha)
   - ou torne uma conta sua admin: `UPDATE usuario SET usuario_tipo='admin', usuario_cargo='Gerente de projetos' WHERE usuario_email='seu@email';`
3. `database/admin-demo.sql` (opcional) — equipe, clientes, projetos, aprovações e logs de exemplo (senha `Demo@1234`)
Instalação do zero: use o `ddl.sql` atualizado (já inclui tudo).

## 3) O que mudou
- Pagamentos removidos: tela Financeiro, KPIs/valores no admin, "Faturas e pagamentos"/Boleto/Recibos e plano no cabeçalho do cliente. (Tabelas `plano`/`assinatura` continuam no banco, sem uso.)
- Admin protegido: `exigir_admin()` (coluna `usuario_tipo`). Admin que loga vai direto para `admin-area/index.php`; cliente que tenta abrir o admin volta para a área dele.
- Admin 100% no banco: Visão geral, Projetos (kanban com arrastar), Detalhe do projeto, Clientes e Solicitações.
- Dashboard: projetos ativos, aprovações pendentes, solicitações novas, log de atualizações da equipe e carga da equipe vêm do banco.
- Cliente: cards, "Atividade recente" e "Pendências" (botão Aprovar funciona) vêm do banco; "Meus Projetos" lista os projetos reais.
- Aprovar uma solicitação no admin cria o projeto do cliente (`projeto.solicitacao_id`).
- Uploads: `uploads/projetos/` (fora de acesso público; download só por `actions/admin/arquivo.php`).

## 4) Como o admin conversa com o PHP
As telas usam `fetch()` + JSON para `actions/admin/{projetos,clientes,solicitacoes}.php` (POST, só admin, com token CSRF).
Cada arquivo tem um `switch ($acao)`. Para criar uma função nova: nova `case` no PHP + um `api('projetos', {acao: '...'})` no JS.

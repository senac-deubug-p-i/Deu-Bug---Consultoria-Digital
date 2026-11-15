        <section class="projects">
            <div class="title-projects">
                <h2>Projetos</h2>
                <button type="button" id="abrir-solicitacao">Solicitar novo projeto</button>
            </div>

            <?php if ($sucessoSolic): ?>
                <div class="aviso aviso--sucesso" role="status"><?= e($sucessoSolic) ?></div>
            <?php endif; ?>

            <div class="project-grid">

                <!-- Solicitações enviadas, aguardando contato da equipe -->
                <?php foreach ($solicitacoes as $s): ?>
                    <div class="project-card project-card--solicitacao">
                        <div>
                            <h2><?= e($s['solicitacao_empresa']) ?></h2>
                            <p><?= e(nome_tipo_site($s['solicitacao_tipo'])) ?></p>
                            <p class="retorno">Retorno previsto até <?= e(data_br($s['solicitacao_previsao_contato'])) ?></p>
                        </div>

                        <div class="project-status">
                            <p><?= $s['solicitacao_status'] === 'em_contato' ? 'Em contato' : 'Em análise' ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>

                <!-- MANTENHA AQUI o seu card de projeto atual (o da Barbearia Luck Shot) -->

            </div>
        </section>

        <!-- Modal: solicitar novo projeto -->
        <dialog id="modal-solicitacao" class="modal-solicitacao" aria-labelledby="titulo-solicitacao"
                <?= $erroSolic ? 'data-abrir' : '' ?>>
            <form class="solic-form" action="../../../actions/solicitar-projeto.php" method="post">
                <div class="solic-topo">
                    <h2 id="titulo-solicitacao">Solicitar novo projeto</h2>
                    <button type="button" class="solic-fechar" data-fechar aria-label="Fechar">&times;</button>
                </div>
                <p class="solic-sub">Conte o básico sobre o que você precisa. Nossa equipe entra em contato em até <?= PRAZO_CONTATO_DIAS_UTEIS ?> dias úteis.</p>

                <?php if ($erroSolic): ?>
                    <div class="aviso aviso--erro" role="alert"><?= e($erroSolic) ?></div>
                <?php endif; ?>

                <label for="solic-empresa">Nome da empresa</label>
                <input id="solic-empresa" type="text" name="empresa" maxlength="150" required
                       autocomplete="organization" value="<?= e($antigo['empresa'] ?? '') ?>">

                <label for="solic-tipo">Tipo de site</label>
                <select id="solic-tipo" name="tipo" required>
                    <option value="" disabled <?= empty($antigo['tipo']) ? 'selected' : '' ?>>Selecione uma opção</option>
                    <?php foreach ($tipos as $chave => $rotulo): ?>
                        <option value="<?= e($chave) ?>" <?= ($antigo['tipo'] ?? '') === $chave ? 'selected' : '' ?>><?= e($rotulo) ?></option>
                    <?php endforeach; ?>
                </select>

                <label for="solic-descricao">Breve descrição</label>
                <textarea id="solic-descricao" name="descricao" rows="5" minlength="10" maxlength="1000" required
                          placeholder="O que você precisa, referências, prazo desejado..."><?= e($antigo['descricao'] ?? '') ?></textarea>

                <div class="solic-acoes">
                    <button type="button" class="btn-secundario" data-fechar>Cancelar</button>
                    <button type="submit" class="btn-primario">Enviar solicitação</button>
                </div>
            </form>
        </dialog>

        <script src="index.js" defer></script>

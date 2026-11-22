<?php
require_once __DIR__ . '/../../../includes/admin-dados.php';
[$pdo, $admin] = admin_iniciar();
$equipe = admin_equipe($pdo);
?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin - Solicitações</title>

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200..800&display=swap" rel="stylesheet" />
  <link rel="shortcut icon" href="../../../assets/images/DeuBug_favIcon.ico" type="image/x-icon">

  <script src="https://cdn.tailwindcss.com/3.4.17"></script>
  <script>
    // Design tokens do projeto
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: { sans: ['Plus Jakarta Sans', 'system-ui', 'sans-serif'] },
          colors: {
            base: '#08080A',
            sidebar: '#0B0B0F',
            lane: '#0E0E12',
            edge: '#1E1E26',
            panel: '#15151B',
            'panel-hover': '#1C1C24',
            field: '#121217',
            'field-hover': '#1A1A22',
            line: '#22222A',
            line2: '#26262E',
            brand: '#7B4BB3',
            'brand-hover': '#8B4CF5',
            'brand-dark': '#7B4BB3',
            ink: '#F2F2F6',
            soft: '#9A9AA6',
            pill: '#A3A3AE',
            mute: '#6B6B78',
            faint: '#5F5F68',
          },
        },
      },
    }
  </script>
</head>

<body class="min-h-screen bg-base font-sans text-ink">

  <!-- Ícones (sprite SVG) -->
  <svg width="0" height="0" class="absolute">
    <defs fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <symbol id="i-dash" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></symbol>
      <symbol id="i-folder" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 20a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.9a2 2 0 0 1-1.69-.9L9.6 3.9A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2Z"/></symbol>
      <symbol id="i-users" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></symbol>
      <symbol id="i-inbox" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 16 12 14 15 10 15 8 12 2 12"/><path d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"/></symbol>
      <symbol id="i-card" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></symbol>
      <symbol id="i-ud" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m7 15 5 5 5-5M7 9l5-5 5 5"/></symbol>
      <symbol id="i-plus" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5v14"/></symbol>
      <symbol id="i-search" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></symbol>
      <symbol id="i-down" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></symbol>
      <symbol id="i-image" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></symbol>
      <symbol id="i-file" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/></symbol>
    </defs>
  </svg>

  <div class="flex min-h-screen w-full">

    <!-- ===== Sidebar ===== -->
    <aside class="sticky top-0 flex h-screen w-[220px] shrink-0 flex-col justify-between border-r border-edge bg-sidebar px-3.5 py-5 max-[760px]:hidden">
      <div>
        <div class="flex items-center gap-2.5 px-1.5 pb-[18px]">
          <div class="grid size-[34px] place-items-center rounded-[10px]">
            <img src="../../../assets/images/ReducedLogo_DeuBug.png" alt="">
          </div>
          <div>
            <div class="text-[14.5px] font-extrabold">Deu Bug!</div>
            <div class="mt-px text-[8px] font-bold tracking-[1.6px] text-mute">ADMIN</div>
          </div>
        </div>
        <nav id="nav" class="flex flex-col gap-[3px] pt-2.5"></nav>
      </div>

      <div class="flex flex-col gap-2.5">
        <a href="../client-area/index.php" class="flex justify-center rounded-[10px] bg-panel px-3 py-[9px] text-[11.5px] font-medium text-[#C9C9D4] outline outline-1 outline-offset-[-.5px] outline-line2 transition hover:bg-panel-hover hover:text-white hover:outline-brand">
          Ver como cliente
        </a>
        <div class="flex w-full items-center gap-[9px] rounded-[10px] bg-panel px-2 py-[7px] text-left">
          <div class="grid size-7 shrink-0 place-items-center rounded-full bg-[#6D28D9] text-[9.5px] font-bold text-white"><?= e($admin['iniciais']) ?></div>
          <div class="flex-1">
            <div class="text-[11.5px] font-semibold"><?= e($admin['usuario_nome']) ?></div>
            <div class="mt-px text-[9px] font-medium text-mute"><?= e($admin['cargo']) ?></div>
          </div>
          </div>
        <form action="../../../actions/logout.php" method="post">
          <button type="submit" class="flex w-full justify-center rounded-[10px] px-3 py-[9px] text-[11.5px] font-medium text-soft transition hover:bg-panel hover:text-white">Sair</button>
        </form>
      </div>
    </aside>

    <!-- ===== Conteúdo ===== -->
    <main class="flex min-w-0 flex-1 flex-col gap-[18px] px-[30px] py-[26px] max-[760px]:px-4 max-[760px]:py-5">

      <header>
        <h1 class="mb-[7px] w-fit bg-gradient-to-t from-[#CBAAFF] via-[#7B4BB3] via-60% to-brand bg-clip-text text-[38px] font-extrabold leading-[normal] tracking-[-1.2px] text-transparent max-[760px]:text-[30px]">
          Solicitações
        </h1>
        <p class="text-[12.5px] font-medium text-[#7C7C88]">Pedidos de novos projetos enviados pelos clientes.</p>
      </header>

      <!-- Abas -->
      <div id="tabs" role="tablist" aria-label="Filtros" class="flex flex-wrap items-center gap-2"></div>

      <div class="grid grid-cols-1 items-start gap-4 lg:grid-cols-[290px_minmax(0,1fr)] xl:grid-cols-[300px_minmax(0,1fr)_292px]">

        <!-- Lista de solicitações -->
        <section id="list" aria-label="Solicitações" class="rounded-[14px] bg-lane p-2 outline outline-1 outline-offset-[-.5px] outline-[#1D1D24]"></section>

        <!-- Detalhe -->
        <section aria-label="Detalhe da solicitação"
                 class="flex flex-col rounded-2xl bg-[linear-gradient(-93.9deg,#2B1B47_7%,#1C1229_54%,#141020_93%)] p-5 outline outline-1 outline-offset-[-.5px] outline-[#3A2A57] sm:p-6">
          <div id="detail-empty" class="hidden py-24 text-center text-xs font-medium text-[#B3A8CB]">Selecione uma solicitação para ver os detalhes.</div>

          <div id="detail-body" class="flex flex-col">
            <div class="flex items-start justify-between gap-4">
              <div>
                <h2 id="detail-title" class="text-[15px] font-bold text-[#EDE7FA]"></h2>
                <p id="detail-sub" class="mt-1.5 text-[10.5px] font-medium text-[#B3A8CB]"></p>
              </div>
              <span id="detail-status"></span>
            </div>

            <div class="mt-5 border-t border-white/10"></div>
            <div id="thread" class="mt-5 flex flex-col gap-3"></div>

            <div class="mt-14 border-t border-white/10 pt-4">
              <label id="reply-label" for="reply" class="text-[10.5px] font-semibold text-[#B3A8CB]">Responder</label>
              <textarea id="reply" rows="3" placeholder="Escreva a resposta" data-ui="textarea"></textarea>

              <div class="mt-3 flex flex-wrap items-center gap-2">
                <div id="canned-wrap" class="group relative">
                  <button id="btn-canned" data-ui="btn md glass">Respostas prontas</button>
                  <div id="canned-menu" class="absolute bottom-full left-0 z-20 mb-2 hidden w-[270px] rounded-[10px] bg-panel p-[5px] shadow-[0_14px_34px_rgba(0,0,0,.5)] outline outline-1 outline-line2 group-data-[open]:block"></div>
                </div>
                <div class="flex-1"></div>
                <button id="btn-note" data-ui="btn md glass">Salvar como nota</button>
                <button id="btn-send" data-ui="btn md primary">Enviar</button>
              </div>
            </div>
          </div>
        </section>

        <!-- Coluna lateral -->
        <aside class="flex flex-col gap-4">
          <section data-ui="card" aria-label="Gerenciar">
            <div class="text-sm font-bold text-[#EFEBF6]">Gerenciar</div>

            <label data-ui="label">Situação
              <select id="status" data-ui="field"></select>
            </label>
            <label data-ui="label">Atribuir a
              <select id="assignee" data-ui="field"></select>
            </label>
            <label data-ui="label">Prioridade
              <select id="priority" data-ui="field"></select>
            </label>

            <div class="flex flex-col gap-2 pt-1">
              <button id="btn-save" data-ui="btn lg primary">Salvar alterações</button>
              <button id="btn-resolve" data-ui="btn lg ghost">Marcar como resolvida</button>
            </div>
          </section>

          <section aria-label="Prazo de retorno" class="rounded-[14px] bg-gradient-to-br from-brand-hover to-brand p-4 text-white">
            <div class="text-[13px] font-bold">Retorno ao cliente até</div>
            <p id="contact-by" class="mt-1.5 text-[26px] font-extrabold leading-tight tracking-[-.5px]">—</p>
            <p class="mt-2 max-w-[215px] text-[10.5px] font-medium leading-[1.6] text-white/85">Prazo prometido ao cliente: <?= (int)PRAZO_CONTATO_DIAS_UTEIS ?> dias úteis após o envio.</p>
          </section>
        </aside>
      </div>
    </main>
  </div>

  <!-- Toast -->
  <div id="toast" class="pointer-events-none fixed bottom-6 left-1/2 z-[60] -translate-x-1/2 translate-y-5 rounded-[10px] bg-panel px-4 py-2.5 text-xs font-semibold opacity-0 outline outline-1 outline-brand-dark transition duration-[250ms] data-[show]:translate-y-0 data-[show]:opacity-100"></div>


  <script>

    /* =========================================================
       0. SESSÃO E API (fetch -> actions/admin/*.php)
    ========================================================= */
    const CSRF = <?= js_json(csrf_token()) ?>;
    const ME = <?= js_json(['id' => (string)$admin['usuario_id'], 'name' => $admin['usuario_nome']]) ?>;

    async function api(endpoint, data) {
      const isForm = data instanceof FormData
      try {
        const res = await fetch(`../../../actions/admin/${endpoint}.php`, {
          method: 'POST', credentials: 'same-origin',
          headers: isForm ? { 'X-CSRF-Token': CSRF } : { 'X-CSRF-Token': CSRF, 'Content-Type': 'application/json' },
          body: isForm ? data : JSON.stringify(data),
        })
        const json = await res.json().catch(() => null)
        if (!res.ok || !json || !json.ok) { showToast((json && json.erro) || 'Não foi possível salvar'); return null }
        return json
      } catch (err) {
        showToast('Sem conexão com o servidor')
        return null
      }
    }
    /* =========================================================
       1. CONFIGURAÇÃO
    ========================================================= */
    const CURRENT_USER = ME.id
    const TEAM = <?= js_json($equipe) ?>;

    const NAV_ITEMS = <?= js_json(admin_nav($pdo, 'solicitation.php')) ?>;
    NAV_ITEMS.forEach((item) => { if (item.href === 'solicitation.php') item.badge = true })

    const TAG_STYLES = {
      warn:    'bg-[#2F260F] text-[#E5C465]',
      red:     'bg-[#33131B] text-[#F0777C]',
      neutral: 'bg-[#232329] text-[#A0A0AA]',
    }

    const STATUS = {
      pendente:   { label: 'Nova',         style: 'bg-[#33280D] text-[#E5C465] outline-[#5A451A]' },
      em_contato: { label: 'Em contato',   style: 'bg-[#241640] text-[#C4B5FD] outline-[#4B2E85]' },
      aprovada:   { label: 'Aprovada',     style: 'bg-[#0D2A1C] text-[#54D68E] outline-[#1D5C3B]' },
      recusada:   { label: 'Recusada',     style: 'bg-[#33131B] text-[#F0777C] outline-[#5A1F2B]' },
    }
    const PRIORITIES = { baixa: 'Baixa', normal: 'Normal', alta: 'Alta' }

    const TABS = [
      { id: 'pendente',   label: 'Novas',            count: true },
      { id: 'em_contato', label: 'Em contato',       count: true },
      { id: 'aprovada',   label: 'Aprovadas' },
      { id: 'recusada',   label: 'Recusadas' },
      { id: 'mim',        label: 'Atribuídas a mim' },
    ]

    const TAB_FILTERS = {
      pendente:   (r) => r.status === 'pendente',
      em_contato: (r) => r.status === 'em_contato',
      aprovada:   (r) => r.status === 'aprovada',
      recusada:   (r) => r.status === 'recusada',
      mim:        (r) => r.assignee === CURRENT_USER,
    }

    const CANNED_REPLIES = [
      'Oi! Recebemos sua solicitação e já estamos cuidando disso.',
      'Combinado! Vamos fazer o ajuste e te avisamos assim que estiver pronto.',
      'Esse pedido está fora do escopo combinado. Posso te enviar uma proposta separada?',
      'Resolvido! Se precisar de mais alguma coisa, é só chamar.',
    ]

    /* =========================================================
       2. ESTILOS REUTILIZÁVEIS (classes Tailwind)
    ========================================================= */
    // Botões: base + tamanho + tom
    const BTN_BASE  = 'flex items-center justify-center gap-1.5 whitespace-nowrap font-semibold transition active:scale-[.97] disabled:pointer-events-none disabled:opacity-50'
    const BTN_SIZES = {
      md: 'rounded-[9px] px-3.5 py-2 text-[10.5px]',
      lg: 'w-full rounded-[9px] px-4 py-2.5 text-xs',
    }
    const BTN_TONES = {
      primary: 'bg-brand font-bold text-white hover:bg-brand-hover hover:shadow-[0_6px_20px_-6px_#7C3AED]',
      ghost:   'bg-[#12111B] text-[#C8C2D8] outline outline-1 outline-offset-[-.5px] outline-[#2A2740] hover:bg-[#1B1A29] hover:text-white hover:outline-brand',
      glass:   'bg-white/10 text-white hover:bg-white/15',
      dashed:  'border border-dashed border-white/25 text-white/90 hover:border-white/45 hover:text-white',
    }
    const btn = (size = 'md', tone = 'ghost') => `${BTN_BASE} ${BTN_SIZES[size]} ${BTN_TONES[tone]}`

    // Formulários e cards
    const FIELD_BASE = 'w-full border-0 bg-[#0A0910] font-medium text-ink outline outline-1 outline-offset-[-.5px] outline-[#262433] transition [color-scheme:dark] placeholder:text-[#565164] hover:outline-[#3A3650] focus:outline-brand data-[err]:outline-[#F0777C]'

    const UI = {
      card:     'flex flex-col gap-3 rounded-[14px] bg-[#100F16] p-4 outline outline-1 outline-offset-[-.5px] outline-[#201E2B]',
      label:    'flex flex-col gap-1.5 text-[10.5px] font-semibold text-[#8F88A3]',
      field:    `${FIELD_BASE} h-[34px] cursor-pointer appearance-none rounded-[9px] px-3 text-[11px]`,
      textarea: `${FIELD_BASE} mt-2 block h-[76px] resize-none rounded-[9px] px-3.5 py-3 text-[11px]`,
    }

    const PILL = 'whitespace-nowrap rounded-full bg-field px-3.5 py-[9px] text-[11.5px] font-medium text-pill outline outline-1 outline-offset-[-.5px] outline-line transition hover:bg-field-hover hover:text-white active:scale-[.97] data-[on]:bg-brand data-[on]:font-semibold data-[on]:text-white data-[on]:outline-transparent'

    const STATUS_BASE = 'shrink-0 rounded-full px-2.5 py-1 text-[9.5px] font-bold outline outline-1 outline-offset-[-.5px]'

    /* =========================================================
       3. DADOS
    ========================================================= */
    let requests = <?= js_json(admin_solicitacoes($pdo)) ?>;

    /* =========================================================
       4. ESTADO
    ========================================================= */
    const wanted = +(new URLSearchParams(location.search).get('id')) || null
    const wantedRequest = requests.find((r) => r.id === wanted)
    let activeTab = wantedRequest ? wantedRequest.status : 'pendente'
    let selectedId = wantedRequest ? wantedRequest.id : ((requests.filter((r) => r.status === 'pendente')[0] || {}).id || null)

    const selectedRequest = () => requests.find((r) => r.id === selectedId)
    const countBy = (tab) => requests.filter(TAB_FILTERS[tab]).length
    const firstName = (r) => r.client.split(' ')[0]

    /* =========================================================
       5. UTILITÁRIOS
    ========================================================= */
    const $  = (sel) => document.querySelector(sel)
    const $$ = (sel) => document.querySelectorAll(sel)
    const escapeHTML = (s) => s.replace(/[&<>"]/g, (c) => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;' }[c]))
    const icon = (name, size = 15, extra = '') => `<svg class="shrink-0 ${extra}" style="width:${size}px;height:${size}px"><use href="#i-${name}"/></svg>`
    const isImage = (filename) => /\.(jpe?g|png|gif|webp)$/i.test(filename)
    const formatSize = (bytes) =>
      bytes > 1e6 ? `${(bytes / 1e6).toFixed(1).replace('.', ',')} MB` : `${Math.max(1, Math.round(bytes / 1e3))} KB`

    let toastTimer
    function showToast(message) {
      const el = $('#toast')
      el.textContent = message
      el.toggleAttribute('data-show', true)
      clearTimeout(toastTimer)
      toastTimer = setTimeout(() => el.toggleAttribute('data-show', false), 2200)
    }

    // Aplica as classes reutilizáveis aos elementos marcados com data-ui
    // Ex.: data-ui="card"  |  data-ui="btn md primary"
    function applyUI() {
      $$('[data-ui]').forEach((el) => {
        const [name, ...args] = el.dataset.ui.split(' ')
        el.className = name === 'btn' ? btn(...args) : UI[name]
      })
    }

    /* =========================================================
       6. RENDER
    ========================================================= */
    function renderNav() {
      $('#nav').innerHTML = NAV_ITEMS.map((item) => `
        <a href="${item.href}" ${item.active ? 'data-on aria-current="page"' : ''}
           class="group flex items-center gap-2.5 rounded-[9px] px-2.5 py-[9px] text-[12.5px] font-medium text-soft transition hover:bg-panel hover:text-ink data-[on]:bg-brand data-[on]:font-semibold data-[on]:text-white">
          ${icon(item.icon, 15, 'text-mute transition group-hover:text-[#C9C9D4] group-data-[on]:text-white')}
          <span class="flex-1">${item.label}</span>
          ${item.badge ? `<i class="rounded-full bg-brand-dark px-1.5 py-0.5 text-[9px] font-bold not-italic text-white">${countBy('pendente')}</i>` : ''}
        </a>`).join('')
    }

    function renderTabs() {
      $('#tabs').innerHTML = TABS.map((t) => `
        <button role="tab" data-tab="${t.id}" aria-selected="${activeTab === t.id}" ${activeTab === t.id ? 'data-on' : ''} class="${PILL}">
          ${t.label}${t.count ? ` · ${countBy(t.id)}` : ''}
        </button>`).join('')
    }

    function renderList() {
      const rows = requests.filter(TAB_FILTERS[activeTab])
      $('#list').innerHTML = rows.length ? rows.map((r, i) => {
        const selected = r.id === selectedId
        const style = selected
          ? 'rounded-lg bg-[#241640] outline outline-1 outline-offset-[-.5px] outline-[#4B2E85]'
          : `${i ? 'border-t border-line' : ''} transition hover:bg-panel`
        return `
          <a href="#" data-id="${r.id}" ${selected ? 'aria-current="true"' : ''} class="block px-3 py-3.5 ${style}">
            <div class="flex items-baseline justify-between gap-3">
              <h3 class="text-[12.5px] font-bold text-[#EDEDF3]">${escapeHTML(r.title)}</h3>
              <span class="shrink-0 text-[10px] font-medium text-mute">${r.time}</span>
            </div>
            <p class="mt-1.5 text-[10.5px] font-medium text-soft">${escapeHTML(r.client)} · ${escapeHTML(r.project)}</p>
            <span class="mt-2.5 inline-flex w-fit whitespace-nowrap rounded-full px-2 py-[3px] text-[9px] font-bold ${TAG_STYLES[r.tagTone]}">${r.tag}</span>
          </a>`
      }).join('')
        : '<p class="px-3 py-10 text-center text-[10.5px] font-medium text-faint">Nenhuma solicitação aqui.</p>'
    }

    const messageHTML = (m, r) => {
      const fromClientSide = m.from === 'client'
      const attachment = m.file ? `
        <div data-toast="Baixando ${escapeHTML(m.file[0])}…"
             class="inline-flex cursor-pointer items-center gap-3 self-start rounded-lg bg-[#16131E] p-2 pe-4 transition hover:bg-[#1D1928]">
          <span class="grid size-9 shrink-0 place-items-center rounded-md bg-[#2B1B47] text-[#C4B5FD]">${icon(isImage(m.file[0]) ? 'image' : 'file', 15)}</span>
          <span class="leading-none">
            <span class="block text-[11px] font-semibold text-white">${escapeHTML(m.file[0])}</span>
            <span class="mt-[5px] block text-[9.5px] font-medium text-[#6B6579]">${m.file[1]}</span>
          </span>
        </div>` : ''

      return `
        <div class="rounded-lg p-4 ${fromClientSide ? 'bg-[#16131E]' : 'bg-[#2B1B47]/70'}">
          <p class="text-[11px] font-bold text-white">${fromClientSide ? escapeHTML(r.client) : `${m.author || 'Equipe'} · equipe`}</p>
          <p class="mt-2 text-[11.5px] font-medium leading-[1.65] text-[#D5D0E0]">${escapeHTML(m.text)}</p>
          <p class="mt-2.5 text-[9.5px] font-medium text-[#6B6579]">${m.time}</p>
        </div>${attachment}`
    }

    const noteHTML = (note) => `
      <div class="mt-2 flex justify-center">
        <span class="rounded-full bg-[#33280D] px-4 py-1.5 text-center text-[10px] font-bold text-[#E5C465] outline outline-1 outline-offset-[-.5px] outline-[#5A451A]">Nota interna: ${escapeHTML(note)}</span>
      </div>`

    function renderDetail() {
      const r = selectedRequest()
      $('#detail-empty').classList.toggle('hidden', !!r)
      $('#detail-body').classList.toggle('hidden', !r)
      if (!r) return

      $('#detail-title').textContent = r.title
      $('#detail-sub').textContent = `${r.client} · ${r.project}`
      $('#reply-label').textContent = `Responder para ${firstName(r)}`

      const status = STATUS[r.status]
      $('#detail-status').className = `${STATUS_BASE} ${status.style}`
      $('#detail-status').textContent = status.label

      $('#thread').innerHTML = r.messages.map((m) => messageHTML(m, r)).join('') + r.notes.map(noteHTML).join('')
    }

    function renderManage() {
      const r = selectedRequest()
      if (!r) return
      $('#status').innerHTML = Object.entries(STATUS).map(([k, s]) => `<option value="${k}">${s.label}</option>`).join('')
      $('#assignee').innerHTML = '<option value="">Sem responsável</option>' + Object.entries(TEAM).map(([id, m]) => `<option value="${id}">${escapeHTML(m.name)}</option>`).join('')
      $('#priority').innerHTML = Object.entries(PRIORITIES).map(([k, label]) => `<option value="${k}">${label}</option>`).join('')
      $('#status').value = r.status
      $('#assignee').value = r.assignee
      $('#priority').value = r.priority
      $('#btn-resolve').textContent = r.status === 'aprovada' ? 'Abrir projeto' : 'Aprovar e criar projeto'
      $('#contact-by').textContent = r.contactBy
    }


    function renderCannedMenu() {
      $('#canned-menu').innerHTML = CANNED_REPLIES.map((text, i) => `
        <button data-canned="${i}" class="block w-full rounded-[7px] px-2.5 py-2 text-left text-[11px] font-medium leading-snug text-pill hover:bg-[#1F1F28] hover:text-white">${text}</button>`).join('')
    }

    function renderAll() {
      renderNav()
      renderTabs()
      renderList()
      renderDetail()
      renderManage()
    }

    /* =========================================================
       7. AÇÕES
    ========================================================= */
    const reply = $('#reply')

    function hasReplyText() {
      if (reply.value.trim()) return true
      reply.toggleAttribute('data-err', true)
      reply.focus()
      showToast('Escreva uma mensagem primeiro')
      return false
    }

    function clearReply() {
      reply.value = ''
      reply.removeAttribute('data-err')
    }

    async function sendReply() {
      const r = selectedRequest()
      if (!r || !hasReplyText()) return

      const text = reply.value.trim()
      const res = await api('solicitacoes', { acao: 'responder', id: r.id, texto: text })
      if (!res) return

      r.messages.push({ from: 'team', text, time: 'Agora', author: ME.name })
      r.status = res.status
      clearReply()
      showToast(`Resposta salva para ${firstName(r)}`)
      renderAll()
    }

    async function saveNote() {
      const r = selectedRequest()
      if (!r || !hasReplyText()) return

      const text = reply.value.trim()
      const res = await api('solicitacoes', { acao: 'nota', id: r.id, texto: text })
      if (!res) return

      r.notes.push(text)
      clearReply()
      showToast('Nota interna salva')
      renderDetail()
    }

    async function saveChanges(status = null) {
      const r = selectedRequest()
      if (!r) return
      const res = await api('solicitacoes', {
        acao: 'salvar', id: r.id, status: status || $('#status').value,
        responsavel_id: +$('#assignee').value || null, prioridade: $('#priority').value,
      })
      if (!res) return renderManage()
      r.status = status || $('#status').value
      r.assignee = $('#assignee').value
      r.priority = $('#priority').value
      if (res.projetoId) r.projectId = res.projetoId
      showToast(res.projetoId ? 'Solicitação aprovada: projeto criado' : 'Alterações salvas')
      renderAll()
      return res
    }

    async function toggleResolved() {
      const r = selectedRequest()
      if (!r) return
      if (r.status === 'aprovada' && r.projectId) { location.href = `project-area.php?id=${r.projectId}`; return }
      const res = await saveChanges('aprovada')
      if (res && res.projetoId) setTimeout(() => { location.href = `project-area.php?id=${res.projetoId}` }, 900)
    }

    function select(id) {
      selectedId = id
      renderAll()
    }

    /* =========================================================
       8. EVENTOS
    ========================================================= */
    // Abas e lista
    $('#tabs').addEventListener('click', (e) => {
      const tab = e.target.closest('[data-tab]')
      if (!tab) return
      activeTab = tab.dataset.tab
      const rows = requests.filter(TAB_FILTERS[activeTab])
      select(rows.length ? rows[0].id : null)
    })

    $('#list').addEventListener('click', (e) => {
      const item = e.target.closest('[data-id]')
      if (!item) return
      e.preventDefault()
      select(+item.dataset.id)
    })

    // Responder
    $('#btn-send').addEventListener('click', sendReply)
    $('#btn-note').addEventListener('click', saveNote)
    reply.addEventListener('input', () => reply.removeAttribute('data-err'))
    reply.addEventListener('keydown', (e) => { if (e.key === 'Enter' && (e.ctrlKey || e.metaKey)) sendReply() })

    // Respostas prontas
    const cannedWrap = $('#canned-wrap')
    $('#btn-canned').addEventListener('click', (e) => {
      e.stopPropagation()
      cannedWrap.toggleAttribute('data-open')
    })
    $('#canned-menu').addEventListener('click', (e) => {
      const option = e.target.closest('[data-canned]')
      if (!option) return
      reply.value = CANNED_REPLIES[+option.dataset.canned]
      reply.removeAttribute('data-err')
      reply.focus()
      cannedWrap.removeAttribute('data-open')
    })

    // Gerenciar
    $('#btn-save').addEventListener('click', () => saveChanges())
    $('#btn-resolve').addEventListener('click', toggleResolved)

    // Cliques globais: fecha o menu e mostra toasts de elementos com data-toast
    document.addEventListener('click', (e) => {
      cannedWrap.removeAttribute('data-open')
      const el = e.target.closest('[data-toast]')
      if (!el) return
      e.preventDefault()
      showToast(el.dataset.toast)
    })

    /* =========================================================
       9. INICIALIZAÇÃO
    ========================================================= */
    applyUI()
    renderCannedMenu()
    renderAll()
  </script>
</body>
</html>
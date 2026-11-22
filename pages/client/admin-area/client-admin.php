<?php
require_once __DIR__ . '/../../../includes/admin-dados.php';
[$pdo, $admin] = admin_iniciar();
?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin - Clientes</title>

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
      <symbol id="i-up" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m18 15-6-6-6 6"/></symbol>
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

      <header class="flex items-start justify-between gap-4">
        <div>
          <h1 class="mb-[7px] w-fit bg-gradient-to-t from-[#CBAAFF] via-[#7B4BB3] via-60% to-brand bg-clip-text text-[38px] font-extrabold leading-[normal] tracking-[-1.2px] text-transparent max-[760px]:text-[30px]">
            Clientes
          </h1>
          <p id="subtitle" class="text-[12.5px] font-medium text-[#7C7C88]"></p>
        </div>
        <button id="btn-new" class="flex items-center gap-[7px] whitespace-nowrap rounded-[9px] bg-brand px-4 py-2.5 text-xs font-semibold text-white transition hover:bg-brand-hover hover:shadow-[0_6px_20px_-6px_#7C3AED] active:scale-[.97]">
          <svg class="size-3.5 shrink-0"><use href="#i-plus"/></svg>Novo cliente
        </button>
      </header>

      <!-- Busca -->
      <label class="flex h-9 w-[300px] max-w-full items-center gap-2 rounded-[10px] bg-field px-3 outline outline-1 outline-offset-[-.5px] outline-line transition focus-within:outline-brand">
        <svg class="size-[13px] shrink-0 text-faint"><use href="#i-search"/></svg>
        <input id="busca" placeholder="Buscar cliente" autocomplete="off"
               class="min-w-0 flex-1 border-0 bg-transparent text-[11.5px] font-medium outline-none placeholder:text-faint" />
      </label>

      <div class="flex items-start gap-4 max-[1100px]:flex-col">

        <!-- Tabela de clientes -->
        <section class="min-w-0 flex-1 overflow-hidden rounded-[14px] bg-lane outline outline-1 outline-offset-[-.5px] outline-[#1D1D24] max-[1100px]:w-full max-[1100px]:flex-none">
          <div class="overflow-x-auto">
            <div class="min-w-[640px]">
              <div id="table-head" class="flex items-center px-4 pb-[11px] pt-[15px]"></div>
              <div id="rows"></div>
              <div class="h-2.5"></div>
            </div>
          </div>
        </section>

        <!-- Detalhe do cliente -->
        <aside id="detail" class="sticky top-5 flex w-[260px] shrink-0 flex-col gap-4 max-[1100px]:static max-[1100px]:grid max-[1100px]:w-full max-[1100px]:grid-cols-[repeat(auto-fit,minmax(240px,1fr))] max-[1100px]:items-start"></aside>
      </div>
    </main>
  </div>

  <!-- ===== Modal: novo cliente ===== -->
  <div id="overlay" class="fixed inset-0 z-50 hidden place-items-center bg-black/60 p-5 backdrop-blur-[3px] data-[open]:grid">
    <div class="flex w-full max-w-[440px] flex-col gap-3.5 rounded-2xl bg-lane p-[22px] shadow-[0_30px_70px_rgba(0,0,0,.6)] outline outline-1 outline-line2" role="dialog" aria-modal="true">
      <h2 class="text-lg font-extrabold tracking-[-.4px]">Novo cliente</h2>

      <label data-ui="label">Empresa
        <input id="m-empresa" placeholder="Ex.: Padaria Doce Trigo" data-ui="field" />
      </label>
      <label data-ui="label">Contato principal
        <input id="m-contato" placeholder="Ex.: Marina Rocha" data-ui="field" />
      </label>
      <div class="grid grid-cols-2 gap-3">
        <label data-ui="label">E-mail
          <input id="m-email" type="email" placeholder="contato@empresa.com" required data-ui="field" />
        </label>
        <label data-ui="label">Telefone
          <input id="m-telefone" placeholder="(11) 90000-0000" data-ui="field" />
        </label>
      </div>

      <p class="text-[10.5px] font-medium text-soft">O cliente entra com o e-mail e uma senha provisória gerada ao criar a conta.</p>
      <div id="m-resultado" class="hidden select-all break-words rounded-[9px] bg-[#0D2A1C] px-3 py-2.5 text-[11px] font-semibold text-[#54D68E]"></div>

      <div class="flex justify-end gap-2 pt-1">
        <button id="m-cancelar" data-ui="btn md ghost">Cancelar</button>
        <button id="m-criar" data-ui="btn md primary">Criar cliente</button>
      </div>
    </div>
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
    const MONTHS = ['jan', 'fev', 'mar', 'abr', 'mai', 'jun', 'jul', 'ago', 'set', 'out', 'nov', 'dez']

    const NAV_ITEMS = <?= js_json(admin_nav($pdo, 'client-admin.php')) ?>;

    const TAG_STYLES = {
      warn:    'bg-[#2F260F] text-[#E5C465]',
      red:     'bg-[#33131B] text-[#F0777C]',
      ok:      'bg-[#0D2A1C] text-[#54D68E]',
      neutral: 'bg-[#232329] text-[#A0A0AA]',
    }
    const STATUS_TONE = { warn: 'warn', risk: 'red', ok: 'ok', done: 'neutral', new: 'neutral' }
    const NEUTRAL_STATUSES = ['done', 'new']

    const COLUMNS = [
      { key: 'name',   label: 'Empresa',         width: 'min-w-0 flex-1' },
      { key: 'ativos', label: 'Projetos ativos', width: 'w-24 shrink-0' },
      { key: 'status', label: 'Situação',        width: 'w-44 shrink-0' },
      { key: 'desde',  label: 'Cliente desde', width: 'w-[140px] shrink-0' },
      { key: 'dias',   label: 'Último acesso',   width: 'w-[104px] shrink-0' },
    ]

    const SORTERS = {
      name:   (c) => c.name,
      ativos: (c) => c.projects.length,
      status: (c) => c.statusLabel,
      desde:  (c) => c.sinceTs,
      dias:   (c) => c.daysSinceAccess,
    }

    /* =========================================================
       2. ESTILOS REUTILIZÁVEIS (classes Tailwind)
    ========================================================= */
    // Botões: base + tamanho + tom
    const BTN_BASE  = 'flex items-center justify-center gap-1.5 whitespace-nowrap font-semibold transition active:scale-[.97]'
    const BTN_SIZES = {
      md: 'rounded-[9px] px-4 py-2.5 text-xs',
      sm: 'rounded-lg px-2.5 py-2 text-[10.5px]',
    }
    const BTN_TONES = {
      primary: 'bg-brand text-white hover:bg-brand-hover hover:shadow-[0_6px_20px_-6px_#7C3AED]',
      ghost:   'bg-[#12111B] text-[#C8C2D8] outline outline-1 outline-offset-[-.5px] outline-[#2A2740] hover:bg-[#1B1A29] hover:text-white hover:outline-brand',
      sent:    'pointer-events-none bg-[#0D2A1C] text-[#54D68E]',
    }
    const btn = (size = 'md', tone = 'ghost') => `${BTN_BASE} ${BTN_SIZES[size]} ${BTN_TONES[tone]}`

    // Cards do painel de detalhe e itens internos
    const card = (gap = 'gap-3.5') => `flex flex-col rounded-[14px] bg-[#100F16] p-4 outline outline-1 outline-offset-[-.5px] outline-[#201E2B] ${gap}`
    const TILE = 'flex items-center justify-between gap-2 rounded-xl bg-[#15151A] px-3 py-[9px] outline outline-1 outline-offset-[-.5px] outline-[#23232B] transition duration-150 hover:-translate-y-0.5 hover:bg-[#18181F] hover:shadow-[0_10px_24px_-10px_rgba(124,58,237,.35)] hover:outline-brand-dark'

    const AVATAR = {
      base:    'grid shrink-0 place-items-center rounded-full font-bold',
      violet:  'bg-[#2B1B47] text-[#C4B5FD]',
      neutral: 'bg-[#232329] text-[#A0A0AA]',
    }

    const UI = {
      label: 'flex flex-col gap-1.5 text-[11px] font-semibold text-soft',
      field: 'h-[38px] rounded-[9px] bg-field px-3 text-xs font-medium text-ink outline outline-1 outline-offset-[-.5px] outline-line transition [color-scheme:dark] placeholder:text-faint focus:outline-brand data-[err]:outline-[#F0777C]',
    }

    /* =========================================================
       3. DADOS
    ========================================================= */
    let clients = <?= js_json(admin_clientes($pdo)) ?>;

    /* =========================================================
       4. ESTADO
    ========================================================= */
    let selectedId = +(new URLSearchParams(location.search).get('id')) || (clients[0] ? clients[0].id : null)
    let sort = { key: null, dir: 1 }
    let search = ''

    const selectedClient = () => clients.find((c) => c.id === selectedId)

    function visibleClients() {
      let list = clients.filter((c) => `${c.name} ${c.contact}`.toLowerCase().includes(search))
      if (sort.key) {
        const get = SORTERS[sort.key]
        list = [...list].sort((a, b) => {
          const x = get(a), y = get(b)
          return (typeof x === 'string' ? x.localeCompare(y, 'pt-BR') : x - y) * sort.dir
        })
      }
      return list
    }

    // Ordenação alterna: crescente -> decrescente -> sem ordem
    function toggleSort(key) {
      if (sort.key !== key) sort = { key, dir: 1 }
      else if (sort.dir > 0) sort.dir = -1
      else sort = { key: null, dir: 1 }
    }

    /* =========================================================
       5. UTILITÁRIOS
    ========================================================= */
    const $  = (sel) => document.querySelector(sel)
    const $$ = (sel) => document.querySelectorAll(sel)
    const escapeHTML = (s) => s.replace(/[&<>"]/g, (c) => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;' }[c]))
    const icon = (name, size = 15, extra = '') => `<svg class="shrink-0 ${extra}" style="width:${size}px;height:${size}px"><use href="#i-${name}"/></svg>`
    const money = (n) => `R$ ${n.toLocaleString('pt-BR')}`
    const firstName = (fullName) => fullName.split(' ')[0]
    const avatarTone = (c) => (NEUTRAL_STATUSES.includes(c.status) ? AVATAR.neutral : AVATAR.violet)

    let toastTimer
    function showToast(message) {
      const el = $('#toast')
      el.textContent = message
      el.toggleAttribute('data-show', true)
      clearTimeout(toastTimer)
      toastTimer = setTimeout(() => el.toggleAttribute('data-show', false), 2200)
    }

    // Aplica as classes reutilizáveis aos elementos marcados com data-ui
    // Ex.: data-ui="field"  |  data-ui="btn md primary"
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
        <a href="${item.href}" ${item.active ? 'data-on' : ''}
           class="group flex items-center gap-2.5 rounded-[9px] px-2.5 py-[9px] text-[12.5px] font-medium text-soft transition hover:bg-panel hover:text-ink data-[on]:bg-brand data-[on]:font-semibold data-[on]:text-white">
          ${icon(item.icon, 15, 'text-mute transition group-hover:text-[#C9C9D4] group-data-[on]:text-white')}
          <span class="flex-1">${item.label}</span>
          ${item.badge ? `<i class="rounded-full bg-brand-dark px-1.5 py-0.5 text-[9px] font-bold not-italic text-white">${item.badge}</i>` : ''}
        </a>`).join('')
    }

    function renderTableHead() {
      $('#table-head').innerHTML = COLUMNS.map((col) => {
        const active = sort.key === col.key
        const arrow = active ? icon(sort.dir > 0 ? 'up' : 'down', 10) : ''
        return `
          <div class="${col.width}">
            <button data-sort="${col.key}" ${active ? 'data-on' : ''}
                    class="flex items-center gap-1 whitespace-nowrap text-[10px] font-semibold text-mute transition-colors hover:text-white data-[on]:text-[#C4B5FD]">
              ${col.label}${arrow}
            </button>
          </div>`
      }).join('')
    }

    function renderRows() {
      const list = visibleClients()
      const withProjects = list.filter((c) => c.projects.length).length
      $('#subtitle').textContent = `${list.length} ${list.length === 1 ? 'empresa' : 'empresas'} · ${withProjects} com projeto em andamento`

      const [colName, colProjects, colStatus, colTotal, colAccess] = COLUMNS.map((c) => c.width)

      $('#rows').innerHTML = list.map((c) => `
        <button data-id="${c.id}" ${c.id === selectedId ? 'data-on' : ''}
                class="flex h-[46px] w-full items-center border-t border-line px-4 text-left transition-colors first:border-t-0 hover:bg-panel data-[on]:bg-[#241640]">
          <div class="${colName} flex items-center gap-2.5">
            <div class="size-7 text-[9px] ${AVATAR.base} ${avatarTone(c)}">${c.initials}</div>
            <div class="min-w-0">
              <div class="truncate text-[12.5px] font-bold text-[#EDEDF3]">${escapeHTML(c.name)}</div>
              <div class="mt-0.5 truncate text-[10px] font-semibold text-[#75757F]">${escapeHTML(c.contact)}</div>
            </div>
          </div>
          <div class="${colProjects} text-[12.5px] font-semibold">${c.projects.length}</div>
          <div class="${colStatus} flex">
            <span class="whitespace-nowrap rounded-full px-2 py-[3px] text-[9px] font-bold ${TAG_STYLES[STATUS_TONE[c.status]]}">${c.statusLabel}</span>
          </div>
          <div class="${colTotal} text-[12.5px] font-semibold">${escapeHTML(c.since.replace('Cliente desde ', ''))}</div>
          <div class="${colAccess} whitespace-nowrap text-[11.5px] font-medium text-soft">${c.lastAccess}</div>
        </button>`).join('') || '<div class="px-4 py-[34px] text-center text-xs font-medium text-faint">Nenhum cliente encontrado</div>'
    }

    const projectCardHTML = (p) => `
      <a href="project-area.php?id=${p.id}" class="${TILE}">
        <div>
          <div class="text-[11px] font-bold text-[#EDEDF3]">${escapeHTML(p.name)}</div>
          <div class="mt-0.5 text-[9.5px] font-semibold text-[#75757F]">${p.stage}</div>
        </div>
        <div class="text-[12.5px] font-bold">${p.progress}%</div>
      </a>`

    function renderDetail() {
      const c = selectedClient()
      if (!c) {
        $('#detail').innerHTML = `<div class="${card()}"><div class="text-[10.5px] font-medium leading-[17px] text-soft">Selecione um cliente para ver os detalhes.</div></div>`
        return
      }

      const notes = c.notes.map((n) => `<div class="text-[10.5px] font-medium leading-[17px] text-soft">${escapeHTML(n)}</div>`).join('')
        || '<div class="text-[10.5px] font-medium leading-[17px] text-soft">Sem notas internas ainda.</div>'

      $('#detail').innerHTML = `
        <section class="${card()}">
          <div class="flex items-center gap-3">
            <div class="size-11 text-[13px] ${AVATAR.base} ${avatarTone(c)}">${c.initials}</div>
            <div class="min-w-0 flex-1">
              <div class="text-sm font-bold text-[#EFEBF6]">${escapeHTML(c.name)}</div>
              <div class="mt-[3px] text-[10.5px] font-medium text-soft">${escapeHTML(c.since)}</div>
            </div>
          </div>
          <div class="h-px bg-line"></div>
          <div>
            <div class="mb-1 text-[9.5px] font-medium text-soft">Contato principal</div>
            <div class="mb-1 text-[11.5px] font-semibold text-[#EDEDF3]">${escapeHTML(c.contact)}</div>
            <div class="break-words text-[10px] font-medium leading-[14px] text-soft">${escapeHTML(c.email)}${c.phone ? ` · ${escapeHTML(c.phone)}` : ''}</div>
          </div>
        </section>

        <section class="${card('gap-3')}">
          <div class="text-sm font-bold text-[#EFEBF6]">Projetos</div>
          <div class="flex flex-col gap-2">
            ${c.projects.map(projectCardHTML).join('') || '<div class="text-[10.5px] font-medium leading-[17px] text-soft">Nenhum projeto ativo.</div>'}
          </div>
        </section>

        <section class="${card('gap-2.5')}">
          <div class="text-sm font-bold text-[#EFEBF6]">Notas internas</div>
          ${notes}
          <label class="flex h-[46px] items-center rounded-[9px] bg-[#0A0910] px-3 outline outline-1 outline-offset-[-.5px] outline-[#262433] transition focus-within:outline-brand">
            <input id="note-input" placeholder="Adicionar nota interna" autocomplete="off"
                   class="min-w-0 flex-1 border-0 bg-transparent text-[10px] font-medium outline-none placeholder:text-faint" />
          </label>
        </section>`
    }

    function renderAll() {
      renderTableHead()
      renderRows()
      renderDetail()
    }

    /* =========================================================
       7. AÇÕES
    ========================================================= */
    async function addNote(text) {
      const r = await api('clientes', { acao: 'nota', id: selectedId, texto: text })
      if (!r) return
      selectedClient().notes.push(r.nota)
      showToast('Nota adicionada')
      renderDetail()
      $('#note-input').focus()
    }

    const overlay = $('#overlay')
    const openModal  = () => overlay.setAttribute('data-open', '')
    const closeModal = () => overlay.removeAttribute('data-open')

    function resetModal() {
      clienteCriado = false
      $('#m-resultado').classList.add('hidden')
      $('#m-criar').textContent = 'Criar cliente'
      $('#m-cancelar').classList.remove('hidden')
      ;['#m-empresa', '#m-contato', '#m-email', '#m-telefone'].forEach((sel) => {
        $(sel).value = ''
        $(sel).removeAttribute('data-err')
      })
    }

    let clienteCriado = false

    async function createClient() {
      if (clienteCriado) { clienteCriado = false; return closeModal() }

      const company = $('#m-empresa')
      const contact = $('#m-contato')
      const email = $('#m-email')

      let invalid = false
      ;[company, contact, email].forEach((input) => {
        const empty = !input.value.trim()
        input.toggleAttribute('data-err', empty)
        invalid = invalid || empty
      })
      if (invalid) return showToast('Preencha empresa, contato e e-mail')

      const r = await api('clientes', {
        acao: 'criar', empresa: company.value.trim(), contato: contact.value.trim(),
        email: email.value.trim(), telefone: $('#m-telefone').value.trim(),
      })
      if (!r) return

      clients.push(r.cliente)
      selectedId = r.cliente.id
      search = ''
      $('#busca').value = ''
      renderAll()

      // A senha provisória só aparece agora: o banco guarda apenas o hash
      $('#m-resultado').textContent = `Conta criada! Passe ao cliente: ${r.cliente.email} / senha provisória ${r.senha_provisoria}`
      $('#m-resultado').classList.remove('hidden')
      $('#m-criar').textContent = 'Concluir'
      $('#m-cancelar').classList.add('hidden')
      clienteCriado = true
    }

    /* =========================================================
       8. EVENTOS
    ========================================================= */
    // Tabela
    $('#rows').addEventListener('click', (e) => {
      const row = e.target.closest('[data-id]')
      if (!row) return
      selectedId = +row.dataset.id
      renderAll()
    })

    $('#table-head').addEventListener('click', (e) => {
      const button = e.target.closest('[data-sort]')
      if (!button) return
      toggleSort(button.dataset.sort)
      renderTableHead()
      renderRows()
    })

    $('#busca').addEventListener('input', (e) => {
      search = e.target.value.trim().toLowerCase()
      renderRows()
      const list = visibleClients()
      if (list.length && !list.some((c) => c.id === selectedId)) {
        selectedId = list[0].id
        renderDetail()
      }
    })

    // Painel de detalhe
    $('#detail').addEventListener('click', (e) => {
      const c = selectedClient()
      if (e.target.id === 'btn-message') showToast(`Abrindo conversa com ${firstName(c.contact)}…`)
      if (e.target.id === 'btn-invite' && !c.invited) {
        c.invited = true
        showToast(`Convite reenviado para ${c.email}`)
        renderDetail()
      }
    })

    $('#detail').addEventListener('keydown', (e) => {
      if (e.target.id !== 'note-input' || e.key !== 'Enter') return
      const text = e.target.value.trim()
      if (text) addNote(text)
    })

    // Modal "Novo cliente"
    $('#btn-new').addEventListener('click', () => { resetModal(); openModal(); $('#m-empresa').focus() })
    $('#m-cancelar').addEventListener('click', closeModal)
    $('#m-criar').addEventListener('click', createClient)
    overlay.addEventListener('mousedown', (e) => { if (e.target === overlay) closeModal() })

    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') closeModal()
      if (e.key === 'Enter' && overlay.hasAttribute('data-open') && e.target.tagName === 'INPUT') createClient()
    })

    /* =========================================================
       9. INICIALIZAÇÃO
    ========================================================= */
    applyUI()
    renderNav()
    renderAll()
  </script>
</body>
</html>
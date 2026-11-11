<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin - Projetos</title>

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
    </defs>
  </svg>

  <div class="flex min-h-screen w-full">

    <!-- ===== Sidebar ===== -->
    <aside class="sticky top-0 flex h-screen w-[220px] shrink-0 flex-col justify-between border-r border-edge bg-sidebar px-3.5 py-5 max-[760px]:hidden">
      <div>
        <div class="flex items-center gap-2.5 px-1.5 pb-[18px]">
          <div class="grid size-[34px] place-items-center rounded-[10px] bg-brand text-[13px] font-extrabold tracking-[-.5px] text-white">DI</div>
          <div>
            <div class="text-[14.5px] font-extrabold">Deu Bug!</div>
            <div class="mt-px text-[8px] font-bold tracking-[1.6px] text-mute">ADMIN</div>
          </div>
        </div>
        <nav id="nav" class="flex flex-col gap-[3px] pt-2.5"></nav>
      </div>

      <div class="flex flex-col gap-2.5">
        <a href="#" class="flex justify-center rounded-[10px] bg-panel px-3 py-[9px] text-[11.5px] font-medium text-[#C9C9D4] outline outline-1 outline-offset-[-.5px] outline-line2 transition hover:bg-panel-hover hover:text-white hover:outline-brand">
          Ver como cliente
        </a>
        <button class="flex w-full items-center gap-[9px] rounded-[10px] bg-panel px-2 py-[7px] text-left transition hover:bg-panel-hover">
          <div class="grid size-7 shrink-0 place-items-center rounded-full bg-[#6D28D9] text-[9.5px] font-bold text-white">RL</div>
          <div class="flex-1">
            <div class="text-[11.5px] font-semibold">Rafael Lima</div>
            <div class="mt-px text-[9px] font-medium text-mute">Gerente de projetos</div>
          </div>
          <svg class="size-[13px] shrink-0 text-faint"><use href="#i-ud"/></svg>
        </button>
      </div>
    </aside>

    <!-- ===== Conteúdo ===== -->
    <main class="flex min-w-0 flex-1 flex-col gap-[18px] px-[30px] py-[26px] max-[760px]:px-4 max-[760px]:py-5">

      <header class="flex items-start justify-between gap-4">
        <div>
          <h1 class="mb-[7px] w-fit bg-gradient-to-t from-[#CBAAFF] via-[#7B4BB3] via-60% to-brand bg-clip-text text-[38px] font-extrabold leading-[normal] tracking-[-1.2px] text-transparent max-[760px]:text-[30px]">
            Projetos
          </h1>
          <p class="text-[12.5px] font-medium text-[#7C7C88]">Arraste os cards entre as colunas para mudar a etapa.</p>
        </div>
        <button id="novo" class="flex items-center gap-[7px] whitespace-nowrap rounded-[9px] bg-brand px-4 py-2.5 text-xs font-semibold text-white transition hover:bg-brand-hover hover:shadow-[0_6px_20px_-6px_#7C3AED] active:scale-[.97]">
          <svg class="size-3.5 shrink-0"><use href="#i-plus"/></svg>Novo projeto
        </button>
      </header>

      <!-- Filtros -->
      <div class="flex flex-wrap items-center justify-between gap-3">
        <div class="flex flex-wrap items-center gap-2">
          <label class="flex h-9 w-[300px] max-w-full items-center gap-2 rounded-[10px] bg-field px-3 outline outline-1 outline-offset-[-.5px] outline-line transition focus-within:outline-brand">
            <svg class="size-[13px] shrink-0 text-faint"><use href="#i-search"/></svg>
            <input id="busca" placeholder="Buscar projeto ou cliente" autocomplete="off"
                   class="min-w-0 flex-1 border-0 bg-transparent text-[11.5px] font-medium outline-none placeholder:text-faint" />
          </label>
          <div id="pills" class="contents"></div>
        </div>

        <div id="dd" class="group relative">
          <button id="dd-btn" class="flex items-center justify-between gap-6 rounded-[10px] bg-field px-3.5 py-[9px] text-[11.5px] font-medium text-pill outline outline-1 outline-offset-[-.5px] outline-line transition hover:text-white hover:outline-brand group-data-[open]:text-white group-data-[open]:outline-brand">
            <span id="dd-label">Todos os responsáveis</span>
            <svg class="size-[13px] shrink-0 text-faint transition-transform duration-150 group-data-[open]:rotate-180"><use href="#i-down"/></svg>
          </button>
          <div id="dd-menu" class="absolute right-0 top-[calc(100%+6px)] z-20 hidden min-w-full rounded-[10px] bg-panel p-[5px] shadow-[0_14px_34px_rgba(0,0,0,.5)] outline outline-1 outline-line2 group-data-[open]:block"></div>
        </div>
      </div>

      <!-- Kanban -->
      <div id="kanban" class="grid grid-cols-[repeat(5,minmax(0,1fr))] items-start gap-3 max-[1180px]:grid-cols-[repeat(5,260px)] max-[1180px]:overflow-x-auto max-[1180px]:pb-2"></div>
    </main>
  </div>

  <!-- ===== Modal: novo projeto ===== -->
  <div id="overlay" class="fixed inset-0 z-50 hidden place-items-center bg-black/60 p-5 backdrop-blur-[3px] data-[open]:grid">
    <div class="flex w-full max-w-[440px] flex-col gap-3.5 rounded-2xl bg-lane p-[22px] shadow-[0_30px_70px_rgba(0,0,0,.6)] outline outline-1 outline-line2" role="dialog" aria-modal="true">
      <h2 class="text-lg font-extrabold tracking-[-.4px]">Novo projeto</h2>

      <label class="flex flex-col gap-1.5 text-[11px] font-semibold text-soft">Título
        <input id="m-titulo" placeholder="Ex.: Landing page"
               class="h-[38px] rounded-[9px] bg-field px-3 text-xs font-medium text-ink outline outline-1 outline-offset-[-.5px] outline-line transition [color-scheme:dark] placeholder:text-faint focus:outline-brand" />
      </label>

      <label class="flex flex-col gap-1.5 text-[11px] font-semibold text-soft">Cliente
        <input id="m-cliente" placeholder="Ex.: Padaria Doce Trigo"
               class="h-[38px] rounded-[9px] bg-field px-3 text-xs font-medium text-ink outline outline-1 outline-offset-[-.5px] outline-line transition [color-scheme:dark] placeholder:text-faint focus:outline-brand" />
      </label>

      <div class="grid grid-cols-2 gap-3">
        <label class="flex flex-col gap-1.5 text-[11px] font-semibold text-soft">Responsável
          <select id="m-resp"
                  class="h-[38px] rounded-[9px] bg-field px-3 text-xs font-medium text-ink outline outline-1 outline-offset-[-.5px] outline-line transition [color-scheme:dark] focus:outline-brand"></select>
        </label>
        <label class="flex flex-col gap-1.5 text-[11px] font-semibold text-soft">Prazo
          <input id="m-prazo" type="date"
                 class="h-[38px] rounded-[9px] bg-field px-3 text-xs font-medium text-ink outline outline-1 outline-offset-[-.5px] outline-line transition [color-scheme:dark] focus:outline-brand" />
        </label>
      </div>

      <label class="flex flex-col gap-1.5 text-[11px] font-semibold text-soft">Etapa
        <select id="m-etapa"
                class="h-[38px] rounded-[9px] bg-field px-3 text-xs font-medium text-ink outline outline-1 outline-offset-[-.5px] outline-line transition [color-scheme:dark] focus:outline-brand"></select>
      </label>

      <div class="flex justify-end gap-2 pt-1">
        <button id="m-cancelar" class="flex items-center gap-[7px] whitespace-nowrap rounded-[9px] bg-panel px-4 py-2.5 text-xs font-semibold text-[#C9C9D4] outline outline-1 outline-line2 transition hover:bg-panel-hover active:scale-[.97]">Cancelar</button>
        <button id="m-criar" class="flex items-center gap-[7px] whitespace-nowrap rounded-[9px] bg-brand px-4 py-2.5 text-xs font-semibold text-white transition hover:bg-brand-hover hover:shadow-[0_6px_20px_-6px_#7C3AED] active:scale-[.97]">Criar projeto</button>
      </div>
    </div>
  </div>

  <!-- Toast -->
  <div id="toast" class="pointer-events-none fixed bottom-6 left-1/2 z-[60] -translate-x-1/2 translate-y-5 rounded-[10px] bg-panel px-4 py-2.5 text-xs font-semibold opacity-0 outline outline-1 outline-brand-dark transition duration-[250ms] data-[show]:translate-y-0 data-[show]:opacity-100"></div>


  <script>
    /* =========================================================
       1. CONFIGURAÇÃO
    ========================================================= */
    const STAGES = ['Briefing', 'Design', 'Desenvolvimento', 'Revisão', 'Publicado']
    const LAST_STAGE = STAGES.length - 1
    const MONTHS = ['jan', 'fev', 'mar', 'abr', 'mai', 'jun', 'jul', 'ago', 'set', 'out', 'nov', 'dez']
    const YEAR = new Date().getFullYear()
    const CURRENT_USER = 'RL'

    const OWNERS = {
      RL: { name: 'Rafael Lima',    color: 'bg-[#5B21B6]' },
      DN: { name: 'Diego Nunes',    color: 'bg-brand-dark' },
      AC: { name: 'Ana Costa',      color: 'bg-brand-dark' },
      LA: { name: 'Lucas Almeida',  color: 'bg-[#6D28D9]' },
      BT: { name: 'Bruna Teixeira', color: 'bg-[#0F766E]' },
    }

    const TAG_STYLES = {
      warn: 'bg-[#2F260F] text-[#E5C465]',
      red:  'bg-[#33131B] text-[#F0777C]',
      org:  'bg-[#33190D] text-[#F0944E]',
      ok:   'bg-[#0D2A1C] text-[#54D68E]',
    }

    const NAV_ITEMS = [
      { icon: 'dash',   label: 'Visão geral' },
      { icon: 'folder', label: 'Projetos', active: true },
      { icon: 'users',  label: 'Clientes' },
      { icon: 'inbox',  label: 'Solicitações', badge: 5 },
      { icon: 'card',   label: 'Financeiro' },
    ]

    const FILTERS = [
      { id: 'todos', label: 'Todos' },
      { id: 'meus',  label: 'Meus projetos' },
      { id: 'pend',  label: 'Com pendência' },
      { id: 'atr',   label: 'Atrasados' },
    ]

    /* =========================================================
       2. DADOS
    ========================================================= */
    let nextId = 0
    const project = (stage, client, title, progress, day, month, owner, tag = null, tagStyle = null) =>
      ({ id: ++nextId, stage, client, title, progress, day, month, owner, tag, tagStyle })

    let projects = [
      project(0, 'Studio Aurora Pilates', 'Landing Aurora Pilates', 15, 5, 10, 'RL', 'Fotos pendentes', 'warn'),
      project(0, 'Móveis Pereira', 'Catálogo online', 8, 28, 10, 'RL'),
      project(0, 'Escola Pequeno Mundo', 'Site institucional', 5, 10, 11, 'DN'),

      project(1, 'Clínica Vida Plena', 'Site Clínica Vida Plena', 35, 21, 9, 'AC', 'Vence em 2 dias', 'red'),
      project(1, 'Padaria Doce Trigo', 'Promoção de Natal', 22, 20, 11, 'AC'),
      project(1, 'Café Girassol', 'Identidade para o cardápio digital', 40, 14, 10, 'AC'),

      project(2, 'Padaria Doce Trigo', 'Loja online Doce Trigo', 62, 14, 10, 'LA'),
      project(2, 'Café Girassol', 'Loja Café Girassol', 48, 12, 10, 'LA', 'Fatura em atraso', 'org'),
      project(2, 'Studio Aurora Pilates', 'Agendamento de aulas', 70, 2, 10, 'BT'),

      project(3, 'Padaria Doce Trigo', 'Site Doce Trigo', 88, 30, 9, 'AC', 'Aguardando cliente', 'warn'),
      project(3, 'Clínica Vida Plena', 'Área de exames online', 92, 26, 9, 'BT'),
      project(3, 'Móveis Pereira', 'Site institucional', 95, 24, 9, 'LA'),

      project(4, 'Mecânica Irmãos Souza', 'Site Mecânica Irmãos Souza', 100, 18, 9, 'BT', 'No ar desde 18 out', 'ok'),
      project(4, 'Escola Pequeno Mundo', 'Página de matrículas', 100, 2, 9, 'LA', 'No ar desde 02 out', 'ok'),
    ]

    /* =========================================================
       3. ESTADO DOS FILTROS
    ========================================================= */
    const filters = { search: '', quick: 'todos', owner: 'all' }

    /* =========================================================
       4. UTILITÁRIOS
    ========================================================= */
    const $  = (sel) => document.querySelector(sel)
    const $$ = (sel) => document.querySelectorAll(sel)
    const pad = (n) => String(n).padStart(2, '0')
    const escapeHTML = (s) => s.replace(/[&<>"]/g, (c) => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;' }[c]))
    const icon = (name, size = 15, extra = '') => `<svg class="shrink-0 ${extra}" style="width:${size}px;height:${size}px"><use href="#i-${name}"/></svg>`

    let toastTimer
    function showToast(message) {
      const el = $('#toast')
      el.textContent = message
      el.toggleAttribute('data-show', true)
      clearTimeout(toastTimer)
      toastTimer = setTimeout(() => el.toggleAttribute('data-show', false), 2200)
    }

    /* =========================================================
       5. REGRAS DE NEGÓCIO
    ========================================================= */
    const deadline = (p) => new Date(YEAR, p.month, p.day)
    const startOfToday = () => new Date(new Date().setHours(0, 0, 0, 0))
    const isLate = (p) => p.stage < LAST_STAGE && deadline(p) < startOfToday()
    const hasPending = (p) => p.tag && p.tagStyle !== 'ok'

    const QUICK_FILTERS = {
      todos: () => true,
      meus:  (p) => p.owner === CURRENT_USER,
      pend:  hasPending,
      atr:   isLate,
    }

    function isVisible(p) {
      const search = filters.search.trim().toLowerCase()
      if (search && !`${p.title} ${p.client}`.toLowerCase().includes(search)) return false
      if (filters.owner !== 'all' && p.owner !== filters.owner) return false
      return QUICK_FILTERS[filters.quick](p)
    }

    function moveProject(p, toStage) {
      const fromStage = p.stage
      p.stage = toStage

      if (toStage === LAST_STAGE) {
        const now = new Date()
        p.progress = 100
        p.tag = `No ar desde ${pad(now.getDate())} ${MONTHS[now.getMonth()]}`
        p.tagStyle = 'ok'
      } else if (fromStage === LAST_STAGE) {
        p.progress = Math.min(p.progress, 95)
        p.tag = p.tagStyle = null
      }

      projects = [...projects.filter((x) => x !== p), p] // vai para o fim da coluna
    }

    /* =========================================================
       6. RENDER
    ========================================================= */
    function renderCard(p) {
      const owner = OWNERS[p.owner]
      const published = p.stage === LAST_STAGE

      const tag = p.tag
        ? `<div class="w-fit whitespace-nowrap rounded-full px-2 py-[3px] text-[9px] font-bold ${TAG_STYLES[p.tagStyle]}">${escapeHTML(p.tag)}</div>`
        : ''

      const meta = published ? '' : `
        <div class="flex items-center justify-between pt-[3px]">
          <span class="text-[10px] font-bold text-[#C9C9D2]">${p.progress}%</span>
          <span class="text-[9.5px] font-medium ${isLate(p) ? 'text-[#F0777C]' : 'text-[#6B6B76]'}">Prazo ${pad(p.day)} ${MONTHS[p.month]}</span>
        </div>`

      return `
        <div draggable="true" data-id="${p.id}"
             class="flex cursor-grab select-none flex-col gap-[7px] rounded-xl bg-[#15151A] p-3 outline outline-1 outline-offset-[-.5px] outline-[#23232B] transition duration-150 hover:-translate-y-0.5 hover:bg-[#18181F] hover:shadow-[0_10px_24px_-10px_rgba(124,58,237,.35)] hover:outline-brand-dark data-[drag]:cursor-grabbing data-[drag]:opacity-[.35]">
          <div class="text-[9.5px] font-semibold leading-3 text-[#75757F]">${escapeHTML(p.client)}</div>
          <div class="text-[12.5px] font-bold leading-4 text-[#EDEDF3]">${escapeHTML(p.title)}</div>
          ${tag}
          ${meta}
          <div class="h-[3px] rounded-sm bg-[#23232B]">
            <div class="h-[3px] rounded-sm transition-[width] duration-300 ${published ? 'bg-[#22C55E]' : 'bg-brand'}" style="width:${p.progress}%"></div>
          </div>
          <div class="flex items-center gap-1.5 pt-[3px] text-[9.5px] font-medium text-[#9A9AA4]">
            <div class="grid size-[18px] shrink-0 place-items-center rounded-full text-[7.5px] font-bold text-white ${owner.color}">${p.owner}</div>
            ${owner.name}
          </div>
        </div>`
    }

    function renderColumn(name, index) {
      const cards = projects.filter((p) => p.stage === index && isVisible(p))
      const body = cards.map(renderCard).join('') ||
        '<div class="rounded-[10px] border border-dashed border-[#23232B] py-[18px] text-center text-[10.5px] font-medium text-faint">Nenhum projeto</div>'

      return `
        <section data-stage="${index}"
                 class="overflow-hidden rounded-[14px] bg-lane outline outline-1 outline-offset-[-.5px] outline-[#1D1D24] transition data-[over]:bg-[#13101C] data-[over]:outline-dashed data-[over]:outline-brand">
          <div class="flex items-center justify-between bg-panel p-[13px]">
            <span class="text-[12.5px] font-bold text-[#E8E8EE]">${name}</span>
            <span class="rounded-full bg-[#232329] px-[7px] py-0.5 text-[10px] font-bold text-[#A0A0AA]">${cards.length}</span>
          </div>
          <div class="flex min-h-[60px] flex-col gap-2.5 p-2.5">${body}</div>
        </section>`
    }

    const renderBoard = () => { $('#kanban').innerHTML = STAGES.map(renderColumn).join('') }

    function renderNav() {
      $('#nav').innerHTML = NAV_ITEMS.map((item) => `
        <a href="#" ${item.active ? 'data-on' : ''}
           class="group flex items-center gap-2.5 rounded-[9px] px-2.5 py-[9px] text-[12.5px] font-medium text-soft transition hover:bg-panel hover:text-ink data-[on]:bg-brand data-[on]:font-semibold data-[on]:text-white">
          ${icon(item.icon, 15, 'text-mute transition group-hover:text-[#C9C9D4] group-data-[on]:text-white')}
          <span class="flex-1">${item.label}</span>
          ${item.badge ? `<i class="rounded-full bg-brand-dark px-1.5 py-0.5 text-[9px] font-bold not-italic text-white">${item.badge}</i>` : ''}
        </a>`).join('')
    }

    function renderPills() {
      $('#pills').innerHTML = FILTERS.map((f) => `
        <button data-filter="${f.id}" ${f.id === filters.quick ? 'data-on' : ''}
                class="whitespace-nowrap rounded-full bg-field px-3.5 py-[9px] text-[11.5px] font-medium text-pill outline outline-1 outline-offset-[-.5px] outline-line transition hover:bg-field-hover hover:text-white data-[on]:bg-brand data-[on]:font-semibold data-[on]:text-white data-[on]:outline-transparent">
          ${f.label}
        </button>`).join('')
    }

    function renderOwnerMenu() {
      const options = [['all', 'Todos os responsáveis'], ...Object.entries(OWNERS).map(([id, o]) => [id, o.name])]
      $('#dd-menu').innerHTML = options.map(([id, name]) => `
        <button data-owner="${id}" ${id === filters.owner ? 'data-on' : ''}
                class="block w-full whitespace-nowrap rounded-[7px] px-2.5 py-2 text-left text-[11.5px] font-medium text-pill hover:bg-[#1F1F28] hover:text-white data-[on]:bg-brand-dark data-[on]:text-white">
          ${name}
        </button>`).join('')
    }

    /* =========================================================
       7. EVENTOS: DRAG & DROP
    ========================================================= */
    let draggingId = null
    const board = $('#kanban')

    const clearDragMarks = () =>
      $$('[data-drag],[data-over]').forEach((el) => { el.removeAttribute('data-drag'); el.removeAttribute('data-over') })

    board.addEventListener('dragstart', (e) => {
      const card = e.target.closest('[data-id]')
      if (!card) return
      draggingId = +card.dataset.id
      card.setAttribute('data-drag', '')
      e.dataTransfer.effectAllowed = 'move'
      e.dataTransfer.setData('text/plain', draggingId)
    })

    board.addEventListener('dragend', () => {
      draggingId = null
      clearDragMarks()
    })

    board.addEventListener('dragover', (e) => {
      const column = e.target.closest('[data-stage]')
      if (!column || draggingId == null) return
      e.preventDefault()
      $$('[data-over]').forEach((el) => el !== column && el.removeAttribute('data-over'))
      column.setAttribute('data-over', '')
    })

    board.addEventListener('drop', (e) => {
      const column = e.target.closest('[data-stage]')
      if (!column || draggingId == null) return
      e.preventDefault()

      const p = projects.find((x) => x.id === draggingId)
      const toStage = +column.dataset.stage
      if (p.stage !== toStage) {
        moveProject(p, toStage)
        showToast(`“${p.title}” movido para ${STAGES[toStage]}`)
      }
      renderBoard()
    })

    /* =========================================================
       8. EVENTOS: FILTROS
    ========================================================= */
    $('#busca').addEventListener('input', (e) => {
      filters.search = e.target.value
      renderBoard()
    })

    $('#pills').addEventListener('click', (e) => {
      const pill = e.target.closest('[data-filter]')
      if (!pill) return
      filters.quick = pill.dataset.filter
      $$('#pills [data-filter]').forEach((el) => el.toggleAttribute('data-on', el === pill))
      renderBoard()
    })

    const dropdown = $('#dd')
    $('#dd-btn').addEventListener('click', (e) => {
      e.stopPropagation()
      dropdown.toggleAttribute('data-open')
    })
    document.addEventListener('click', () => dropdown.removeAttribute('data-open'))

    $('#dd-menu').addEventListener('click', (e) => {
      const option = e.target.closest('[data-owner]')
      if (!option) return
      filters.owner = option.dataset.owner
      $('#dd-label').textContent = option.textContent.trim()
      $$('#dd-menu [data-owner]').forEach((el) => el.toggleAttribute('data-on', el === option))
      dropdown.removeAttribute('data-open')
      renderBoard()
    })

    /* =========================================================
       9. EVENTOS: MODAL "NOVO PROJETO"
    ========================================================= */
    const overlay = $('#overlay')
    const openModal  = () => overlay.setAttribute('data-open', '')
    const closeModal = () => overlay.removeAttribute('data-open')

    function resetModal() {
      const defaultDeadline = new Date()
      defaultDeadline.setDate(defaultDeadline.getDate() + 14)

      $('#m-titulo').value = ''
      $('#m-cliente').value = ''
      $('#m-prazo').value = `${defaultDeadline.getFullYear()}-${pad(defaultDeadline.getMonth() + 1)}-${pad(defaultDeadline.getDate())}`
      $('#m-resp').value = CURRENT_USER
      $('#m-etapa').value = 0
    }

    function createProject() {
      const title = $('#m-titulo').value.trim()
      const client = $('#m-cliente').value.trim()

      if (!title || !client) {
        showToast('Preencha título e cliente')
        ;(!title ? $('#m-titulo') : $('#m-cliente')).focus()
        return
      }

      const [, month, day] = ($('#m-prazo').value || '').split('-').map(Number)
      const today = new Date()
      const due = day ? { day, month: month - 1 } : { day: today.getDate(), month: today.getMonth() }

      projects.push(project(+$('#m-etapa').value, client, title, 0, due.day, due.month, $('#m-resp').value))
      closeModal()
      renderBoard()
      showToast('Projeto criado')
    }

    $('#novo').addEventListener('click', () => { resetModal(); openModal(); $('#m-titulo').focus() })
    $('#m-cancelar').addEventListener('click', closeModal)
    $('#m-criar').addEventListener('click', createProject)
    overlay.addEventListener('mousedown', (e) => { if (e.target === overlay) closeModal() })

    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') closeModal()
      if (e.key === 'Enter' && overlay.hasAttribute('data-open') && e.target.tagName === 'INPUT') createProject()
    })

    /* =========================================================
       10. INICIALIZAÇÃO
    ========================================================= */
    $('#m-resp').innerHTML  = Object.entries(OWNERS).map(([id, o]) => `<option value="${id}">${o.name}</option>`).join('')
    $('#m-etapa').innerHTML = STAGES.slice(0, LAST_STAGE).map((name, i) => `<option value="${i}">${name}</option>`).join('')

    renderNav()
    renderPills()
    renderOwnerMenu()
    renderBoard()
  </script>
</body>
</html>
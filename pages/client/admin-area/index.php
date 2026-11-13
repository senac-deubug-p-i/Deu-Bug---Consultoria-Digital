<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin - Visão geral</title>

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
            Visão geral
          </h1>
          <p class="text-[12.5px] font-medium text-[#7C7C88]">Segunda, 19 de outubro · 14 projetos ativos</p>
        </div>
        <a href="project.php" data-toast="Abrindo novo projeto…" class="flex items-center gap-[7px] whitespace-nowrap rounded-[9px] bg-brand px-4 py-2.5 text-xs font-semibold text-white transition hover:bg-brand-hover hover:shadow-[0_6px_20px_-6px_#7C3AED] active:scale-[.97]">
          <svg class="size-3.5 shrink-0"><use href="#i-plus"/></svg>Novo projeto
        </a>
      </header>

      <!-- Busca -->
      <label class="flex h-9 w-[300px] max-w-full items-center gap-2 rounded-[10px] bg-field px-3 outline outline-1 outline-offset-[-.5px] outline-line transition focus-within:outline-brand">
        <svg class="size-[13px] shrink-0 text-faint"><use href="#i-search"/></svg>
        <input id="busca" placeholder="Buscar cliente ou projeto" autocomplete="off"
               class="min-w-0 flex-1 border-0 bg-transparent text-[11.5px] font-medium outline-none placeholder:text-faint" />
      </label>

      <!-- Indicadores -->
      <section id="kpis" class="grid grid-cols-5 gap-2.5 max-[1280px]:grid-cols-3 max-[760px]:grid-cols-2"></section>

      <!-- Atenção + etapas -->
      <div class="flex items-start gap-4 max-[1100px]:flex-col max-[1100px]:items-stretch">
        <section data-ui="section">
          <div class="flex items-center justify-between">
            <div class="text-sm font-bold text-[#E8E8EE]">Precisam de atenção</div>
            <a href="project.php" class="text-[10.5px] font-medium text-soft transition-colors hover:text-white">Ver todos</a>
          </div>
          <div class="flex items-center gap-3 py-[7px] text-[9.5px] font-semibold text-mute">
            <div class="min-w-0 flex-1">Projeto</div>
            <div class="w-40 shrink-0 max-[760px]:hidden">Motivo</div>
            <div class="w-[74px] shrink-0 max-[760px]:hidden">Prazo</div>
            <div class="w-[74px] shrink-0 text-right max-[760px]:hidden">Gerenciar</div>
          </div>
          <div id="attention"></div>
        </section>

        <section data-ui="section" class="!gap-5">
          <div class="text-sm font-bold text-[#E8E8EE]">Projetos por etapa</div>
          <div id="stages" class="flex flex-col gap-5"></div>
          <div class="text-[9.5px] font-medium leading-[13px] text-soft">Total: 14 projetos ativos. Os 8 publicados este ano ficam no histórico.</div>
        </section>
      </div>

      <!-- Solicitações + atividade + carga -->
      <div class="flex items-start gap-4 max-[1100px]:flex-col max-[1100px]:items-stretch">
        <section data-ui="section">
          <div class="flex items-center justify-between">
            <div class="text-sm font-bold text-[#E8E8EE]">Solicitações novas</div>
            <a href="solicitacoes.php" class="text-[10.5px] font-medium text-soft transition-colors hover:text-white">Abrir</a>
          </div>
          <div id="requests" class="flex flex-col gap-2"></div>
        </section>

        <section data-ui="section" class="!gap-2.5">
          <div class="text-sm font-bold text-[#E8E8EE]">Atividade da equipe</div>
          <div id="activity" class="flex flex-col gap-2.5"></div>
        </section>

        <section data-ui="section" class="!gap-[15px]">
          <div class="text-sm font-bold text-[#E8E8EE]">Carga da equipe</div>
          <div id="workload" class="flex flex-col gap-[15px]"></div>
        </section>
      </div>
    </main>
  </div>

  <!-- Toast -->
  <div id="toast" class="pointer-events-none fixed bottom-6 left-1/2 z-[60] -translate-x-1/2 translate-y-5 rounded-[10px] bg-panel px-4 py-2.5 text-xs font-semibold opacity-0 outline outline-1 outline-brand-dark transition duration-[250ms] data-[show]:translate-y-0 data-[show]:opacity-100"></div>


  <script>
    /* =========================================================
       1. CONFIGURAÇÃO
    ========================================================= */
    const DETAIL_PAGE = 'admin-projeto-detalhe.html'

    const NAV_ITEMS = [
      { icon: 'dash',   label: 'Visão geral',  href: 'index.php', active: true },
      { icon: 'folder', label: 'Projetos',     href: 'project.php' },
      { icon: 'users',  label: 'Clientes',     href: 'clientes.php' },
      { icon: 'inbox',  label: 'Solicitações', href: 'solicitacoes.php', badge: 8 },
      { icon: 'card',   label: 'Financeiro',   href: 'financeiro.php' },
    ]

    const TAG_STYLES = {
      warn: 'bg-[#2F260F] text-[#E5C465]',
      red:  'bg-[#33131B] text-[#F0777C]',
      org:  'bg-[#33190D] text-[#F0944E]',
      ok:   'bg-[#0D2A1C] text-[#54D68E]',
    }
    const DOT_COLORS = { brand: 'bg-brand', green: 'bg-[#54D68E]', yellow: 'bg-[#E5C465]' }

    /* =========================================================
       2. ESTILOS REUTILIZÁVEIS (classes Tailwind)
    ========================================================= */
    const UI = {
      // Bloco de conteúdo (mesmo visual das colunas do kanban)
      section: 'flex min-w-0 flex-1 flex-col gap-2 rounded-[14px] bg-lane p-4 outline outline-1 outline-offset-[-.5px] outline-[#1D1D24] max-[1100px]:flex-none',
    }

    // Cards internos (mesmo visual dos cards do kanban)
    const TILE = {
      base:      'rounded-xl outline outline-1 outline-offset-[-.5px] transition duration-150 hover:-translate-y-0.5',
      normal:    'bg-[#15151A] outline-[#23232B] hover:bg-[#18181F] hover:shadow-[0_10px_24px_-10px_rgba(124,58,237,.35)] hover:outline-brand-dark',
      highlight: 'bg-brand outline-brand hover:bg-brand-hover hover:shadow-[0_10px_24px_-10px_#7C3AED] hover:outline-brand-hover',
    }
    const KPI_NOTE_COLOR = { neutral: 'text-soft', positive: 'text-[#54D68E]', negative: 'text-[#F0777C]', highlight: 'text-[#EAE2FF]' }

    const PROGRESS_FILL = 'h-full w-0 rounded-full [transition:width_.7s_cubic-bezier(.2,.8,.2,1),background-color_.15s]'

    const EMPTY = (text) =>
      `<div class="rounded-[10px] border border-dashed border-[#23232B] py-[18px] text-center text-[10.5px] font-medium text-faint">${text}</div>`

    /* =========================================================
       3. DADOS
    ========================================================= */
    const KPIS = [
      { label: 'Projetos ativos',     value: '14',        note: '+2 este mês',                    tone: 'positive',  href: 'project.php' },
      { label: 'Entregas da semana',  value: '5',         note: '2 já enviados ao cliente',       tone: 'neutral',   href: 'project.php' },
      { label: 'Aguardando cliente',  value: '4',         note: 'Aprovações e ajustes pendentes', tone: 'highlight', href: 'project.php' },
      { label: 'Faturas em atraso',   value: '2',         note: 'R$ 2.480,00 · ver financeiro',   tone: 'negative',  href: 'financeiro.php' },
      { label: 'Recebido em outubro', value: 'R$ 18.400', note: '7,4% da meta do mês',            tone: 'positive',  href: 'financeiro.php' },
    ]

    const ATTENTION = [
      { name: 'Site Doce Trigo',         meta: 'Padaria Doce Trigo · Revisão',    reason: 'Layout aguardando cliente', tone: 'warn', deadline: '30 out' },
      { name: 'Site Clínica Vida Plena', meta: 'Clínica Vida Plena · Design',     reason: 'Prazo vence em 2 dias',     tone: 'red',  deadline: '21 out' },
      { name: 'Landing Aurora Pilates',  meta: 'Studio Aurora · Briefing',        reason: 'Fotos pendentes há 6 dias', tone: 'warn', deadline: '05 nov' },
      { name: 'Loja Café Girassol',      meta: 'Café Girassol · Desenvolvimento', reason: 'Fatura em atraso',          tone: 'red',  deadline: '12 nov' },
    ]

    const STAGES = [
      { name: 'Briefing',        count: 3, percent: 36 },
      { name: 'Design',          count: 3, percent: 33 },
      { name: 'Desenvolvimento', count: 5, percent: 52 },
      { name: 'Revisão',         count: 3, percent: 29 },
    ]

    const REQUESTS = [
      { title: 'Trocar a cor dos botões',  meta: 'Marta Rocha · Site Doce Trigo · há 20 min',  read: false },
      { title: 'Dúvida sobre o domínio',   meta: 'Tiago Mendes · Loja Café Girassol · há 2 h', read: false },
      { title: 'Incluir página de preços', meta: 'Camila Duarte · Landing Aurora · ontem',     read: false },
    ]

    const ACTIVITY = [
      { color: 'brand',  text: 'Ana Costa enviou o layout de produtos para aprovação',  meta: 'Hoje, 10:42 · Site Doce Trigo' },
      { color: 'green',  text: 'Lucas Almeida concluiu o catálogo de produtos',         meta: 'Hoje, 08:15 · Loja Doce Trigo' },
      { color: 'brand',  text: 'Bruna Teixeira publicou o site Mecânica Irmãos Souza',  meta: 'Ontem, 18:00' },
      { color: 'yellow', text: 'Diego Nunes revisou o lembrete de fatura',              meta: 'Ontem, 15:20 · Landing Aurora' },
    ]

    const WORKLOAD = [
      { name: 'Ana Costa · design',    label: '5 de 6',          percent: 83 },
      { name: 'Lucas Almeida · dev',   label: '6 de 6 · lotado', percent: 100, full: true },
      { name: 'Bruna Teixeira · dev',  label: '3 de 6',          percent: 50 },
      { name: 'Diego Nunes · suporte', label: '2 de 4',          percent: 50 },
    ]

    /* =========================================================
       4. ESTADO
    ========================================================= */
    let unreadRequests = NAV_ITEMS.find((item) => item.badge).badge

    /* =========================================================
       5. UTILITÁRIOS
    ========================================================= */
    const $  = (sel) => document.querySelector(sel)
    const $$ = (sel) => document.querySelectorAll(sel)
    const icon = (name, size = 15, extra = '') => `<svg class="shrink-0 ${extra}" style="width:${size}px;height:${size}px"><use href="#i-${name}"/></svg>`
    const matches = (query, ...fields) => fields.join(' ').toLowerCase().includes(query)
    const currentQuery = () => $('#busca').value.trim().toLowerCase()

    let toastTimer
    function showToast(message) {
      const el = $('#toast')
      el.textContent = message
      el.toggleAttribute('data-show', true)
      clearTimeout(toastTimer)
      toastTimer = setTimeout(() => el.toggleAttribute('data-show', false), 2200)
    }

    // Aplica as classes reutilizáveis aos elementos marcados com data-ui
    function applyUI() {
      $$('[data-ui]').forEach((el) => el.classList.add(...UI[el.dataset.ui].split(' ')))
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
          ${item.badge ? `<i data-badge class="rounded-full bg-brand-dark px-1.5 py-0.5 text-[9px] font-bold not-italic text-white">${unreadRequests}</i>` : ''}
        </a>`).join('')
    }

    function renderKpis() {
      $('#kpis').innerHTML = KPIS.map((k) => {
        const highlight = k.tone === 'highlight'
        return `
          <a href="${k.href}" class="flex flex-col gap-[3px] px-3.5 py-[13px] ${TILE.base} ${highlight ? TILE.highlight : TILE.normal}">
            <div class="text-[11px] font-semibold ${highlight ? 'text-[#EDE7FF]' : 'text-soft'}">${k.label}</div>
            <div class="text-[25px] font-extrabold tracking-[-1px]">${k.value}</div>
            <div class="mt-[3px] text-[9.5px] font-medium ${KPI_NOTE_COLOR[k.tone]}">${k.note}</div>
          </a>`
      }).join('')
    }

    function renderAttention(query = '') {
      const rows = ATTENTION.filter((a) => matches(query, a.name, a.meta, a.reason))
      $('#attention').innerHTML = rows.map((a) => `
        <a href="${DETAIL_PAGE}" class="group flex items-center gap-3 rounded-md border-b border-line py-[9px] transition-colors hover:bg-panel">
          <div class="min-w-0 flex-1">
            <div class="text-[12.5px] font-bold leading-4 text-[#EDEDF3]">${a.name}</div>
            <div class="mt-0.5 text-[9.5px] font-semibold text-[#75757F]">${a.meta}</div>
          </div>
          <div class="w-40 shrink-0 max-[760px]:hidden">
            <span class="inline-block w-fit whitespace-nowrap rounded-full px-2 py-[3px] text-[9px] font-bold ${TAG_STYLES[a.tone]}">${a.reason}</span>
          </div>
          <div class="w-[74px] shrink-0 text-[10.5px] font-medium text-[#C9C9D2] max-[760px]:hidden">${a.deadline}</div>
          <div class="w-[74px] shrink-0 text-right text-[10.5px] font-medium text-soft transition-colors hover:text-white group-hover:text-white max-[760px]:hidden">Gerenciar</div>
        </a>`).join('') || EMPTY('Nenhum projeto encontrado')
    }

    function renderStages() {
      $('#stages').innerHTML = STAGES.map((s) => `
        <div title="${s.count} projetos em ${s.name}" class="group flex cursor-default flex-col gap-1.5">
          <div class="flex justify-between text-[10.5px] font-medium text-soft"><b class="font-bold text-[#E8E8EE]">${s.name}</b><span>${s.count}</span></div>
          <div class="h-1.5 overflow-hidden rounded-full bg-[#23232B]">
            <div data-width="${s.percent}" class="${PROGRESS_FILL} bg-brand group-hover:bg-brand-hover"></div>
          </div>
        </div>`).join('')
    }

    function renderRequests(query = '') {
      const rows = REQUESTS.map((r, i) => ({ ...r, i })).filter((r) => matches(query, r.title, r.meta))
      $('#requests').innerHTML = rows.map((r) => `
        <button data-request="${r.i}" ${r.read ? 'data-read' : ''}
                class="flex w-full cursor-pointer flex-col gap-0.5 px-2.5 py-2 text-left ${TILE.base} ${TILE.normal} data-[read]:opacity-50">
          <div class="text-[10.5px] font-bold text-[#EDEDF3]">${r.title}</div>
          <div class="text-[9px] font-semibold text-[#75757F]">${r.meta}</div>
        </button>`).join('') || EMPTY('Nenhuma solicitação encontrada')
    }

    function renderActivity() {
      $('#activity').innerHTML = ACTIVITY.map((a) => `
        <div class="flex gap-2 rounded-md py-0.5 transition-colors hover:bg-panel">
          <div class="mt-[5px] size-1.5 shrink-0 rounded-full ${DOT_COLORS[a.color]}"></div>
          <div>
            <div class="text-[10.5px] font-medium leading-[14px] text-[#EDEDF3]">${a.text}</div>
            <div class="mt-0.5 text-[9px] font-medium text-[#75757F]">${a.meta}</div>
          </div>
        </div>`).join('')
    }

    function renderWorkload() {
      $('#workload').innerHTML = WORKLOAD.map((w) => `
        <div class="flex flex-col gap-[5px]">
          <div class="flex justify-between text-[10.5px] font-bold text-[#EDEDF3]">
            ${w.name}<span class="text-[9.5px] font-medium ${w.full ? 'text-[#F0777C]' : 'text-soft'}">${w.label}</span>
          </div>
          <div class="h-[5px] overflow-hidden rounded-full bg-[#23232B]">
            <div data-width="${w.percent}" class="${PROGRESS_FILL} ${w.full ? 'bg-[#F0777C]' : 'bg-brand'}"></div>
          </div>
        </div>`).join('')
    }

    // Anima as barras de progresso (largura 0 -> valor final)
    const animateBars = () =>
      requestAnimationFrame(() => setTimeout(() => $$('[data-width]').forEach((el) => (el.style.width = `${el.dataset.width}%`)), 50))

    /* =========================================================
       7. EVENTOS
    ========================================================= */
    $('#busca').addEventListener('input', () => {
      const query = currentQuery()
      renderAttention(query)
      renderRequests(query)
    })

    $('#requests').addEventListener('click', (e) => {
      const button = e.target.closest('[data-request]')
      if (!button) return
      const request = REQUESTS[+button.dataset.request]

      if (!request.read) {
        request.read = true
        $('[data-badge]').textContent = --unreadRequests
      }
      showToast(`Abrindo “${request.title}”…`)
      renderRequests(currentQuery())
    })

    // Qualquer elemento com data-toast mostra o aviso
    document.addEventListener('click', (e) => {
      const el = e.target.closest('[data-toast]')
      if (el) showToast(el.dataset.toast)
    })

    /* =========================================================
       8. INICIALIZAÇÃO
    ========================================================= */
    applyUI()
    renderNav()
    renderKpis()
    renderAttention()
    renderStages()
    renderRequests()
    renderActivity()
    renderWorkload()
    animateBars()
  </script>
</body>
</html>
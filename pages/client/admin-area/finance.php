<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin - Financeiro</title>

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
    <defs>
      <symbol id="i-dash" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></symbol>
      <symbol id="i-folder" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 20a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.9a2 2 0 0 1-1.69-.9L9.6 3.9A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2Z"/></symbol>
      <symbol id="i-users" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></symbol>
      <symbol id="i-inbox" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 16 12 14 15 10 15 8 12 2 12"/><path d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"/></symbol>
      <symbol id="i-card" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></symbol>
      <symbol id="i-ud" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m7 15 5 5 5-5M7 9l5-5 5 5"/></symbol>
      <symbol id="i-cal" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></symbol>
      <symbol id="i-zap" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></symbol>
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
        <a href="#" data-toast="Abrindo visão do cliente…" class="flex justify-center rounded-[10px] bg-panel px-3 py-[9px] text-[11.5px] font-medium text-[#C9C9D4] outline outline-1 outline-offset-[-.5px] outline-line2 transition hover:bg-panel-hover hover:text-white hover:outline-brand">
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

      <header class="flex flex-wrap items-start justify-between gap-4">
        <div>
          <h1 class="mb-[7px] w-fit bg-gradient-to-t from-[#CBAAFF] via-[#7B4BB3] via-60% to-brand bg-clip-text text-[38px] font-extrabold leading-[normal] tracking-[-1.2px] text-transparent max-[760px]:text-[30px]">
            Financeiro
          </h1>
          <p class="text-[12.5px] font-medium text-[#7C7C88]">Cobranças, recebimentos e inadimplência.</p>
        </div>

        <div class="flex items-center gap-2.5 max-[760px]:w-full">
          <!-- Seletor de mês -->
          <div id="month-picker" class="group relative max-[760px]:flex-1">
            <button id="month-btn" data-ui="field-btn">
              <svg class="size-3.5 shrink-0 text-faint"><use href="#i-cal"/></svg>
              <span id="month-label"></span>
            </button>
            <div id="month-menu" class="absolute right-0 top-[calc(100%+6px)] z-20 hidden min-w-full rounded-[10px] bg-panel p-1.5 shadow-[0_14px_34px_rgba(0,0,0,.5)] outline outline-1 outline-offset-[-.5px] outline-line2 group-data-[open]:block"></div>
          </div>

          <button id="btn-emitir" data-ui="btn" class="whitespace-nowrap">
            <svg class="size-3.5 shrink-0"><use href="#i-zap"/></svg>Emitir cobrança
          </button>
        </div>
      </header>

      <!-- Indicadores -->
      <section id="kpis" class="grid grid-cols-4 gap-2.5 max-[1100px]:grid-cols-2 max-[760px]:grid-cols-1"></section>

      <!-- Gráficos -->
      <div class="flex items-stretch gap-4 max-[1100px]:flex-col">
        <section data-ui="section" class="!flex-[1.4] !gap-4">
          <div class="text-sm font-bold text-[#E8E8EE]">Receita dos últimos 6 meses</div>
          <div id="bars" class="flex h-[225px] items-end gap-3"></div>
        </section>

        <section data-ui="section" class="!gap-5">
          <div class="text-sm font-bold text-[#E8E8EE]">Receita por serviço</div>
          <div id="services" class="flex flex-col gap-[17px]"></div>
        </section>
      </div>

      <!-- Faturas -->
      <section data-ui="section" class="!flex-none">
        <div class="flex flex-wrap items-center justify-between gap-3 pb-2">
          <div class="text-sm font-bold text-[#E8E8EE]">Faturas</div>
          <div id="pills" class="flex flex-wrap gap-2"></div>
        </div>

        <div class="overflow-x-auto">
          <div class="min-w-[900px]">
            <div class="flex items-center gap-3 py-[7px] text-[9.5px] font-semibold text-mute">
              <div class="min-w-0 flex-1">Cliente</div>
              <div class="w-[215px] shrink-0">Projeto</div>
              <div class="w-[90px] shrink-0">Parcela</div>
              <div class="w-[90px] shrink-0">Vencimento</div>
              <div class="w-[90px] shrink-0">Valor</div>
              <div class="w-[170px] shrink-0">Situação</div>
              <div class="w-[130px] shrink-0"></div>
            </div>
            <div id="invoices"></div>
          </div>
        </div>
      </section>
    </main>
  </div>

  <!-- Modal: emitir cobrança -->
  <div id="modal-emitir" data-ui="overlay">
    <div data-ui="modal" role="dialog" aria-modal="true">
      <h2 class="text-lg font-extrabold tracking-[-.4px]">Emitir cobrança</h2>
      <label data-ui="label">Cliente<select id="e-client" data-ui="input"></select></label>
      <label data-ui="label">Projeto<input id="e-project" data-ui="input" placeholder="Ex.: Loja online Doce Trigo" /></label>
      <div class="grid grid-cols-2 gap-3">
        <label data-ui="label">Valor (R$)<input id="e-value" data-ui="input" type="number" min="1" step="0.01" placeholder="1500" /></label>
        <label data-ui="label">Vencimento<input id="e-due" data-ui="input" type="date" /></label>
      </div>
      <label data-ui="label">Parcela<input id="e-parcel" data-ui="input" placeholder="1 de 1" /></label>
      <div class="flex flex-wrap justify-end gap-2 pt-1">
        <button data-close data-ui="btn-outline">Cancelar</button>
        <button id="e-submit" data-ui="btn">Emitir cobrança</button>
      </div>
    </div>
  </div>

  <!-- Modal: boleto -->
  <div id="modal-boleto" data-ui="overlay">
    <div data-ui="modal" role="dialog" aria-modal="true">
      <h2 class="text-lg font-extrabold tracking-[-.4px]">Boleto</h2>
      <div id="b-info" class="flex flex-col gap-2 rounded-[10px] bg-lane p-3.5"></div>
      <div id="b-code" class="break-all rounded-[9px] bg-lane px-3 py-2.5 text-[10.5px] tracking-[.3px] text-[#C4B5FD]"></div>
      <div class="flex flex-wrap justify-end gap-2 pt-1">
        <button data-close data-ui="btn-outline">Fechar</button>
        <button id="b-copy" data-ui="btn-outline">Copiar linha digitável</button>
        <button id="b-pay" data-ui="btn">Marcar como paga</button>
      </div>
    </div>
  </div>

  <!-- Toast -->
  <div id="toast" class="pointer-events-none fixed bottom-6 left-1/2 z-[60] -translate-x-1/2 translate-y-5 rounded-[10px] bg-panel px-4 py-2.5 text-xs font-semibold opacity-0 outline outline-1 outline-brand-dark transition duration-[250ms] data-[show]:translate-y-0 data-[show]:opacity-100"></div>


  <script>
    /* =========================================================
       1. CONFIGURAÇÃO
    ========================================================= */
    const TODAY = new Date(2026, 9, 19) // data do design: segunda, 19 de outubro
    const MONTHLY_GOAL = 25000
    const SERVICE_SCALE = 12900         // valor que representa 100% da barra de serviços
    const BAR_SCALE = 0.0778            // px por real nas barras do gráfico

    const NAV_ITEMS = [
      { icon: 'dash',   label: 'Visão geral',  href: 'index.php' },
      { icon: 'folder', label: 'Projetos',     href: 'project.php' },
      { icon: 'users',  label: 'Clientes',     href: 'client-admin.php' },
      { icon: 'inbox',  label: 'Solicitações', href: 'solicitation.php', badge: 8 },
      { icon: 'card',   label: 'Financeiro',   href: 'finance.php', active: true },
    ]

    const TAG_STYLES = {
      warn: 'bg-[#2F260F] text-[#E5C465]',
      red:  'bg-[#33131B] text-[#F0777C]',
      neutral: 'bg-[#23232B] text-[#C9C9D2]',
      ok:   'bg-[#0D2A1C] text-[#54D68E]',
    }
    const STATUS_TAG = { atraso: 'red', vence: 'warn', avencer: 'neutral', paga: 'ok' }

    const FILTERS = {
      todas:   () => true,
      atraso:  (i) => i.status === 'atraso',
      avencer: (i) => i.status === 'vence' || i.status === 'avencer',
      pagas:   (i) => i.status === 'paga',
    }
    const FILTER_LABELS = { todas: 'Todas', atraso: 'Em atraso', avencer: 'A vencer', pagas: 'Pagas' }

    /* =========================================================
       2. ESTILOS REUTILIZÁVEIS (classes Tailwind)
    ========================================================= */
    const UI = {
      // Bloco de conteúdo (mesmo visual das seções da tela index)
      section: 'flex min-w-0 flex-1 flex-col gap-2 rounded-[14px] bg-lane p-4 outline outline-1 outline-offset-[-.5px] outline-[#1D1D24] max-[1100px]:flex-none',
      // Botões
      btn: 'flex items-center justify-center gap-[7px] rounded-[9px] bg-brand px-4 py-2.5 text-xs font-semibold text-white transition hover:bg-brand-hover hover:shadow-[0_6px_20px_-6px_#7C3AED] active:scale-[.97]',
      'btn-outline': 'flex items-center justify-center gap-[7px] rounded-[9px] bg-transparent px-4 py-2.5 text-xs font-semibold text-[#E4E4E7] outline outline-1 outline-offset-[-.5px] outline-line2 transition hover:bg-panel-hover hover:outline-brand active:scale-[.97]',
      'field-btn': 'flex h-[38px] w-[170px] items-center gap-2 rounded-[10px] bg-panel px-3 text-[11.5px] font-medium text-[#D4D4D8] outline outline-1 outline-offset-[-.5px] outline-line2 transition hover:outline-brand group-data-[open]:outline-brand max-[760px]:w-full',
      // Formulário
      label: 'flex flex-col gap-1.5 text-[11px] font-semibold text-soft',
      input: 'h-[38px] rounded-[9px] bg-lane px-3 text-xs font-medium text-ink outline outline-1 outline-offset-[-.5px] outline-line2 [color-scheme:dark] transition focus:outline-brand data-[err]:outline-[#F0777C]',
      // Modais
      overlay: 'fixed inset-0 z-50 hidden place-items-center bg-black/60 p-5 backdrop-blur-[3px] data-[open]:grid',
      modal: 'flex w-full max-w-[420px] flex-col gap-3.5 rounded-2xl bg-panel p-[22px] shadow-[0_30px_70px_rgba(0,0,0,.6)] outline outline-1 outline-offset-[-.5px] outline-line2',
    }

    // Cards internos (mesmo visual dos cards da tela index)
    const TILE = {
      base:      'rounded-xl outline outline-1 outline-offset-[-.5px] transition duration-150 hover:-translate-y-0.5',
      normal:    'bg-[#15151A] outline-[#23232B] hover:bg-[#18181F] hover:shadow-[0_10px_24px_-10px_rgba(124,58,237,.35)] hover:outline-brand-dark',
      highlight: 'bg-brand outline-brand hover:bg-brand-hover hover:shadow-[0_10px_24px_-10px_#7C3AED] hover:outline-brand-hover',
    }
    const KPI_NOTE_COLOR = { neutral: 'text-soft', positive: 'text-[#54D68E]', negative: 'text-[#F0777C]', highlight: 'text-[#EAE2FF]' }

    const PROGRESS_FILL = 'h-full w-0 rounded-full [transition:width_.7s_cubic-bezier(.2,.8,.2,1),background-color_.15s]'

    const BTN_SMALL = 'rounded-lg px-3 py-[7px] text-[10px] font-semibold transition active:scale-[.97]'
    const BTN_SMALL_PRIMARY = `${BTN_SMALL} bg-brand text-white hover:bg-brand-hover`
    const BTN_SMALL_OUTLINE = `${BTN_SMALL} bg-transparent font-medium text-[#E4E4E7] outline outline-1 outline-offset-[-.5px] outline-line2 hover:bg-panel-hover hover:outline-brand`
    const BTN_SMALL_DONE    = `${BTN_SMALL} pointer-events-none bg-[#0D2A1C] text-[#54D68E]`

    const EMPTY = (text) =>
      `<div class="rounded-[10px] border border-dashed border-[#23232B] py-[18px] text-center text-[10.5px] font-medium text-faint">${text}</div>`

    /* =========================================================
       3. DADOS
    ========================================================= */
    const MONTHS = [
      { short: 'mai', name: 'Maio',     revenue: 16200 },
      { short: 'jun', name: 'Junho',    revenue: 19800 },
      { short: 'jul', name: 'Julho',    revenue: 17600 },
      { short: 'ago', name: 'Agosto',   revenue: 21300 },
      { short: 'set', name: 'Setembro', revenue: 23100 },
      { short: 'out', name: 'Outubro',  revenue: 18400 },
    ]
    const CURRENT_MONTH = MONTHS.length - 1

    const SERVICES = [
      { name: 'Lojas virtuais',      value: 8600 },
      { name: 'Sites institucionais', value: 6200 },
      { name: 'Landing pages',       value: 2400 },
      { name: 'Manutenção mensal',   value: 1200 },
    ]
    const SERVICES_TOTAL = SERVICES.reduce((sum, s) => sum + s.value, 0)

    const CLIENTS = ['Padaria Doce Trigo', 'Studio Aurora Pilates', 'Clínica Vida Plena', 'Café Girassol', 'Móveis Pereira', 'Escola Pequeno Mundo', 'Mecânica Irmãos Souza']

    // status: atraso | vence | avencer | paga
    let nextId = 0
    const createInvoice = (data) => ({ id: ++nextId, reminderSent: false, ...data })

    const invoices = [
      createInvoice({ client: 'Café Girassol',          project: 'Loja Café Girassol',         parcel: '2 de 3', due: '05 out', value: 1480, status: 'atraso',  label: '14 dias de atraso' }),
      createInvoice({ client: 'Studio Aurora Pilates',  project: 'Agendamento de aulas',       parcel: '1 de 2', due: '10 out', value: 1000, status: 'atraso',  label: '9 dias de atraso' }),
      createInvoice({ client: 'Padaria Doce Trigo',     project: 'Loja online Doce Trigo',     parcel: '3 de 4', due: '25 out', value: 1250, status: 'vence',   label: 'Vence em 6 dias' }),
      createInvoice({ client: 'Clínica Vida Plena',     project: 'Site Clínica Vida Plena',    parcel: '2 de 3', due: '28 out', value: 2600, status: 'avencer', label: 'A vencer' }),
      createInvoice({ client: 'Mecânica Irmãos Souza',  project: 'Site Mecânica Irmãos Souza', parcel: '3 de 3', due: '15 out', value: 900,  status: 'paga',    label: 'Paga em 15 out' }),
      createInvoice({ client: 'Móveis Pereira',         project: 'Site institucional',         parcel: '2 de 3', due: '12 out', value: 1800, status: 'paga',    label: 'Paga em 12 out' }),
    ]

    /* =========================================================
       4. ESTADO
    ========================================================= */
    let selectedMonth = CURRENT_MONTH
    let activeFilter = 'todas'
    let currentInvoice = null

    // Ajustes acumulados por ações do usuário (emitir / marcar como paga)
    const adjust = { toReceive: 0, installments: 0, october: 0, year: 0 }

    /* =========================================================
       5. UTILITÁRIOS
    ========================================================= */
    const $  = (sel) => document.querySelector(sel)
    const $$ = (sel) => document.querySelectorAll(sel)
    const icon = (name, size = 15, extra = '') => `<svg class="shrink-0 ${extra}" style="width:${size}px;height:${size}px"><use href="#i-${name}"/></svg>`

    const escapeHtml = (s) => s.replace(/[&<>"]/g, (c) => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;' }[c]))
    const pad = (n, size = 2) => String(n).padStart(size, '0')

    const formatBRL = (n) => 'R$ ' + n.toLocaleString('pt-BR', { minimumFractionDigits: n % 1 ? 2 : 0, maximumFractionDigits: 2 })
    const formatDay = (d) => `${pad(d.getDate())} ${MONTHS_SHORT[d.getMonth()]}`
    const toInputDate = (d) => `${d.getFullYear()}-${pad(d.getMonth() + 1)}-${pad(d.getDate())}`
    const daysFromToday = (d) => Math.round((d - TODAY) / 864e5)
    const plural = (n, one, many) => (n === 1 ? one : many)
    const MONTHS_SHORT = ['jan', 'fev', 'mar', 'abr', 'mai', 'jun', 'jul', 'ago', 'set', 'out', 'nov', 'dez']

    const monthRevenue = (i) => MONTHS[i].revenue + (i === CURRENT_MONTH ? adjust.october : 0)

    let toastTimer
    function showToast(message) {
      const el = $('#toast')
      el.textContent = message
      el.toggleAttribute('data-show', true)
      clearTimeout(toastTimer)
      toastTimer = setTimeout(() => el.toggleAttribute('data-show', false), 2200)
    }

    const openModal = (el) => el.toggleAttribute('data-open', true)
    const closeModals = () => $$('[data-ui="overlay"]').forEach((el) => el.toggleAttribute('data-open', false))

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
          ${item.badge ? `<i class="rounded-full bg-brand-dark px-1.5 py-0.5 text-[9px] font-bold not-italic text-white">${item.badge}</i>` : ''}
        </a>`).join('')
    }

    function renderMonthPicker() {
      $('#month-label').textContent = `${MONTHS[selectedMonth].name} de 2026`
      $('#month-menu').innerHTML = MONTHS.map((m, i) => `
        <button data-month="${i}" ${i === selectedMonth ? 'data-on' : ''}
                class="block w-full whitespace-nowrap rounded-[7px] px-2.5 py-2 text-left text-[11.5px] font-medium text-[#D4D4D8] transition hover:bg-panel-hover data-[on]:bg-[#211C30] data-[on]:text-[#C4B5FD]">
          ${m.name} de 2026
        </button>`).join('')
    }

    function renderKpis() {
      const month = MONTHS[selectedMonth]
      const received = monthRevenue(selectedMonth)
      const late = invoices.filter((i) => i.status === 'atraso')
      const lateTotal = late.reduce((sum, i) => sum + i.value, 0)
      const lateClients = new Set(late.map((i) => i.client)).size

      const kpis = [
        { label: `Recebido em ${month.name.toLowerCase()}`, value: formatBRL(received), tone: 'highlight',
          note: `${Math.round((received / MONTHLY_GOAL) * 100)}% da meta de R$ 25.000` },
        { label: 'A receber', value: formatBRL(11250 + adjust.toReceive), tone: 'neutral',
          note: `${9 + adjust.installments} parcelas nos próximos 30 dias` },
        { label: 'Em atraso', value: formatBRL(lateTotal), tone: 'negative', valueClass: 'text-[#F0777C]',
          note: `${late.length} ${plural(late.length, 'fatura', 'faturas')} · ${lateClients} ${plural(lateClients, 'cliente', 'clientes')}` },
        { label: 'Recebido em 2026', value: formatBRL(142900 + adjust.year), tone: 'positive',
          note: '+18% sobre 2025' },
      ]

      $('#kpis').innerHTML = kpis.map((k) => {
        const highlight = k.tone === 'highlight'
        return `
          <div class="flex flex-col gap-[3px] px-3.5 py-[13px] ${TILE.base} ${highlight ? TILE.highlight : TILE.normal}">
            <div class="text-[11px] font-semibold ${highlight ? 'text-[#EDE7FF]' : 'text-soft'}">${k.label}</div>
            <div class="text-[25px] font-extrabold tracking-[-1px] ${k.valueClass || ''}">${k.value}</div>
            <div class="mt-[3px] text-[9.5px] font-medium ${KPI_NOTE_COLOR[k.tone]}">${k.note}</div>
          </div>`
      }).join('')
    }

    function renderBars() {
      $('#bars').innerHTML = MONTHS.map((m, i) => {
        const value = monthRevenue(i)
        return `
          <div data-bar="${i}" ${i === selectedMonth ? 'data-on' : ''} title="${m.name}: ${formatBRL(value)}"
               class="group flex h-full min-w-0 flex-1 cursor-pointer flex-col items-center justify-end gap-[7px]">
            <div class="text-[9.5px] font-semibold text-soft transition-colors group-hover:text-ink group-data-[on]:text-ink">${(value / 1000).toFixed(1).replace('.', ',')}k</div>
            <div style="height:${Math.round(value * BAR_SCALE)}px"
                 class="w-full rounded-t-md bg-brand/50 transition-[background-color,height] duration-500 group-hover:bg-brand/80 group-data-[on]:bg-brand"></div>
            <div class="text-[10px] font-medium text-soft">${m.short}</div>
          </div>`
      }).join('')
    }

    function renderServices() {
      $('#services').innerHTML = SERVICES.map((s) => `
        <div title="${Math.round((s.value / SERVICES_TOTAL) * 100)}% da receita" class="group flex cursor-default flex-col gap-[7px]">
          <div class="flex justify-between text-[10.5px] font-medium text-soft"><b class="font-bold text-[#E8E8EE]">${s.name}</b><span>${formatBRL(s.value)}</span></div>
          <div class="h-1.5 overflow-hidden rounded-full bg-[#23232B]">
            <div data-width="${Math.round((s.value / SERVICE_SCALE) * 100)}" class="${PROGRESS_FILL} bg-brand group-hover:bg-brand-hover"></div>
          </div>
        </div>`).join('')
    }

    function renderPills() {
      $('#pills').innerHTML = Object.entries(FILTER_LABELS).map(([key, label]) => `
        <button data-filter="${key}" ${key === activeFilter ? 'data-on' : ''}
                class="rounded-full bg-panel px-3.5 py-1.5 text-[10.5px] font-medium text-[#D4D4D8] outline outline-1 outline-offset-[-.5px] outline-line2 transition hover:bg-panel-hover data-[on]:bg-brand data-[on]:font-semibold data-[on]:text-white data-[on]:outline-brand">
          ${label}
        </button>`).join('')
    }

    function invoiceAction(i) {
      if (i.status === 'atraso') {
        return i.reminderSent
          ? `<button data-action="reminder" class="${BTN_SMALL_DONE}">Lembrete enviado ✓</button>`
          : `<button data-action="reminder" class="${BTN_SMALL_PRIMARY}">Enviar lembrete</button>`
      }
      if (i.status === 'paga') return `<button data-action="receipt" class="${BTN_SMALL_OUTLINE}">Recibo</button>`
      return `<button data-action="boleto" class="${BTN_SMALL_OUTLINE}">Ver boleto</button>`
    }

    function renderInvoices() {
      const rows = invoices.filter(FILTERS[activeFilter])
      $('#invoices').innerHTML = rows.map((i) => `
        <div data-invoice="${i.id}" class="flex cursor-pointer items-center gap-3 rounded-md border-b border-line py-[9px] transition-colors hover:bg-panel">
          <div class="min-w-0 flex-1 text-[12.5px] font-bold text-[#EDEDF3]">${escapeHtml(i.client)}</div>
          <div class="w-[215px] shrink-0 text-[10.5px] font-medium text-[#C9C9D2]">${escapeHtml(i.project)}</div>
          <div class="w-[90px] shrink-0 text-[10.5px] font-medium text-soft">${escapeHtml(i.parcel)}</div>
          <div class="w-[90px] shrink-0 text-[10.5px] font-medium text-[#75757F]">${i.due}</div>
          <div class="w-[90px] shrink-0 text-[11px] font-semibold text-[#E4E4E7]">${formatBRL(i.value)}</div>
          <div class="w-[170px] shrink-0">
            <span class="inline-block w-fit whitespace-nowrap rounded-full px-2 py-[3px] text-[9px] font-bold ${TAG_STYLES[STATUS_TAG[i.status]]}">${i.label}</span>
          </div>
          <div class="flex w-[130px] shrink-0 justify-end">${invoiceAction(i)}</div>
        </div>`).join('') || EMPTY('Nenhuma fatura nesta categoria.')
    }

    function renderBoleto(i) {
      const row = (label, value) => `<div class="flex justify-between text-[11.5px] text-soft"><span>${label}</span><b class="font-semibold text-ink">${value}</b></div>`
      $('#b-info').innerHTML =
        row('Cliente', escapeHtml(i.client)) + row('Projeto', escapeHtml(i.project)) +
        row('Parcela', escapeHtml(i.parcel)) + row('Vencimento', i.due) + row('Valor', formatBRL(i.value))
      $('#b-code').textContent = `23793.38128 60${pad(i.id, 3)}0.000003 00000.000400 1 ${pad(Math.round(i.value * 100), 14)}`
    }

    // Anima as barras de progresso (largura 0 -> valor final)
    const animateBars = () =>
      requestAnimationFrame(() => setTimeout(() => $$('[data-width]').forEach((el) => (el.style.width = `${el.dataset.width}%`)), 50))

    function render() {
      renderMonthPicker()
      renderKpis()
      renderBars()
      renderPills()
      renderInvoices()
    }

    /* =========================================================
       7. AÇÕES
    ========================================================= */
    function selectMonth(index) {
      selectedMonth = index
      $('#month-picker').toggleAttribute('data-open', false)
      render()
    }

    function openBoleto(invoice) {
      currentInvoice = invoice
      renderBoleto(invoice)
      openModal($('#modal-boleto'))
    }

    function markAsPaid(invoice) {
      if (invoice.status === 'vence' || invoice.status === 'avencer') {
        adjust.toReceive -= invoice.value
        adjust.installments -= 1
      }
      adjust.october += invoice.value
      adjust.year += invoice.value

      Object.assign(invoice, { status: 'paga', label: `Paga em ${formatDay(TODAY)}`, due: formatDay(TODAY) })
      showToast(`Fatura de ${invoice.client} marcada como paga`)
      closeModals()
      render()
    }

    function openEmitirModal() {
      ;['#e-project', '#e-value', '#e-parcel'].forEach((sel) => {
        $(sel).value = ''
        $(sel).toggleAttribute('data-err', false)
      })
      const due = new Date(TODAY)
      due.setDate(due.getDate() + 7)
      $('#e-due').value = toInputDate(due)
      $('#e-parcel').value = '1 de 1'
      openModal($('#modal-emitir'))
      $('#e-project').focus()
    }

    // Calcula situação e rótulo a partir do vencimento
    function invoiceStatus(days) {
      if (days < 0)   return { status: 'atraso',  label: `${-days} ${plural(-days, 'dia', 'dias')} de atraso` }
      if (days === 0) return { status: 'vence',   label: 'Vence hoje' }
      if (days <= 7)  return { status: 'vence',   label: `Vence em ${days} ${plural(days, 'dia', 'dias')}` }
      return { status: 'avencer', label: 'A vencer' }
    }

    function emitInvoice() {
      const project = $('#e-project')
      const value = $('#e-value')
      const invalid = [[project, !project.value.trim()], [value, !(parseFloat(value.value) > 0)]]
      invalid.forEach(([el, bad]) => el.toggleAttribute('data-err', bad))
      if (invalid.some(([, bad]) => bad)) return showToast('Preencha projeto e valor')

      const [y, m, d] = $('#e-due').value.split('-').map(Number)
      const dueDate = new Date(y, m - 1, d)
      const amount = parseFloat(value.value)
      const { status, label } = invoiceStatus(daysFromToday(dueDate))
      const client = $('#e-client').value

      if (status !== 'atraso') {
        adjust.toReceive += amount
        adjust.installments += 1
      }
      invoices.unshift(createInvoice({
        client, project: project.value.trim(), parcel: $('#e-parcel').value.trim() || '1 de 1',
        due: formatDay(dueDate), value: amount, status, label,
      }))

      activeFilter = 'todas'
      closeModals()
      render()
      showToast(`Cobrança emitida para ${client}`)
    }

    /* =========================================================
       8. EVENTOS
    ========================================================= */
    // Seletor de mês
    $('#month-btn').addEventListener('click', (e) => {
      e.stopPropagation()
      $('#month-picker').toggleAttribute('data-open')
    })
    $('#month-menu').addEventListener('click', (e) => {
      const button = e.target.closest('[data-month]')
      if (button) selectMonth(+button.dataset.month)
    })
    document.addEventListener('click', () => $('#month-picker').toggleAttribute('data-open', false))

    // Gráfico e filtros
    $('#bars').addEventListener('click', (e) => {
      const bar = e.target.closest('[data-bar]')
      if (bar) selectMonth(+bar.dataset.bar)
    })
    $('#pills').addEventListener('click', (e) => {
      const pill = e.target.closest('[data-filter]')
      if (!pill) return
      activeFilter = pill.dataset.filter
      renderPills()
      renderInvoices()
    })

    // Faturas
    $('#invoices').addEventListener('click', (e) => {
      const row = e.target.closest('[data-invoice]')
      if (!row) return
      const invoice = invoices.find((i) => i.id === +row.dataset.invoice)
      const action = e.target.closest('[data-action]')?.dataset.action

      if (action === 'reminder') {
        if (invoice.reminderSent) return
        invoice.reminderSent = true
        showToast(`Lembrete enviado para ${invoice.client}`)
        return renderInvoices()
      }
      if (invoice.status === 'paga') return showToast(`Baixando recibo de ${invoice.client}…`)
      openBoleto(invoice)
    })

    // Boleto
    $('#b-copy').addEventListener('click', () => {
      navigator.clipboard?.writeText($('#b-code').textContent)
      showToast('Linha digitável copiada')
    })
    $('#b-pay').addEventListener('click', () => currentInvoice && markAsPaid(currentInvoice))

    // Emitir cobrança
    $('#btn-emitir').addEventListener('click', openEmitirModal)
    $('#e-submit').addEventListener('click', emitInvoice)

    // Modais: fechar por botão, clique fora ou Esc
    $$('[data-close]').forEach((b) => b.addEventListener('click', closeModals))
    $$('[data-ui="overlay"]').forEach((o) => o.addEventListener('mousedown', (e) => { if (e.target === o) closeModals() }))
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') closeModals()
      if (e.key === 'Enter' && $('#modal-emitir').hasAttribute('data-open') && e.target.tagName === 'INPUT') emitInvoice()
    })

    // Qualquer elemento com data-toast mostra o aviso
    document.addEventListener('click', (e) => {
      const el = e.target.closest('[data-toast]')
      if (!el) return
      e.preventDefault()
      showToast(el.dataset.toast)
    })

    /* =========================================================
       9. INICIALIZAÇÃO
    ========================================================= */
    applyUI()
    renderNav()
    renderServices()
    $('#e-client').innerHTML = CLIENTS.map((c) => `<option>${c}</option>`).join('')
    render()
    animateBars()
  </script>
</body>
</html>
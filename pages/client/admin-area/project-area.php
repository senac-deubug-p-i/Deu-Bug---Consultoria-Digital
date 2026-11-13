<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin - Projeto (detalhe)</title>

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200..800&display=swap" rel="stylesheet" />

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
            edge: '#1E1E26',
            panel: '#15151B',
            'panel-hover': '#1C1C24',
            line2: '#26262E',
            brand: '#7B4BB3',
            'brand-hover': '#8B4CF5',
            'brand-dark': '#7B4BB3',
            ink: '#F2F2F6',
            soft: '#9A9AA6',
            mute: '#6B6B78',
            faint: '#5F5F68',
          },
        },
      },
    }
  </script>
</head>

<body class="min-h-screen bg-base font-sans text-ink">
  <div class="flex min-h-screen">

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
          <svg class="size-[13px] shrink-0 stroke-2 text-faint"><use href="#i-ud"/></svg>
        </button>
      </div>
    </aside>

    <!-- ===== Conteúdo ===== -->
    <main class="flex min-w-0 flex-1 flex-col gap-4 px-[30px] py-6 max-[760px]:px-4 max-[760px]:py-5">

      <!-- Cabeçalho -->
      <header class="flex flex-col gap-[9px]">
        <div class="flex items-center gap-[5px] text-[10.5px] font-medium text-[#6B6579]">
          <a href="project.php" class="hover:text-[#C4B5FD]">Projetos</a>
          <svg class="size-2.5 shrink-0 stroke-2 text-[#4A4556]"><use href="#i-r"/></svg>
          <b class="font-semibold text-[#9A93AB]">Loja online Doce Trigo</b>
        </div>

        <div class="text-[9.5px] font-bold tracking-[1.3px] text-[#6B6579]">PADARIA DOCE TRIGO · LOJA VIRTUAL</div>

        <div class="flex flex-wrap items-center justify-between gap-4">
          <div>
            <h1 class="mb-[9px] w-fit bg-gradient-to-t from-[#D3B8FF] via-[#7B4BB3] via-60% to-[#8B5CF6] bg-clip-text text-[34px] font-extrabold leading-[normal] tracking-[-1px] text-transparent max-[760px]:text-[26px]">
              Loja online Doce Trigo
            </h1>
            <div id="status"><i id="status-dot"></i><span id="status-text"></span></div>
          </div>

          <div class="flex flex-wrap gap-2">
            <button id="btn-client-view" data-ui="btn md ghost">Ver como cliente<svg><use href="#i-user"/></svg></button>
            <button id="btn-pause" data-ui="btn md ghost"><span id="pause-label">Pausar projeto</span><svg><use id="pause-icon" href="#i-pause"/></svg></button>
            <button id="btn-advance" data-ui="btn md primary"><span id="advance-label"></span><svg><use href="#i-r"/></svg></button>
          </div>
        </div>
      </header>

      <!-- Etapas + progresso -->
      <section class="flex flex-col gap-4 rounded-2xl bg-[linear-gradient(-93.9deg,#2B1B47_7%,#1C1229_54%,#141020_93%)] px-5 py-4 outline outline-1 outline-offset-[-.5px] outline-[#3A2A57]">
        <div id="steps" class="flex max-[760px]:overflow-x-auto"></div>
        <div class="flex items-end justify-between">
          <div class="text-[10.5px] font-semibold text-[#B3A8CB]">Progresso mostrado ao cliente</div>
          <div id="progress-value" class="text-[19px] font-extrabold tracking-[-.5px]"></div>
        </div>
        <div class="h-1.5 rounded-[3px] bg-[#2B2143]">
          <div id="progress-fill" class="h-full rounded-[3px] bg-gradient-to-r from-[#a879f7] to-[#7929ff] transition-[width] duration-[400ms]"></div>
        </div>
      </section>

      <div class="flex items-start gap-4 max-[1100px]:flex-col">

        <!-- Coluna principal -->
        <div class="flex min-w-0 flex-1 flex-col gap-4">

          <section data-ui="card">
            <div class="text-sm font-bold text-[#EFEBF6]">Publicar atualização</div>
            <label data-ui="label">Título
              <input id="update-title" data-ui="field" placeholder="Ex. Caminho de compras pronto para teste" />
            </label>
            <label data-ui="label">Mensagem
              <textarea id="update-message" data-ui="textarea" placeholder="Explique em linguagem simples o que foi feito"></textarea>
            </label>
            <div class="flex flex-wrap items-center justify-between gap-3 pt-1">
              <div id="options" class="flex flex-wrap items-center gap-4"></div>
              <div class="flex flex-wrap items-center gap-2">
                <button id="btn-attach" data-ui="btn sm soft">Anexar arquivo</button>
                <input id="file-input" type="file" hidden />
                <button id="btn-publish" data-ui="btn sm primary">Publicar<svg><use href="#i-send"/></svg></button>
              </div>
            </div>
          </section>

          <section data-ui="card">
            <div class="flex items-center justify-between">
              <div class="text-sm font-bold text-[#EFEBF6]">Tarefas · Desenvolvimento</div>
              <div id="task-count" class="text-[10px] font-semibold text-[#7C7686]"></div>
            </div>
            <div id="tasks" class="flex flex-col gap-1.5"></div>
            <div id="task-add" class="flex items-center gap-2"></div>
          </section>

          <section data-ui="card">
            <div class="text-sm font-bold text-[#EFEBF6]">Histórico de atualizações</div>
            <div id="history"></div>
          </section>
        </div>

        <!-- Coluna lateral -->
        <aside class="flex w-[246px] shrink-0 flex-col gap-4 max-[1100px]:grid max-[1100px]:w-full max-[1100px]:grid-cols-[repeat(auto-fit,minmax(240px,1fr))] max-[1100px]:items-start">

          <section data-ui="cardHighlight">
            <div class="text-[13px] font-bold text-[#EDE7FA]">Aprovação pendente</div>
            <p class="text-[10px] font-medium leading-[15px] text-[#A79FC0]">Página de produtos v3 foi enviada ontem às 10:42 e ainda não foi vista pelo cliente.</p>
            <div class="w-fit rounded-[7px] bg-[#3A1119] px-2 py-1 text-[9px] font-bold text-[#F0777C]">Prazo do cliente: 22 out</div>
            <div class="flex gap-2 pt-0.5">
              <button id="btn-remind" data-ui="btn rail primary grow">Enviar lembrete</button>
              <button id="btn-version" data-ui="btn rail violet grow">Ver versão</button>
            </div>
          </section>

          <section data-ui="card">
            <div class="text-[13.5px] font-bold text-[#EFEBF6]">Dados do projeto</div>
            <label data-ui="labelRail">Responsável
              <select id="owner" data-ui="fieldRail">
                <option>Lucas Almeida</option><option>Ana Costa</option><option>Bruna Teixeira</option><option>Diego Nunes</option><option>Rafael Lima</option>
              </select>
            </label>
            <label data-ui="labelRail">Prazo de entrega
              <input id="deadline" type="date" value="2026-11-14" data-ui="fieldRail" />
            </label>

            <div class="flex flex-col gap-1.5 pt-0.5">
              <div class="flex justify-between text-[9.5px] font-semibold text-[#8F88A3]">
                Horas usadas
                <div><b class="font-bold text-[#DDD8E8]">84</b> <span class="font-medium text-[#6B6579]">de 120 h</span></div>
              </div>
              <div class="h-1 rounded-sm bg-[#221E2E]"><div class="h-full w-[70%] rounded-sm bg-brand"></div></div>
            </div>

            <div class="h-px bg-[#1C1A26]"></div>
            <div class="flex items-center justify-between text-[9.5px] font-semibold text-[#8F88A3]">Valor do projeto<b class="text-[10.5px] font-bold text-[#EFEBF6]">R$ 3.200,00</b></div>
            <div class="flex items-center justify-between text-[9.5px] font-semibold text-[#8F88A3]">Pagamento<b class="text-[10.5px] font-bold text-[#54D68E]">2 de 4 parcelas</b></div>
          </section>

          <section data-ui="card">
            <div class="flex items-center gap-[9px]">
              <div class="grid size-8 shrink-0 place-items-center rounded-full bg-[#6D28D9] text-[10px] font-bold text-white">MR</div>
              <div>
                <div class="text-[11.5px] font-bold text-[#EFEBF6]">Marina Rocha</div>
                <div class="mt-0.5 text-[9.5px] font-medium text-[#8F88A3]">Padaria Doce Trigo</div>
              </div>
            </div>
            <div class="flex flex-col gap-[3px] text-[9.5px] font-medium text-[#9A93AB]">
              <span>marina@doctrigo.com.br</span>
              <span>(11) 91111-2222</span>
            </div>
            <div class="text-[9px] font-medium text-[#5F5972]">Último acesso ao portal: hoje, 11:08</div>
            <div class="flex gap-2 pt-0.5">
              <button data-ui="btn railSm soft grow" data-toast="Abrindo mensagens com Marina…">Mensagens</button>
              <button data-ui="btn railSm soft grow" data-toast="Abrindo perfil do cliente…">Ver cliente</button>
            </div>
          </section>

          <section data-ui="card">
            <div class="text-[13.5px] font-bold text-[#EFEBF6]">Arquivos</div>
            <div id="files"></div>
          </section>
        </aside>
      </div>
    </main>
  </div>

  <div id="toast" class="pointer-events-none fixed bottom-6 left-1/2 z-[60] -translate-x-1/2 translate-y-5 rounded-[10px] bg-panel px-4 py-2.5 text-xs font-semibold opacity-0 outline outline-1 outline-brand-dark transition duration-[250ms] data-[show]:translate-y-0 data-[show]:opacity-100"></div>

<script>
    /* =========================================================
       1. CONFIGURAÇÃO
    ========================================================= */
    const STAGES = [
      { name: 'Briefing',        status: 'Em briefing',        progress: 8 },
      { name: 'Design',          status: 'Em design',          progress: 35 },
      { name: 'Desenvolvimento', status: 'Em desenvolvimento', progress: 62 },
      { name: 'Revisão',         status: 'Em revisão',         progress: 88 },
      { name: 'Publicação',      status: 'Publicado',          progress: 100 },
    ]
    const LAST_STAGE = STAGES.length - 1

    const STATUS_STYLES = {
      default: { badge: 'bg-[#241640] text-[#C4B5FD] outline-[#4B2E85]', dot: 'bg-[#A78BFA]' },
      paused:  { badge: 'bg-[#33280D] text-[#E5C465] outline-[#5A451A]', dot: 'bg-[#E5C465]' },
      done:    { badge: 'bg-[#0D2A1C] text-[#54D68E] outline-[#1D5C3B]', dot: 'bg-[#54D68E]' },
    }

    const DOT_COLORS = { blue: 'bg-[#93A4F5]', yellow: 'bg-[#E5C465]', green: 'bg-[#54D68E]' }

    const NAV_ITEMS = [
  { icon: 'dash',   label: 'Visão geral',   href: 'index.php' },
  { icon: 'folder', label: 'Projetos',      href: 'project.php', active: true },
  { icon: 'users',  label: 'Clientes',      href: 'clientes.php' },
  { icon: 'inbox',  label: 'Solicitações',  href: 'solicitacoes.php', badge: 5 },
  { icon: 'card',   label: 'Financeiro',    href: 'financeiro.php' },
]

    const ICONS = {
      dash:   '<rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/>',
      folder: '<path d="M20 20a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.9a2 2 0 0 1-1.69-.9L9.6 3.9A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2Z"/>',
      users:  '<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>',
      inbox:  '<polyline points="22 12 16 12 14 15 10 15 8 12 2 12"/><path d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"/>',
      card:   '<rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/>',
      ud:     '<path d="m7 15 5 5 5-5M7 9l5-5 5 5"/>',
      r:      '<path d="m9 18 6-6-6-6"/>',
      user:   '<path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>',
      pause:  '<rect x="14" y="4" width="4" height="16" rx="1"/><rect x="6" y="4" width="4" height="16" rx="1"/>',
      play:   '<polygon points="6 3 20 12 6 21 6 3"/>',
      check:  '<path d="M20 6 9 17l-5-5"/>',
      send:   '<path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/>',
      plus:   '<path d="M5 12h14M12 5v14"/>',
    }

    /* =========================================================
       2. ESTILOS REUTILIZÁVEIS (classes Tailwind)
    ========================================================= */
    // Botões: base + tamanho + tom
    const BTN_BASE  = 'flex items-center justify-center gap-1.5 whitespace-nowrap font-semibold transition active:scale-[.97] disabled:pointer-events-none disabled:opacity-50 [&_svg]:shrink-0 [&_svg]:stroke-2'
    const BTN_SIZES = {
      md:     'rounded-[9px] px-3 py-2 text-[10.5px] [&_svg]:size-3',
      sm:     'rounded-lg px-3 py-[7px] text-[10.5px] [&_svg]:size-[11px]',
      rail:   'rounded-lg px-2.5 py-2 text-[10px] [&_svg]:size-3',
      railSm: 'rounded-lg px-2.5 py-[7px] text-[10px] [&_svg]:size-[11px]',
    }
    const BTN_TONES = {
      ghost:   'bg-[#12111B] text-[#C8C2D8] outline outline-1 outline-offset-[-.5px] outline-[#2A2740] hover:bg-[#1B1A29] hover:text-white hover:outline-brand [&_svg]:text-[#7C7686] hover:[&_svg]:text-[#C4B5FD]',
      soft:    'bg-[#14121C] text-[#B4AEC4] outline outline-1 outline-offset-[-.5px] outline-[#2A2838] hover:bg-[#1B1A29] hover:text-white hover:outline-brand [&_svg]:text-[#7C7686] hover:[&_svg]:text-[#C4B5FD]',
      violet:  'bg-[#1A1426] text-[#C4B5FD] outline outline-1 outline-offset-[-.5px] outline-[#3B2A5E] hover:bg-[#241A35] hover:outline-[#A78BFA]',
      primary: 'bg-brand font-bold text-white hover:bg-brand-hover hover:shadow-[0_6px_20px_-6px_#7C3AED] [&_svg]:text-white',
      sent:    'pointer-events-none bg-[#0D2A1C] font-bold text-[#54D68E]',
    }
    const btn = (size = 'md', tone = 'ghost', grow = '') =>
      `${BTN_BASE} ${BTN_SIZES[size]} ${BTN_TONES[tone]} ${grow ? 'flex-1' : ''}`

    // Cards e formulários
    const CARD_BASE = 'flex flex-col rounded-[14px] p-4 outline outline-1 outline-offset-[-.5px]'
    const FIELD_BASE = 'w-full border-0 bg-[#0A0910] text-ink outline outline-1 outline-offset-[-.5px] outline-[#262433] transition [color-scheme:dark] placeholder:text-[#565164] hover:outline-[#3A3650] focus:outline-brand data-[err]:outline-[#F0777C]'

    const UI = {
      card:          `${CARD_BASE} gap-3 bg-[#100F16] outline-[#201E2B]`,
      cardHighlight: `${CARD_BASE} gap-2.5 bg-[linear-gradient(-110deg,#241736_10%,#191227_58%,#141020_90%)] outline-[#3B2A5E]`,
      label:         'flex flex-col gap-1.5 text-[10.5px] font-semibold text-[#8F88A3]',
      labelRail:     'flex flex-col gap-[5px] text-[9.5px] font-semibold text-[#8F88A3]',
      field:         `${FIELD_BASE} h-[34px] rounded-[9px] px-3 text-[11px] font-medium`,
      fieldTask:     `${FIELD_BASE} h-8 rounded-[9px] px-3 text-[11px] font-medium`,
      fieldRail:     `${FIELD_BASE} h-[30px] rounded-lg px-2.5 text-[10.5px] font-semibold !text-[#DDD8E8]`,
      textarea:      `${FIELD_BASE} h-[74px] resize-y rounded-[9px] px-3 py-2.5 text-[11px] font-medium`,
      checkbox:      'group flex cursor-pointer select-none items-center gap-1.5 text-[10.5px] font-semibold text-[#A9A3B8]',
      checkboxBox:   'grid size-[13px] shrink-0 place-items-center rounded-[4px] outline outline-1 outline-offset-[-.5px] outline-[#3E3A52] transition group-hover:outline-[#A78BFA] group-data-[on]:bg-brand group-data-[on]:outline-0',
    }

    /* =========================================================
       3. ESTADO E DADOS
    ========================================================= */
    let stage = 2
    let paused = false
    let pendingFile = null

    let history = [
      { title: 'Catálogo de produtos concluído',            visible: true,  dot: 'blue',   meta: 'Hoje, 08:30 · Lucas Almeida' },
      { title: 'Cliente pediu pagamento por boleto também', visible: false, dot: 'yellow', meta: '17 out, 16:20 · Rafael Lima · avaliar escopo extra' },
      { title: 'Cliente aprovou o design da home',          visible: true,  dot: 'green',  meta: '14 out, 14:05 · Marina Rocha' },
    ]

    let tasks = [
      { title: 'Estrutura da loja e menu',        owner: 'Lucas', done: true },
      { title: 'Catálogo de produtos',            owner: 'Lucas', done: true },
      { title: 'Carrinho e finalização da compra', owner: 'Lucas', done: false, tag: 'Em andamento' },
      { title: 'Pagamento por Pix e cartão',      owner: 'Bruna', done: false },
      { title: 'Painel para acompanhar pedidos',  owner: 'Bruna', done: false },
    ]

    let files = [
      { name: 'Layout_produtos_v3.pdf', size: '2,4 MB' },
      { name: 'Fotos_vitrine.zip',      size: '18 MB' },
      { name: 'Contrato_de_servico.pdf', size: '640 KB' },
    ]

    const OPTIONS = [
      { id: 'opt-visible', label: 'Visível para a cliente' },
      { id: 'opt-email',   label: 'Avisar o cliente por e-mail' },
    ]

    /* =========================================================
       4. UTILITÁRIOS
    ========================================================= */
    const $  = (sel) => document.querySelector(sel)
    const $$ = (sel) => document.querySelectorAll(sel)
    const pad = (n) => String(n).padStart(2, '0')
    const escapeHTML = (s) => s.replace(/[&<>"]/g, (c) => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;' }[c]))
    const icon = (name, size = 'size-3', extra = '') => `<svg class="shrink-0 stroke-2 ${size} ${extra}"><use href="#i-${name}"/></svg>`

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
    // Ex.: data-ui="card"  |  data-ui="btn md primary grow"
    function applyUI() {
      $$('[data-ui]').forEach((el) => {
        const [name, ...args] = el.dataset.ui.split(' ')
        el.className = name === 'btn' ? btn(...args) : UI[name]
      })
    }

    function injectIconSprite() {
      const symbols = Object.entries(ICONS).map(([id, body]) =>
        `<symbol id="i-${id}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">${body}</symbol>`).join('')
      document.body.insertAdjacentHTML('afterbegin', `<svg width="0" height="0" class="absolute"><defs>${symbols}</defs></svg>`)
    }

    const checkbox = ({ id = '', label = '', on = false, extra = '' }) => `
      <div ${id ? `id="${id}"` : ''} role="checkbox" tabindex="0" ${on ? 'data-on' : ''} class="${UI.checkbox} ${extra}">
        <div class="${UI.checkboxBox}">${icon('check', 'size-[9px]', '!stroke-[3] text-white opacity-0 group-data-[on]:opacity-100')}</div>${label}
      </div>`

    /* =========================================================
       5. RENDER
    ========================================================= */
    function renderNav() {
  $('#nav').innerHTML = NAV_ITEMS.map((item) => `
    <a href="${item.href}" ${item.active ? 'data-on' : ''} 
           class="group flex items-center gap-2.5 rounded-[9px] px-2.5 py-[9px] text-[12.5px] font-medium text-soft transition hover:bg-panel hover:text-ink data-[on]:bg-brand data-[on]:font-semibold data-[on]:text-white">
          ${icon(item.icon, 'size-[15px]', 'text-mute transition group-hover:text-[#C9C9D4] group-data-[on]:text-white')}
          <span class="flex-1">${item.label}</span>
          ${item.badge ? `<i class="rounded-full bg-brand-dark px-1.5 py-0.5 text-[9px] font-bold not-italic text-white">${item.badge}</i>` : ''}
        </a>`).join('')
    }

    function renderSteps() {
      $('#steps').innerHTML = STAGES.map((s, i) => {
        const state = i < stage ? 'done' : i === stage ? 'current' : 'todo'
        const circle = {
          done:    'bg-brand outline-2 outline-offset-[-1px] outline-brand',
          current: 'bg-brand outline-2 outline-offset-[-1px] outline-[#E9D5FF]',
          todo:    'bg-[#1D1630] outline-1 outline-offset-[-.5px] outline-[#4B3A6B] group-hover:outline-[#A78BFA]',
        }[state]
        const mark = state === 'done' ? icon('check', 'size-3', 'text-white')
                   : state === 'current' ? '<i class="size-[7px] rounded-full bg-white"></i>' : ''

        const connector = i === 0 ? '' : `
          <div class="flex h-6 flex-1 items-center">
            <div class="h-0.5 flex-1 transition-[background] duration-300 ${i <= stage ? 'bg-[#6D28D9]' : 'bg-[#3A2C55]'}"></div>
          </div>`

        return `${connector}
          <div data-step="${i}" ${i <= stage ? 'data-on' : ''}
               class="group flex cursor-pointer flex-col items-center gap-[7px] whitespace-nowrap text-[10px] font-semibold text-[#7E7590] transition hover:text-white data-[on]:font-bold data-[on]:text-[#EDE7FA] data-[on]:hover:text-white">
            <div class="grid size-6 place-items-center rounded-full outline transition duration-200 ${circle}">${mark}</div>
            ${s.name}
          </div>`
      }).join('')
    }

    function renderStage() {
      const { progress, status } = STAGES[stage]
      const style = STATUS_STYLES[paused ? 'paused' : stage === LAST_STAGE ? 'done' : 'default']

      renderSteps()
      $('#progress-value').textContent = `${progress}%`
      $('#progress-fill').style.width = `${progress}%`

      $('#status').className = `flex w-fit items-center gap-1.5 rounded-full px-2.5 py-1 text-[9.5px] font-bold outline outline-1 outline-offset-[-.5px] transition duration-200 ${style.badge}`
      $('#status-dot').className = `size-[5px] rounded-full ${style.dot}`
      $('#status-text').textContent = paused ? 'Pausado' : status

      $('#btn-advance').disabled = stage === LAST_STAGE
      $('#advance-label').textContent = stage === LAST_STAGE ? 'Projeto publicado' : `Avançar para ${STAGES[stage + 1].name}`
    }

    function renderOptions() {
      $('#options').innerHTML = OPTIONS.map((o) => checkbox({ ...o, on: true })).join('')
    }

    function renderHistory() {
      $('#history').innerHTML = history.map((h) => `
        <div class="flex gap-2.5 border-b border-[#1C1A26] py-[9px] last:border-0">
          <div class="grid h-4 w-2 shrink-0 place-items-center"><i class="size-[7px] rounded-full ${DOT_COLORS[h.dot]}"></i></div>
          <div class="flex min-w-0 flex-1 flex-col gap-[3px]">
            <div class="flex items-center gap-2 text-[11px] font-semibold text-[#E8E4F0]">
              <span class="flex-1">${escapeHTML(h.title)}</span>
              <div class="whitespace-nowrap rounded-full px-[7px] py-0.5 text-[8.5px] font-bold outline outline-1 outline-offset-[-.5px] ${h.visible ? 'text-[#8E88A0] outline-[#2E2B3C]' : 'text-[#E5C465] outline-[#5A451A]'}">
                ${h.visible ? 'Cliente vê' : 'Nota interna'}
              </div>
            </div>
            <div class="text-[9.5px] font-medium text-[#6B6579]">${h.meta}</div>
          </div>
        </div>`).join('')
    }

    function renderTasks() {
      $('#task-count').textContent = `${tasks.filter((t) => t.done).length} de ${tasks.length} feitas`
      $('#tasks').innerHTML = tasks.map((t, i) => {
        const highlighted = t.done || t.tag
        return `
          <div data-task="${i}" ${highlighted ? 'data-on' : ''}
               class="flex cursor-pointer select-none items-center gap-[9px] rounded-[9px] bg-[#16131E] px-2.5 py-2 text-[10.5px] font-semibold text-[#F0EBF8] transition-colors hover:bg-[#1D1928] data-[on]:font-medium data-[on]:text-[#DCD6E8]">
            ${checkbox({ on: highlighted, extra: 'pointer-events-none' })}
            <span class="flex-1">${escapeHTML(t.title)}</span>
            ${t.tag && !t.done ? `<div class="rounded-full bg-[#33280D] px-[7px] py-0.5 text-[8.5px] font-bold text-[#E5C465] outline outline-1 outline-offset-[-.5px] outline-[#5A451A]">${t.tag}</div>` : ''}
            <div class="text-[9.5px] font-medium text-[#6E6879]">${t.owner}</div>
          </div>`
      }).join('')
    }

    function renderFiles() {
      $('#files').innerHTML = files.map((f) => `
        <div data-file="${escapeHTML(f.name)}"
             class="flex cursor-pointer justify-between gap-2 border-b border-[#1C1A26] py-[7px] text-[9.5px] font-semibold text-[#D5D0E0] transition-colors last:border-0 hover:text-[#C4B5FD]">
          ${escapeHTML(f.name)}<span class="whitespace-nowrap text-[9px] font-medium text-[#6B6579]">${f.size}</span>
        </div>`).join('')
    }

    // Área "Adicionar tarefa": botão <-> formulário
    function showAddButton() {
      $('#task-add').innerHTML = `<button id="btn-add-task" class="${btn('sm', 'soft')}">${icon('plus', 'size-[11px]')}Adicionar tarefa</button>`
      $('#btn-add-task').onclick = showAddForm
    }

    function showAddForm() {
      $('#task-add').innerHTML = `
        <input id="new-task" class="${UI.fieldTask}" placeholder="Nome da tarefa" />
        <button id="new-task-ok" class="${btn('sm', 'primary')}">Adicionar</button>
        <button id="new-task-cancel" class="${btn('sm', 'soft')}">Cancelar</button>`

      const input = $('#new-task')
      input.focus()

      const confirm = () => {
        const title = input.value.trim()
        if (!title) return input.focus()
        tasks.push({ title, owner: 'Rafael', done: false })
        renderTasks()
        showAddButton()
      }

      $('#new-task-ok').onclick = confirm
      $('#new-task-cancel').onclick = showAddButton
      input.onkeydown = (e) => {
        if (e.key === 'Enter') confirm()
        if (e.key === 'Escape') showAddButton()
      }
    }

    /* =========================================================
       6. AÇÕES
    ========================================================= */
    function addHistory(title, visible, dot) {
      const now = new Date()
      history.unshift({ title, visible, dot, meta: `Hoje, ${pad(now.getHours())}:${pad(now.getMinutes())} · Rafael Lima` })
      renderHistory()
    }

    function publishUpdate() {
      const title = $('#update-title')
      const message = $('#update-message')
      title.toggleAttribute('data-err', !title.value.trim())
      message.toggleAttribute('data-err', !message.value.trim())

      if (!title.value.trim() || !message.value.trim()) return showToast('Preencha título e mensagem')

      const visible = $('#opt-visible').hasAttribute('data-on')
      const notify = $('#opt-email').hasAttribute('data-on')
      addHistory(title.value.trim(), visible, visible ? 'blue' : 'yellow')

      if (pendingFile) {
        files.push({ name: pendingFile.name, size: formatSize(pendingFile.size) })
        renderFiles()
        pendingFile = null
        $('#btn-attach').textContent = 'Anexar arquivo'
        $('#file-input').value = ''
      }

      showToast(visible && notify ? 'Publicado e cliente avisado por e-mail' : 'Atualização publicada')
      title.value = message.value = ''
    }

    function toggleTask(task) {
      if (task.done) {
        task.done = false
      } else {
        task.done = true
        task.tag = null
      }
      renderTasks()
    }

    /* =========================================================
       7. EVENTOS
    ========================================================= */
    // Etapas
    $('#steps').addEventListener('click', (e) => {
      const step = e.target.closest('[data-step]')
      if (!step) return
      stage = +step.dataset.step
      renderStage()
      showToast(`Etapa: ${STAGES[stage].name}`)
    })

    $('#btn-advance').addEventListener('click', () => {
      if (stage >= LAST_STAGE) return
      stage++
      renderStage()
      showToast(`Projeto avançou para ${STAGES[stage].name}`)
      addHistory(`Projeto avançou para ${STAGES[stage].name}`, false, 'blue')
    })

    $('#btn-pause').addEventListener('click', () => {
      paused = !paused
      $('#pause-label').textContent = paused ? 'Retomar projeto' : 'Pausar projeto'
      $('#pause-icon').setAttribute('href', paused ? '#i-play' : '#i-pause')
      renderStage()
      showToast(paused ? 'Projeto pausado' : 'Projeto retomado')
    })

    $('#btn-client-view').addEventListener('click', () => showToast('Abrindo visão do cliente…'))

    // Opções de publicação (checkboxes)
    $('#options').addEventListener('click', (e) => e.target.closest('[role=checkbox]')?.toggleAttribute('data-on'))
    $('#options').addEventListener('keydown', (e) => {
      if (e.key !== ' ' && e.key !== 'Enter') return
      e.preventDefault()
      e.target.closest('[role=checkbox]')?.toggleAttribute('data-on')
    })

    // Publicar atualização
    $('#btn-attach').addEventListener('click', () => $('#file-input').click())
    $('#file-input').addEventListener('change', (e) => {
      const file = e.target.files[0]
      if (!file) return
      pendingFile = file
      $('#btn-attach').textContent = file.name.length > 18 ? `${file.name.slice(0, 16)}…` : file.name
    })
    $('#btn-publish').addEventListener('click', publishUpdate)
    ;['#update-title', '#update-message'].forEach((sel) =>
      $(sel).addEventListener('input', (e) => e.target.removeAttribute('data-err')))

    // Tarefas e arquivos
    $('#tasks').addEventListener('click', (e) => {
      const row = e.target.closest('[data-task]')
      if (row) toggleTask(tasks[+row.dataset.task])
    })
    $('#files').addEventListener('click', (e) => {
      const file = e.target.closest('[data-file]')
      if (file) showToast(`Baixando ${file.dataset.file}…`)
    })

    // Coluna lateral
    $('#btn-remind').addEventListener('click', (e) => {
      e.currentTarget.className = btn('rail', 'sent', 'grow')
      e.currentTarget.textContent = 'Lembrete enviado ✓'
      showToast('Lembrete enviado para Marina')
      addHistory('Lembrete de aprovação enviado', false, 'yellow')
    })
    $('#btn-version').addEventListener('click', () => showToast('Abrindo Página de produtos v3…'))
    $('#owner').addEventListener('change', (e) => showToast(`Responsável: ${e.target.value}`))
    $('#deadline').addEventListener('change', () => showToast('Prazo atualizado'))
    $$('[data-toast]').forEach((el) => el.addEventListener('click', () => showToast(el.dataset.toast)))

    /* =========================================================
       8. INICIALIZAÇÃO
    ========================================================= */
    injectIconSprite()
    applyUI()
    renderNav()
    renderOptions()
    renderStage()
    renderHistory()
    renderTasks()
    renderFiles()
    showAddButton()
  </script>
  
</body>
</html>
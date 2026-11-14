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

      <header>
        <h1 class="mb-[7px] w-fit bg-gradient-to-t from-[#CBAAFF] via-[#7B4BB3] via-60% to-brand bg-clip-text text-[38px] font-extrabold leading-[normal] tracking-[-1.2px] text-transparent max-[760px]:text-[30px]">
          Solicitações
        </h1>
        <p class="text-[12.5px] font-medium text-[#7C7C88]">Mensagens e pedidos dos clientes, em um só lugar.</p>
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
                <button id="btn-attach" data-ui="btn md dashed"><span id="attach-label" class="max-w-[160px] truncate">Anexar</span></button>
                <input id="file-input" type="file" hidden />
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
              <select id="status" data-ui="field">
                <option value="nova">Nova</option><option value="andamento">Em andamento</option><option value="resolvida">Resolvida</option>
              </select>
            </label>
            <label data-ui="label">Atribuir a
              <select id="assignee" data-ui="field">
                <option>Ana Costa</option><option>Rafael Lima</option><option>Sem responsável</option>
              </select>
            </label>
            <label data-ui="label">Prioridade
              <select id="priority" data-ui="field">
                <option>Baixa</option><option>Normal</option><option>Alta</option>
              </select>
            </label>

            <div class="flex flex-col gap-2 pt-1">
              <button id="btn-save" data-ui="btn lg primary">Salvar alterações</button>
              <button id="btn-resolve" data-ui="btn lg ghost">Marcar como resolvida</button>
            </div>
          </section>

          <section aria-label="Tempo de resposta" class="rounded-[14px] bg-gradient-to-br from-brand-hover to-brand p-4 text-white">
            <div class="text-[13px] font-bold">Tempo de resposta</div>
            <p class="mt-1.5 text-[26px] font-extrabold leading-tight tracking-[-.5px]">3 h 20 min</p>
            <p class="mt-2 max-w-[215px] text-[10.5px] font-medium leading-[1.6] text-white/85">Média desta semana. A meta é responder em até 1 dia útil.</p>
          </section>
        </aside>
      </div>
    </main>
  </div>

  <!-- Toast -->
  <div id="toast" class="pointer-events-none fixed bottom-6 left-1/2 z-[60] -translate-x-1/2 translate-y-5 rounded-[10px] bg-panel px-4 py-2.5 text-xs font-semibold opacity-0 outline outline-1 outline-brand-dark transition duration-[250ms] data-[show]:translate-y-0 data-[show]:opacity-100"></div>


  <script>
    /* =========================================================
       1. CONFIGURAÇÃO
    ========================================================= */
    const CURRENT_USER = 'Rafael Lima'

    const NAV_ITEMS = [
      { icon: 'dash',   label: 'Visão geral',  href: 'index.php' },
      { icon: 'folder', label: 'Projetos',     href: 'project.php' },
      { icon: 'users',  label: 'Clientes',     href: 'clientes.php' },
      { icon: 'inbox',  label: 'Solicitações', href: 'solicitacoes.php', active: true, badge: true },
      { icon: 'card',   label: 'Financeiro',   href: 'financeiro.php' },
    ]

    const TAG_STYLES = {
      warn:    'bg-[#2F260F] text-[#E5C465]',
      red:     'bg-[#33131B] text-[#F0777C]',
      neutral: 'bg-[#232329] text-[#A0A0AA]',
    }

    const STATUS = {
      nova:      { label: 'Nova',         style: 'bg-[#33280D] text-[#E5C465] outline-[#5A451A]' },
      andamento: { label: 'Em andamento', style: 'bg-[#241640] text-[#C4B5FD] outline-[#4B2E85]' },
      resolvida: { label: 'Resolvida',    style: 'bg-[#0D2A1C] text-[#54D68E] outline-[#1D5C3B]' },
    }

    const TABS = [
      { id: 'nova',      label: 'Novas',            count: true },
      { id: 'andamento', label: 'Em andamento',     count: true },
      { id: 'resolvida', label: 'Resolvidas' },
      { id: 'mim',       label: 'Atribuídas a mim' },
    ]

    const TAB_FILTERS = {
      nova:      (r) => r.status === 'nova',
      andamento: (r) => r.status === 'andamento',
      resolvida: (r) => r.status === 'resolvida',
      mim:       (r) => r.assignee === CURRENT_USER,
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
    let nextId = 0
    const request = ({ title, client, project, time, tag, tagTone, status, assignee, messages, notes = [] }) =>
      ({ id: ++nextId, title, client, project, time, tag, tagTone, status, assignee, priority: 'Normal', messages, notes })

    const fromClient = (text, time, file = null) => ({ from: 'client', text, time, file })
    const fromTeam   = (text, time) => ({ from: 'team', text, time, file: null })

    let requests = [
      request({
        title: 'Trocar a cor dos botões', client: 'Marina Rocha', project: 'Site Doce Trigo', time: '20 min',
        tag: 'Ajuste de design', tagTone: 'warn', status: 'nova', assignee: 'Ana Costa',
        messages: [fromClient('Oi! Vi o layout e gostei muito. Será que dá para trocar a cor dos botões para um tom mais próximo do marrom da nossa embalagem?', 'Hoje, 11:08', ['foto_embalagem.jpg', '1,1 MB'])],
        notes: ['mudança simples, não conta como escopo extra'],
      }),
      request({
        title: 'Dúvida sobre o domínio', client: 'Tiago Mendes', project: 'Loja Café Girassol', time: '2 h',
        tag: 'Dúvida', tagTone: 'neutral', status: 'nova', assignee: 'Rafael Lima',
        messages: [fromClient('Bom dia! Já tenho um domínio registrado. Preciso fazer algo para apontar para a loja nova ou vocês cuidam disso?', 'Hoje, 09:40')],
      }),
      request({
        title: 'Incluir página de preços', client: 'Camila Duarte', project: 'Landing Aurora', time: 'Ontem',
        tag: 'Escopo extra', tagTone: 'warn', status: 'nova', assignee: 'Rafael Lima',
        messages: [fromClient('Pensei em ter uma página só com os planos e valores das aulas. Dá para incluir na landing?', 'Ontem, 16:12')],
      }),
      request({
        title: 'Segunda via do boleto', client: 'Tiago Mendes', project: 'Loja Café Girassol', time: 'Ontem',
        tag: 'Financeiro', tagTone: 'red', status: 'nova', assignee: 'Sem responsável',
        messages: [fromClient('Perdi o boleto da segunda parcela. Conseguem me mandar outra via, por favor?', 'Ontem, 10:05')],
      }),
      request({
        title: 'Acesso ao portal não funciona', client: 'Sérgio Pereira', project: 'Móveis Pereira', time: '2 dias',
        tag: 'Suporte', tagTone: 'neutral', status: 'nova', assignee: 'Ana Costa',
        messages: [fromClient('Tento entrar no portal e aparece que a senha está incorreta, mas tenho certeza de que digitei certo.', '17 out, 15:30')],
      }),
      request({
        title: 'Adicionar botão de WhatsApp', client: 'Fernanda Lopes', project: 'Site Clínica Vida Plena', time: '3 dias',
        tag: 'Ajuste de design', tagTone: 'warn', status: 'andamento', assignee: 'Rafael Lima',
        messages: [
          fromClient('Queria um botão flutuante de WhatsApp no canto da tela, em todas as páginas.', '16 out, 14:20'),
          fromTeam('Combinado, Fernanda! Já estamos incluindo e te aviso quando estiver no ar.', '16 out, 15:02'),
        ],
      }),
      request({
        title: 'Atualizar horário de funcionamento', client: 'Marina Rocha', project: 'Site Doce Trigo', time: '4 dias',
        tag: 'Suporte', tagTone: 'neutral', status: 'andamento', assignee: 'Ana Costa',
        messages: [fromClient('A padaria vai abrir mais cedo aos sábados, às 6h. Podem ajustar no site?', '15 out, 08:45')],
      }),
      request({
        title: 'Nota fiscal do mês', client: 'Paulo Antunes', project: 'Escola Pequeno Mundo', time: '5 dias',
        tag: 'Financeiro', tagTone: 'red', status: 'andamento', assignee: 'Sem responsável',
        messages: [fromClient('Preciso da nota fiscal referente à parcela de outubro para o nosso contador.', '14 out, 13:10')],
      }),
      request({
        title: 'Trocar logo no rodapé', client: 'Camila Duarte', project: 'Landing Aurora', time: '1 sem',
        tag: 'Ajuste de design', tagTone: 'warn', status: 'resolvida', assignee: 'Ana Costa',
        messages: [
          fromClient('Enviei a nova versão do logo. Pode atualizar no rodapé?', '10 out, 11:00'),
          fromTeam('Pronto, já está atualizado no site!', '10 out, 14:30'),
        ],
      }),
      request({
        title: 'Redefinir senha do portal', client: 'Sérgio Pereira', project: 'Móveis Pereira', time: '2 sem',
        tag: 'Suporte', tagTone: 'neutral', status: 'resolvida', assignee: 'Rafael Lima',
        messages: [
          fromClient('Esqueci minha senha do portal, como faço para redefinir?', '03 out, 09:15'),
          fromTeam('Te enviamos um link de redefinição por e-mail. Qualquer coisa, é só chamar!', '03 out, 09:50'),
        ],
      }),
    ]

    /* =========================================================
       4. ESTADO
    ========================================================= */
    let activeTab = 'nova'
    let selectedId = 1
    let attachedFile = null // [nome, tamanho]

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
          ${item.badge ? `<i class="rounded-full bg-brand-dark px-1.5 py-0.5 text-[9px] font-bold not-italic text-white">${countBy('nova')}</i>` : ''}
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
          <p class="text-[11px] font-bold text-white">${fromClientSide ? escapeHTML(r.client) : `${CURRENT_USER} · equipe`}</p>
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
      $('#status').value = r.status
      $('#assignee').value = r.assignee
      $('#priority').value = r.priority
      $('#btn-resolve').textContent = r.status === 'resolvida' ? 'Reabrir solicitação' : 'Marcar como resolvida'
    }

    const renderAttachment = () => { $('#attach-label').textContent = attachedFile ? attachedFile[0] : 'Anexar' }

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
      renderAttachment()
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

    function sendReply() {
      const r = selectedRequest()
      if (!r || !hasReplyText()) return

      r.messages.push({ from: 'team', text: reply.value.trim(), time: 'Agora', file: attachedFile })
      if (r.status === 'nova') r.status = 'andamento'

      clearReply()
      attachedFile = null
      $('#file-input').value = ''
      showToast(`Resposta enviada para ${firstName(r)}`)
      renderAll()
    }

    function saveNote() {
      const r = selectedRequest()
      if (!r || !hasReplyText()) return

      r.notes.push(reply.value.trim())
      clearReply()
      showToast('Nota interna salva')
      renderDetail()
    }

    function saveChanges() {
      const r = selectedRequest()
      if (!r) return
      r.status = $('#status').value
      r.assignee = $('#assignee').value
      r.priority = $('#priority').value
      showToast('Alterações salvas')
      renderAll()
    }

    function toggleResolved() {
      const r = selectedRequest()
      if (!r) return
      const reopen = r.status === 'resolvida'
      r.status = reopen ? 'andamento' : 'resolvida'
      showToast(reopen ? 'Solicitação reaberta' : 'Solicitação marcada como resolvida')
      renderAll()
    }

    function select(id) {
      selectedId = id
      attachedFile = null
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

    $('#btn-attach').addEventListener('click', () => $('#file-input').click())
    $('#file-input').addEventListener('change', (e) => {
      const file = e.target.files[0]
      if (!file) return
      attachedFile = [file.name, formatSize(file.size)]
      renderAttachment()
    })

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
    $('#btn-save').addEventListener('click', saveChanges)
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
<?php
require_once __DIR__ . '/../../../includes/admin-dados.php';
[$pdo, $admin] = admin_iniciar();
$conversas = chat_conversas_admin($pdo);
$abrir = filter_var($_GET['chat'] ?? null, FILTER_VALIDATE_INT) ?: null;
?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin - Mensagens</title>

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
      <symbol id="i-chat" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></symbol>
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
          Mensagens
        </h1>
        <p class="text-[12.5px] font-medium text-[#7C7C88]">Conversas de suporte com os clientes: uma por projeto e o suporte geral.</p>
      </header>

      <div class="grid grid-cols-1 items-start gap-4 lg:grid-cols-[320px_minmax(0,1fr)]">
        <section aria-label="Conversas" class="rounded-[14px] bg-lane p-2 outline outline-1 outline-offset-[-.5px] outline-[#1D1D24]">
          <div id="list"></div>
        </section>

        <section aria-label="Conversa" class="flex h-[calc(100vh-190px)] min-h-[460px] flex-col rounded-2xl bg-[linear-gradient(-93.9deg,#2B1B47_7%,#1C1229_54%,#141020_93%)] outline outline-1 outline-offset-[-.5px] outline-[#3A2A57]">
          <div id="empty" class="m-auto hidden px-6 text-center text-xs font-medium text-[#B3A8CB]">Nenhuma conversa ainda. Quando um cliente escrever, ela aparece aqui.</div>

          <div id="panel" class="flex min-h-0 flex-1 flex-col">
            <div class="border-b border-white/10 px-5 py-4">
              <h2 id="chat-title" class="text-[15px] font-bold text-[#EDE7FA]"></h2>
              <p id="chat-sub" class="mt-1 text-[10.5px] font-medium text-[#B3A8CB]"></p>
            </div>

            <div id="messages" class="flex min-h-0 flex-1 flex-col gap-3 overflow-y-auto px-5 py-4"></div>

            <form id="form" class="flex items-end gap-2 border-t border-white/10 p-4" autocomplete="off">
              <textarea id="text" rows="2" maxlength="2000" placeholder="Escreva a resposta (Enter envia, Shift+Enter quebra a linha)" data-ui="textarea" style="margin-top:0"></textarea>
              <button type="submit" data-ui="btn md primary" style="height:40px">Enviar</button>
            </form>
          </div>
        </section>
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
       1. CONFIGURAÇÃO E DADOS
    ========================================================= */
    const NAV_ITEMS = <?= js_json(admin_nav($pdo, 'chat.php')) ?>;
    let conversations = <?= js_json($conversas) ?>;
    let selectedChat = <?= js_json($abrir) ?>;
    let lastId = 0
    let busy = false

    /* =========================================================
       2. RENDER
    ========================================================= */
    function renderNav() {
      $('#nav').innerHTML = NAV_ITEMS.map((item) => `
        <a href="${item.href}" ${item.active ? 'data-on aria-current="page"' : ''}
           class="group flex items-center gap-2.5 rounded-[9px] px-2.5 py-[9px] text-[12.5px] font-medium text-soft transition hover:bg-panel hover:text-ink data-[on]:bg-brand data-[on]:font-semibold data-[on]:text-white">
          ${icon(item.icon, 15, 'text-mute transition group-hover:text-[#C9C9D4] group-data-[on]:text-white')}
          <span class="flex-1">${item.label}</span>
          ${item.badge ? `<i class="rounded-full bg-brand-dark px-1.5 py-0.5 text-[9px] font-bold not-italic text-white">${item.badge}</i>` : ''}
        </a>`).join('')
    }

    function renderList() {
      $('#list').innerHTML = conversations.length ? conversations.map((c, i) => {
        const selected = c.chatId === selectedChat
        const style = selected ? 'rounded-lg bg-[#241640] outline outline-1 outline-offset-[-.5px] outline-[#4B2E85]' : `${i ? 'border-t border-line' : ''} transition hover:bg-panel`
        return `
          <a href="#" data-chat="${c.chatId}" class="block px-3 py-3.5 ${style}">
            <div class="flex items-baseline justify-between gap-3">
              <h3 class="text-[12.5px] font-bold text-[#EDEDF3]">${escapeHTML(c.client)}</h3>
              <span class="shrink-0 text-[10px] font-medium text-mute">${escapeHTML(c.time)}</span>
            </div>
            <p class="mt-1 text-[10.5px] font-medium text-[#C4B5FD]">${escapeHTML(c.topic)}</p>
            <div class="mt-1.5 flex items-center justify-between gap-2">
              <p class="truncate text-[10.5px] font-medium text-soft">${escapeHTML(c.last)}</p>
              ${c.unread ? `<i class="rounded-full bg-[#FACC15] px-1.5 py-0.5 text-[9px] font-bold not-italic text-[#1D1726]">${c.unread}</i>` : ''}
            </div>
          </a>`
      }).join('') : '<p class="px-3 py-10 text-center text-[10.5px] font-medium text-faint">Nenhuma conversa.</p>'
    }

    // textContent (nunca innerHTML) para o texto da mensagem: evita XSS
    function drawMessage(m) {
      const box = $('#messages')
      if (box.querySelector(`[data-id="${m.id}"]`)) return
      const el = document.createElement('div')
      el.dataset.id = m.id
      el.className = `max-w-[78%] rounded-lg p-3.5 ${m.mine ? 'self-end bg-[#2B1B47]/80' : 'self-start bg-[#16131E]'}`
      const who = document.createElement('p'); who.className = 'text-[11px] font-bold text-white'; who.textContent = m.mine ? 'Você' : m.author
      const txt = document.createElement('p'); txt.className = 'mt-1.5 whitespace-pre-wrap text-[11.5px] font-medium leading-[1.65] text-[#D5D0E0]'; txt.textContent = m.text
      const time = document.createElement('p'); time.className = 'mt-2 text-[9.5px] font-medium text-[#6B6579]'; time.textContent = m.time
      el.append(who, txt, time)
      box.appendChild(el)
      lastId = Math.max(lastId, m.id)
    }

    const toBottom = () => { const b = $('#messages'); b.scrollTop = b.scrollHeight }

    /* =========================================================
       3. AÇÕES
    ========================================================= */
    async function openChat(id) {
      selectedChat = id
      const c = conversations.find((x) => x.chatId === id)
      $('#empty').classList.toggle('hidden', !!c)
      $('#panel').classList.toggle('hidden', !c)
      if (!c) return renderList()
      $('#chat-title').textContent = c.client
      $('#chat-sub').textContent = `${c.contact} · ${c.topic}`
      $('#messages').innerHTML = ''
      lastId = 0
      history.replaceState(null, '', `chat.php?chat=${id}`)
      await fetchNew()
      c.unread = 0
      renderList()
      toBottom()
      refreshNav()
    }

    async function fetchNew() {
      if (!selectedChat) return
      const r = await api('chat', { acao: 'mensagens', chat_id: selectedChat, depois_de: lastId })
      if (!r) return
      const box = $('#messages')
      const atEnd = box.scrollHeight - box.scrollTop - box.clientHeight < 80
      r.mensagens.forEach(drawMessage)
      if (atEnd) toBottom()
    }

    async function refreshList() {
      const r = await api('chat', { acao: 'conversas' })
      if (!r) return
      conversations = r.conversas
      const open = conversations.find((c) => c.chatId === selectedChat)
      if (open) open.unread = 0
      renderList()
    }

    function refreshNav() {
      const total = conversations.reduce((n, c) => n + c.unread, 0)
      const item = NAV_ITEMS.find((i) => i.href === 'chat.php')
      if (item) { item.badge = total; renderNav() }
    }

    async function send() {
      const text = $('#text').value.trim()
      if (!text || !selectedChat || busy) return
      busy = true
      const r = await api('chat', { acao: 'enviar', chat_id: selectedChat, texto: text })
      busy = false
      if (!r) return
      $('#text').value = ''
      drawMessage(r.mensagem)
      toBottom()
      refreshList()
    }

    /* =========================================================
       4. EVENTOS E INICIALIZAÇÃO
    ========================================================= */
    $('#list').addEventListener('click', (e) => {
      const a = e.target.closest('[data-chat]')
      if (!a) return
      e.preventDefault()
      openChat(+a.dataset.chat)
    })
    $('#form').addEventListener('submit', (e) => { e.preventDefault(); send() })
    $('#text').addEventListener('keydown', (e) => { if (e.key === 'Enter' && !e.shiftKey) { e.preventDefault(); send() } })

    applyUI()
    renderNav()
    renderList()
    if (!selectedChat && conversations.length) selectedChat = conversations[0].chatId
    openChat(selectedChat)

    setInterval(() => { if (!document.hidden) { fetchNew(); refreshList() } }, 4000)
  </script>
</body>
</html>

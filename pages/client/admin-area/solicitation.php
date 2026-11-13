<!doctype html>
<html lang="pt-BR" class="h-full">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Deu Bug! · Admin — Solicitações</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />

    <!-- Tailwind CSS v4 (browser build) + Lucide icons -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

    <style type="text/tailwindcss">
      @theme {
        --font-sans: "Poppins", ui-sans-serif, system-ui, sans-serif;

        --color-ink: #08070c;
        --color-sidebar: #0b0911;
        --color-panel: #14111c;
        --color-panel-2: #1a1626;
        --color-field: #100d18;
        --color-line: #262233;
        --color-line-soft: #1e1a2a;
        --color-txt: #f4f1fa;
        --color-muted: #948ca8;
        --color-brand: #a78bfa;
        --color-strong: #7c5cf0;
        --color-amber: #f3c87a;
      }
    </style>
  </head>

  <body class="min-h-screen bg-ink text-txt antialiased">
    <div class="flex min-h-screen">
      <!-- ============ SIDEBAR ============ -->
      <aside
        class="sticky top-0 flex h-screen w-[198px] shrink-0 flex-col border-r border-line-soft bg-sidebar px-3 pt-7 pb-4"
      >
        <div class="mb-9 flex items-center gap-2.5 px-1">
          <span
            class="grid size-8 shrink-0 place-items-center rounded-[10px] bg-[linear-gradient(140deg,#a78bfa_0%,#6d3fe0_100%)]"
          >
            <svg viewBox="0 0 20 20" class="size-4" fill="none">
              <path
                d="M5.6 16V5h4.2a3.1 3.1 0 0 1 0 6.2H5.6"
                stroke="white"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <rect x="13.4" y="4.2" width="2" height="10.6" rx="1" fill="white" />
            </svg>
          </span>
          <span class="leading-none">
            <span class="block text-[15px] font-bold tracking-[-0.01em] text-txt">Deu Bug!</span>
            <span class="mt-[3px] block text-[7.5px] font-semibold tracking-[0.22em] text-muted">ADMIN</span>
          </span>
        </div>

        <nav class="flex flex-col gap-1" id="nav"></nav>

        <div class="mt-auto flex flex-col gap-3">
          <button
            type="button"
            data-toast="Abrindo visão do cliente…"
            class="flex items-center justify-center rounded-lg border border-line bg-panel px-3 py-2.5 text-[12px] font-medium text-txt transition hover:border-strong/60 hover:bg-panel-2 active:scale-[.98]"
          >
            Ver como cliente
          </button>

          <button type="button" class="flex items-center gap-2.5 rounded-lg px-1 py-1 text-left transition hover:bg-white/5">
            <span class="grid size-8 shrink-0 place-items-center rounded-full bg-[#e9e2ff] text-[10.5px] font-bold text-[#3b2a7a]">RL</span>
            <span class="leading-none">
              <span class="block text-[12.5px] font-semibold text-txt">Rafael Lima</span>
              <span class="mt-[4px] block text-[10.5px] text-muted">Gerente de projetos</span>
            </span>
          </button>
        </div>
      </aside>

      <!-- ============ MAIN ============ -->
      <main class="min-w-0 flex-1 px-6 pt-8 pb-16 md:px-9">
        <header>
          <h1 class="text-[34px] leading-[1.05] font-extrabold tracking-[-0.025em] text-brand md:text-[40px]">
            Solicitações
          </h1>
          <p class="mt-3 text-[13.5px] text-muted">Mensagens e pedidos dos clientes, em um só lugar.</p>
        </header>

        <div class="mt-6 flex flex-wrap items-center gap-2.5" role="tablist" aria-label="Filtros" id="tabs"></div>

        <div class="mt-7 grid grid-cols-1 items-start gap-4 lg:grid-cols-[290px_minmax(0,1fr)] xl:grid-cols-[300px_minmax(0,1fr)_292px]">
          <!-- ---------- Request list ---------- -->
          <section class="rounded-xl border border-line bg-panel p-2" aria-label="Solicitações" id="list"></section>

          <!-- ---------- Detail ---------- -->
          <section
            class="flex flex-col rounded-xl border border-[#463579]/60 bg-[linear-gradient(165deg,#2b1c57_0%,#221642_42%,#151021_100%)] p-5 sm:p-6"
            aria-label="Detalhe da solicitação"
          >
            <div id="dEmpty" class="hidden py-24 text-center text-[12.5px] text-[#b0a6c6]">Selecione uma solicitação para ver os detalhes.</div>
            <div id="dBody" class="flex flex-col">
              <header class="flex items-start justify-between gap-4">
                <div>
                  <h2 class="text-[17px] font-bold text-white" id="dTitle"></h2>
                  <p class="mt-1.5 text-[11.5px] text-[#b0a6c6]" id="dSub"></p>
                </div>
                <span id="dStatus" class="shrink-0 rounded-full border px-3 py-1 text-[10.5px] font-semibold"></span>
              </header>

              <div class="mt-5 border-t border-white/10"></div>
              <div id="thread" class="flex flex-col"></div>

              <div class="mt-14 border-t border-white/10 pt-4">
                <label for="resposta" class="text-[11.5px] text-[#b0a6c6]" id="dLabel">Responder</label>
                <textarea
                  id="resposta"
                  rows="3"
                  placeholder="Escreva a resposta"
                  class="mt-2 block h-[76px] w-full resize-none rounded-lg border border-[#3a2f5c] bg-field/80 px-3.5 py-3 text-[12.5px] text-white transition placeholder:text-[#7a7192] hover:border-[#4b3f75] focus:border-strong focus:ring-1 focus:ring-strong/60 focus:outline-none"
                ></textarea>

                <div class="mt-3 flex flex-wrap items-center gap-2">
                  <div class="relative">
                    <button type="button" id="canned" class="rounded-lg bg-white/10 px-3.5 py-2 text-[11.5px] font-medium text-white transition hover:bg-white/15 active:scale-[.97]">
                      Respostas prontas
                    </button>
                    <div id="cmenu" class="absolute bottom-full left-0 z-20 mb-2 hidden w-[270px] rounded-lg border border-line bg-panel-2 p-1.5 shadow-2xl"></div>
                  </div>
                  <button type="button" id="attach" class="inline-flex max-w-[190px] items-center gap-1.5 rounded-lg border border-dashed border-white/25 px-3.5 py-2 text-[11.5px] font-medium text-white/90 transition hover:border-white/45 hover:text-white active:scale-[.97]">
                    <span class="truncate" id="attLabel">Anexar</span>
                  </button>
                  <input type="file" id="file" hidden />
                  <div class="flex-1"></div>
                  <button type="button" id="note" class="rounded-lg bg-white/10 px-3.5 py-2 text-[11.5px] font-medium text-white transition hover:bg-white/15 active:scale-[.97]">
                    Salvar como nota
                  </button>
                  <button type="button" id="send" class="rounded-lg bg-strong px-5 py-2 text-[11.5px] font-semibold text-white transition hover:bg-strong/90 hover:shadow-[0_8px_20px_-8px_rgba(124,92,240,0.9)] active:scale-[.97]">
                    Enviar
                  </button>
                </div>
              </div>
            </div>
          </section>

          <!-- ---------- Side panels ---------- -->
          <div class="flex flex-col gap-4">
            <section class="rounded-xl border border-line bg-panel-2 p-5" aria-label="Gerenciar">
              <h2 class="text-[17px] font-bold text-[#d8d1ec]">Gerenciar</h2>
              <div class="mt-4 flex flex-col gap-3.5">
                <div>
                  <label for="situacao" class="block text-[11px] font-semibold text-muted">Situação</label>
                  <select id="situacao" class="mt-1.5 w-full cursor-pointer appearance-none rounded-lg border border-[#2e2740] bg-field px-3 py-2.5 text-[12.5px] text-txt transition hover:border-[#403759] focus:border-strong focus:ring-1 focus:ring-strong/60 focus:outline-none">
                    <option value="nova">Nova</option><option value="andamento">Em andamento</option><option value="resolvida">Resolvida</option>
                  </select>
                </div>
                <div>
                  <label for="responsavel" class="block text-[11px] font-semibold text-muted">Atribuir a</label>
                  <select id="responsavel" class="mt-1.5 w-full cursor-pointer appearance-none rounded-lg border border-[#2e2740] bg-field px-3 py-2.5 text-[12.5px] text-txt transition hover:border-[#403759] focus:border-strong focus:ring-1 focus:ring-strong/60 focus:outline-none">
                    <option>Ana Costa</option><option>Rafael Lima</option><option>Sem responsável</option>
                  </select>
                </div>
                <div>
                  <label for="prioridade" class="block text-[11px] font-semibold text-muted">Prioridade</label>
                  <select id="prioridade" class="mt-1.5 w-full cursor-pointer appearance-none rounded-lg border border-[#2e2740] bg-field px-3 py-2.5 text-[12.5px] text-txt transition hover:border-[#403759] focus:border-strong focus:ring-1 focus:ring-strong/60 focus:outline-none">
                    <option>Baixa</option><option>Normal</option><option>Alta</option>
                  </select>
                </div>
              </div>
              <div class="mt-5 flex flex-col gap-2.5">
                <button type="button" id="save" class="w-full rounded-lg bg-strong py-2.5 text-[12.5px] font-semibold text-white transition hover:bg-strong/90 active:scale-[.98]">Salvar alterações</button>
                <button type="button" id="resolve" class="w-full rounded-lg border border-[#2e2740] py-2.5 text-[12.5px] font-medium text-txt transition hover:border-strong/60 hover:bg-white/5 active:scale-[.98]">Marcar como resolvida</button>
              </div>
            </section>

            <section class="rounded-xl bg-[linear-gradient(135deg,#9b7bf8_0%,#6b3fe0_100%)] p-5 text-white" aria-label="Tempo de resposta">
              <h2 class="text-[13.5px] font-semibold">Tempo de resposta</h2>
              <p class="mt-1.5 text-[27px] leading-tight font-extrabold tracking-[-0.02em]">3 h 20 min</p>
              <p class="mt-2 max-w-[215px] text-[11px] leading-[1.6] text-white/85">Média desta semana. A meta é responder em até 1 dia útil.</p>
            </section>
          </div>
        </div>
      </main>
    </div>

    <div id="toast" class="pointer-events-none fixed bottom-6 left-1/2 z-50 -translate-x-1/2 translate-y-4 rounded-xl border border-strong bg-panel-2 px-4 py-2.5 text-[12px] font-medium text-txt opacity-0 shadow-2xl transition duration-300"></div>

    <script>
      const $ = (s) => document.querySelector(s);
      const esc = (s) => s.replace(/[&<>"]/g, (c) => ({ "&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;" }[c]));
      let tt;
      const toast = (m) => {
        const t = $("#toast");
        t.textContent = m;
        t.classList.remove("opacity-0", "translate-y-4");
        clearTimeout(tt);
        tt = setTimeout(() => t.classList.add("opacity-0", "translate-y-4"), 2200);
      };
      const icons = () => lucide.createIcons({ attrs: { "stroke-width": 1.75 } });

      /* ---------- navegação ---------- */
      const NAV = [
        ["layout-grid", "Visão geral", "admin-visao-geral.html"],
        ["folder", "Projetos", "admin-projetos.html"],
        ["users", "Clientes", "#"],
        ["inbox", "Solicitações", "#", true],
        ["credit-card", "Financeiro", "#"],
      ];
      function renderNav() {
        const n = R.filter((r) => r.status === "nova").length;
        $("#nav").innerHTML = NAV.map(([ic, l, href, on]) =>
          on
            ? `<a href="#" aria-current="page" class="flex items-center gap-2.5 rounded-lg bg-strong px-2.5 py-2 text-[12.5px] font-semibold text-white shadow-[0_10px_24px_-12px_rgba(124,92,240,0.9)]"><i data-lucide="${ic}" class="size-[15px] shrink-0"></i><span>${l}</span><span class="ms-auto grid size-[18px] place-items-center rounded-full bg-white text-[10px] font-bold text-strong">${n}</span></a>`
            : `<a href="${href}" ${href === "#" ? `data-toast="${l}: em breve"` : ""} class="flex items-center gap-2.5 rounded-lg px-2.5 py-2 text-[12.5px] font-medium text-muted transition hover:bg-white/5 hover:text-txt"><i data-lucide="${ic}" class="size-[15px] shrink-0"></i><span>${l}</span></a>`
        ).join("");
      }

      /* ---------- dados ---------- */
      const TAG = {
        amber: "border-[#6b5320] bg-[#2e2410] text-amber",
        neutral: "border-[#332d45] bg-[#221e2e] text-[#b6aecb]",
        red: "border-[#5a2230] bg-[#2e1520] text-[#f79090]",
      };
      const STS = {
        nova: ["Nova", "border-[#7a5f22] bg-[#2a2109] text-amber"],
        andamento: ["Em andamento", "border-[#4b3a85] bg-[#241b47] text-[#c4b5fd]"],
        resolvida: ["Resolvida", "border-[#1d5c3b] bg-[#0f2a1e] text-[#54d68e]"],
      };
      const M = (text, time, file) => ({ from: "client", text, time, file });
      let id = 0;
      const Q = (title, who, proj, time, tag, tt, status, assignee, msgs, notes = []) =>
        ({ id: ++id, title, who, proj, time, tag, tt, status, assignee, prio: "Normal", msgs, notes });
      let R = [
        Q("Trocar a cor dos botões", "Marina Rocha", "Site Doce Trigo", "20 min", "Ajuste de design", "amber", "nova", "Ana Costa",
          [M("Oi! Vi o layout e gostei muito. Será que dá para trocar a cor dos botões para um tom mais próximo do marrom da nossa embalagem?", "Hoje, 11:08", ["foto_embalagem.jpg", "1,1 MB"])],
          ["mudança simples, não conta como escopo extra"]),
        Q("Dúvida sobre o domínio", "Tiago Mendes", "Loja Café Girassol", "2 h", "Dúvida", "neutral", "nova", "Rafael Lima",
          [M("Bom dia! Já tenho um domínio registrado. Preciso fazer algo para apontar para a loja nova ou vocês cuidam disso?", "Hoje, 09:40")]),
        Q("Incluir página de preços", "Camila Duarte", "Landing Aurora", "Ontem", "Escopo extra", "amber", "nova", "Rafael Lima",
          [M("Pensei em ter uma página só com os planos e valores das aulas. Dá para incluir na landing?", "Ontem, 16:12")]),
        Q("Segunda via do boleto", "Tiago Mendes", "Loja Café Girassol", "Ontem", "Financeiro", "red", "nova", "Sem responsável",
          [M("Perdi o boleto da segunda parcela. Conseguem me mandar outra via, por favor?", "Ontem, 10:05")]),
        Q("Acesso ao portal não funciona", "Sérgio Pereira", "Móveis Pereira", "2 dias", "Suporte", "neutral", "nova", "Ana Costa",
          [M("Tento entrar no portal e aparece que a senha está incorreta, mas tenho certeza de que digitei certo.", "17 out, 15:30")]),
        Q("Adicionar botão de WhatsApp", "Fernanda Lopes", "Site Clínica Vida Plena", "3 dias", "Ajuste de design", "amber", "andamento", "Rafael Lima",
          [M("Queria um botão flutuante de WhatsApp no canto da tela, em todas as páginas.", "16 out, 14:20"), { from: "team", text: "Combinado, Fernanda! Já estamos incluindo e te aviso quando estiver no ar.", time: "16 out, 15:02" }]),
        Q("Atualizar horário de funcionamento", "Marina Rocha", "Site Doce Trigo", "4 dias", "Suporte", "neutral", "andamento", "Ana Costa",
          [M("A padaria vai abrir mais cedo aos sábados, às 6h. Podem ajustar no site?", "15 out, 08:45")]),
        Q("Nota fiscal do mês", "Paulo Antunes", "Escola Pequeno Mundo", "5 dias", "Financeiro", "red", "andamento", "Sem responsável",
          [M("Preciso da nota fiscal referente à parcela de outubro para o nosso contador.", "14 out, 13:10")]),
        Q("Trocar logo no rodapé", "Camila Duarte", "Landing Aurora", "1 sem", "Ajuste de design", "amber", "resolvida", "Ana Costa",
          [M("Enviei a nova versão do logo. Pode atualizar no rodapé?", "10 out, 11:00"), { from: "team", text: "Pronto, já está atualizado no site!", time: "10 out, 14:30" }]),
        Q("Redefinir senha do portal", "Sérgio Pereira", "Móveis Pereira", "2 sem", "Suporte", "neutral", "resolvida", "Rafael Lima",
          [M("Esqueci minha senha do portal, como faço para redefinir?", "03 out, 09:15"), { from: "team", text: "Te enviamos um link de redefinição por e-mail. Qualquer coisa, é só chamar!", time: "03 out, 09:50" }]),
      ];
      const CANNED = [
        "Oi! Recebemos sua solicitação e já estamos cuidando disso.",
        "Combinado! Vamos fazer o ajuste e te avisamos assim que estiver pronto.",
        "Esse pedido está fora do escopo combinado. Posso te enviar uma proposta separada?",
        "Resolvido! Se precisar de mais alguma coisa, é só chamar.",
      ];
      let tab = "nova", sel = 1, attached = null;
      const get = () => R.find((r) => r.id === sel);
      const filt = {
        nova: (r) => r.status === "nova",
        andamento: (r) => r.status === "andamento",
        resolvida: (r) => r.status === "resolvida",
        mim: (r) => r.assignee === "Rafael Lima",
      };

      /* ---------- tabs ---------- */
      function renderTabs() {
        const c = (k) => R.filter(filt[k]).length;
        const T = [["nova", `Novas · ${c("nova")}`], ["andamento", `Em andamento · ${c("andamento")}`], ["resolvida", "Resolvidas"], ["mim", "Atribuídas a mim"]];
        $("#tabs").innerHTML = T.map(([k, l]) =>
          `<button type="button" role="tab" data-tab="${k}" aria-selected="${tab === k}" class="rounded-full px-4 py-2 text-[12.5px] transition active:scale-[.97] ${tab === k ? "bg-strong font-semibold text-white hover:bg-strong/90" : "bg-panel-2 font-medium text-muted hover:bg-white/5 hover:text-txt"}">${l}</button>`).join("");
      }
      $("#tabs").addEventListener("click", (e) => {
        const b = e.target.closest("[data-tab]");
        if (!b) return;
        tab = b.dataset.tab;
        const l = R.filter(filt[tab]);
        sel = l.length ? l[0].id : null;
        attached = null;
        renderAll();
      });

      /* ---------- lista ---------- */
      function renderList() {
        const l = R.filter(filt[tab]);
        $("#list").innerHTML = l.length
          ? l.map((r, i) => {
              const on = r.id === sel;
              return `<a href="#" data-id="${r.id}" ${on ? 'aria-current="true"' : ""} class="block ${on ? "rounded-lg bg-[#241b47] ring-1 ring-[#4b3a85] ring-inset" : `${i ? "border-t border-white/[0.05]" : ""} transition hover:bg-white/[0.03]`} px-3 py-3.5">
              <div class="flex items-baseline justify-between gap-3"><h3 class="text-[13px] font-semibold text-txt">${esc(r.title)}</h3><span class="shrink-0 text-[10.5px] text-muted">${r.time}</span></div>
              <p class="mt-1.5 text-[11.5px] text-muted">${esc(r.who)} · ${esc(r.proj)}</p>
              <span class="mt-2.5 inline-flex items-center rounded-full border px-2.5 py-[3px] text-[10.5px] font-medium ${TAG[r.tt]}">${r.tag}</span></a>`;
            }).join("")
          : `<p class="px-3 py-10 text-center text-[12px] text-muted">Nenhuma solicitação aqui.</p>`;
      }
      $("#list").addEventListener("click", (e) => {
        const a = e.target.closest("[data-id]");
        if (!a) return;
        e.preventDefault();
        sel = +a.dataset.id;
        attached = null;
        renderAll();
      });

      /* ---------- detalhe ---------- */
      function renderDetail() {
        const r = get();
        $("#dEmpty").classList.toggle("hidden", !!r);
        $("#dBody").classList.toggle("hidden", !r);
        if (!r) return renderManage();
        $("#dTitle").textContent = r.title;
        $("#dSub").textContent = `${r.who} · ${r.proj}`;
        $("#dLabel").textContent = `Responder para ${r.who.split(" ")[0]}`;
        const [sl, sc] = STS[r.status];
        $("#dStatus").className = `shrink-0 rounded-full border px-3 py-1 text-[10.5px] font-semibold ${sc}`;
        $("#dStatus").textContent = sl;
        $("#thread").innerHTML =
          r.msgs.map((m, i) => {
            const c = m.from === "client";
            return `<div class="mt-${i ? 3 : 5} rounded-lg ${c ? "bg-[#1e1832]/90" : "bg-[#2e2456]/70"} p-4">
              <p class="text-[11.5px] font-semibold text-white">${c ? esc(r.who) : "Rafael Lima · equipe"}</p>
              <p class="mt-2 text-[12.5px] leading-[1.65] text-[#d9d3e8]">${esc(m.text)}</p>
              <p class="mt-2.5 text-[10.5px] text-[#9a90b0]">${m.time}</p></div>
              ${m.file ? `<div class="mt-3 inline-flex items-center gap-3 self-start rounded-lg bg-[#1e1832]/90 p-2 pe-4 cursor-pointer transition hover:bg-[#261f3f]" data-toast="Baixando ${esc(m.file[0])}…"><span class="grid size-9 shrink-0 place-items-center rounded-md bg-[#2e2456] text-[#b79cfa]"><i data-lucide="${/\.(jpe?g|png|gif|webp)$/i.test(m.file[0]) ? "image" : "file"}" class="size-[15px]"></i></span><span class="leading-none"><span class="block text-[11.5px] font-medium text-white">${esc(m.file[0])}</span><span class="mt-[5px] block text-[10px] text-[#9a90b0]">${m.file[1]}</span></span></div>` : ""}`;
          }).join("") +
          r.notes.map((n) => `<div class="mt-5 flex justify-center"><span class="rounded-full border border-[#7a5f22] bg-[#2a2109]/60 px-4 py-1.5 text-center text-[10.5px] text-amber">Nota interna: ${esc(n)}</span></div>`).join("");
        renderManage();
        icons();
      }
      function renderManage() {
        const r = get();
        if (!r) return;
        $("#situacao").value = r.status;
        $("#responsavel").value = r.assignee;
        $("#prioridade").value = r.prio;
        $("#resolve").textContent = r.status === "resolvida" ? "Reabrir solicitação" : "Marcar como resolvida";
      }
      function renderAll() {
        renderNav(); renderTabs(); renderList(); renderDetail(); renderAttach(); icons();
      }

      /* ---------- responder ---------- */
      const ta = $("#resposta");
      const fmt = (b) => (b > 1e6 ? (b / 1e6).toFixed(1).replace(".", ",") + " MB" : Math.max(1, Math.round(b / 1e3)) + " KB");
      function renderAttach() {
        $("#attLabel").textContent = attached ? attached[0] : "Anexar";
      }
      $("#attach").addEventListener("click", () => $("#file").click());
      $("#file").addEventListener("change", (e) => {
        const f = e.target.files[0];
        if (f) { attached = [f.name, fmt(f.size)]; renderAttach(); }
      });
      function guard() {
        if (ta.value.trim()) return true;
        ta.classList.add("border-red-400");
        ta.focus();
        toast("Escreva uma mensagem primeiro");
        return false;
      }
      ta.addEventListener("input", () => ta.classList.remove("border-red-400"));
      function send() {
        const r = get();
        if (!r || !guard()) return;
        r.msgs.push({ from: "team", text: ta.value.trim(), time: "Agora", file: attached });
        if (r.status === "nova") r.status = "andamento";
        ta.value = ""; attached = null; $("#file").value = "";
        toast(`Resposta enviada para ${r.who.split(" ")[0]}`);
        renderAll();
      }
      $("#send").addEventListener("click", send);
      ta.addEventListener("keydown", (e) => { if (e.key === "Enter" && (e.ctrlKey || e.metaKey)) send(); });
      $("#note").addEventListener("click", () => {
        const r = get();
        if (!r || !guard()) return;
        r.notes.push(ta.value.trim());
        ta.value = "";
        toast("Nota interna salva");
        renderDetail();
      });
      $("#cmenu").innerHTML = CANNED.map((c, i) => `<button type="button" data-c="${i}" class="block w-full rounded-md px-3 py-2 text-left text-[11.5px] leading-snug text-txt transition hover:bg-white/5">${c}</button>`).join("");
      $("#canned").addEventListener("click", (e) => { e.stopPropagation(); $("#cmenu").classList.toggle("hidden"); });
      $("#cmenu").addEventListener("click", (e) => {
        const b = e.target.closest("[data-c]");
        if (!b) return;
        ta.value = CANNED[+b.dataset.c]; ta.classList.remove("border-red-400"); ta.focus();
        $("#cmenu").classList.add("hidden");
      });
      document.addEventListener("click", () => $("#cmenu").classList.add("hidden"));

      /* ---------- gerenciar ---------- */
      $("#save").addEventListener("click", () => {
        const r = get();
        if (!r) return;
        r.status = $("#situacao").value;
        r.assignee = $("#responsavel").value;
        r.prio = $("#prioridade").value;
        toast("Alterações salvas");
        renderAll();
      });
      $("#resolve").addEventListener("click", () => {
        const r = get();
        if (!r) return;
        const reopen = r.status === "resolvida";
        r.status = reopen ? "andamento" : "resolvida";
        toast(reopen ? "Solicitação reaberta" : "Solicitação marcada como resolvida");
        renderAll();
      });

      /* ---------- toasts genéricos ---------- */
      document.addEventListener("click", (e) => {
        const t = e.target.closest("[data-toast]");
        if (t) { e.preventDefault(); toast(t.dataset.toast); }
      });

      renderAll();
    </script>
  </body>
</html>
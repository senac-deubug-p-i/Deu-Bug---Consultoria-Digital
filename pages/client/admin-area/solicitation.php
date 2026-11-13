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
        class="flex w-[198px] shrink-0 flex-col border-r border-line-soft bg-sidebar px-3 pt-7 pb-4"
      >
        <!-- Logo -->
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
            <span class="mt-[3px] block text-[7.5px] font-semibold tracking-[0.22em] text-muted">
              ADMIN
            </span>
          </span>
        </div>

        <!-- Nav -->
        <nav class="flex flex-col gap-1">
          <a
            href="#"
            class="flex items-center gap-2.5 rounded-lg px-2.5 py-2 text-[12.5px] font-medium text-muted transition hover:bg-white/5 hover:text-txt"
          >
            <i data-lucide="layout-grid" class="size-[15px] shrink-0"></i>
            <span>Visão geral</span>
          </a>

          <a
            href="#"
            class="flex items-center gap-2.5 rounded-lg px-2.5 py-2 text-[12.5px] font-medium text-muted transition hover:bg-white/5 hover:text-txt"
          >
            <i data-lucide="folder" class="size-[15px] shrink-0"></i>
            <span>Projetos</span>
          </a>

          <a
            href="#"
            class="flex items-center gap-2.5 rounded-lg px-2.5 py-2 text-[12.5px] font-medium text-muted transition hover:bg-white/5 hover:text-txt"
          >
            <i data-lucide="users" class="size-[15px] shrink-0"></i>
            <span>Clientes</span>
          </a>

          <a
            href="#"
            aria-current="page"
            class="flex items-center gap-2.5 rounded-lg bg-strong px-2.5 py-2 text-[12.5px] font-semibold text-white shadow-[0_10px_24px_-12px_rgba(124,92,240,0.9)]"
          >
            <i data-lucide="inbox" class="size-[15px] shrink-0"></i>
            <span>Solicitações</span>
            <span
              class="ms-auto grid size-[18px] place-items-center rounded-full bg-white text-[10px] font-bold text-strong"
            >
              5
            </span>
          </a>

          <a
            href="#"
            class="flex items-center gap-2.5 rounded-lg px-2.5 py-2 text-[12.5px] font-medium text-muted transition hover:bg-white/5 hover:text-txt"
          >
            <i data-lucide="credit-card" class="size-[15px] shrink-0"></i>
            <span>Financeiro</span>
          </a>
        </nav>

        <!-- Footer -->
        <div class="mt-auto flex flex-col gap-3">
          <button
            type="button"
            class="flex items-center justify-center rounded-lg border border-line bg-panel px-3 py-2.5 text-[12px] font-medium text-txt transition hover:border-strong/60 hover:bg-panel-2"
          >
            Ver como cliente
          </button>

          <div class="flex items-center gap-2.5 rounded-lg px-1 py-1">
            <span
              class="grid size-8 shrink-0 place-items-center rounded-full bg-[#e9e2ff] text-[10.5px] font-bold text-[#3b2a7a]"
            >
              RL
            </span>
            <span class="leading-none">
              <span class="block text-[12.5px] font-semibold text-txt">Rafael Lima</span>
              <span class="mt-[4px] block text-[10.5px] text-muted">Gerente de projetos</span>
            </span>
          </div>
        </div>
      </aside>

      <!-- ============ MAIN ============ -->
      <main class="min-w-0 flex-1 px-6 pt-8 pb-16 md:px-9">
        <!-- Page header -->
        <header>
          <h1
            class="text-[34px] leading-[1.05] font-extrabold tracking-[-0.025em] text-brand md:text-[40px]"
          >
            Solicitações
          </h1>
          <p class="mt-3 text-[13.5px] text-muted">
            Mensagens e pedidos dos clientes, em um só lugar.
          </p>
        </header>

        <!-- Filters -->
        <div class="mt-6 flex flex-wrap items-center gap-2.5" role="tablist" aria-label="Filtros">
          <button
            type="button"
            role="tab"
            aria-selected="true"
            class="rounded-full bg-strong px-4 py-2 text-[12.5px] font-semibold text-white transition hover:bg-strong/90"
          >
            Novas · 5
          </button>
          <button
            type="button"
            role="tab"
            aria-selected="false"
            class="rounded-full bg-panel-2 px-4 py-2 text-[12.5px] font-medium text-muted transition hover:bg-white/5 hover:text-txt"
          >
            Em andamento · 3
          </button>
          <button
            type="button"
            role="tab"
            aria-selected="false"
            class="rounded-full bg-panel-2 px-4 py-2 text-[12.5px] font-medium text-muted transition hover:bg-white/5 hover:text-txt"
          >
            Resolvidas
          </button>
          <button
            type="button"
            role="tab"
            aria-selected="false"
            class="rounded-full bg-panel-2 px-4 py-2 text-[12.5px] font-medium text-muted transition hover:bg-white/5 hover:text-txt"
          >
            Atribuídas a mim
          </button>
        </div>

        <!-- Columns -->
        <div
          class="mt-7 grid grid-cols-1 items-start gap-4 lg:grid-cols-[290px_minmax(0,1fr)] xl:grid-cols-[300px_minmax(0,1fr)_292px]"
        >
          <!-- ---------- Request list ---------- -->
          <section class="rounded-xl border border-line bg-panel p-2" aria-label="Solicitações">
            <!-- active row -->
            <a
              href="#"
              aria-current="true"
              class="block rounded-lg bg-[#241b47] px-3 py-3.5 ring-1 ring-[#4b3a85] ring-inset"
            >
              <div class="flex items-baseline justify-between gap-3">
                <h3 class="text-[13px] font-semibold text-txt">Trocar a cor dos botões</h3>
                <span class="shrink-0 text-[10.5px] text-muted">20 min</span>
              </div>
              <p class="mt-1.5 text-[11.5px] text-muted">Marina Rocha · Site Doce Trigo</p>
              <span
                class="mt-2.5 inline-flex items-center rounded-full border border-[#6b5320] bg-[#2e2410] px-2.5 py-[3px] text-[10.5px] font-medium text-amber"
              >
                Ajuste de design
              </span>
            </a>

            <!-- row -->
            <a
              href="#"
              class="mt-px block border-t border-white/[0.05] px-3 py-3.5 transition hover:bg-white/[0.03]"
            >
              <div class="flex items-baseline justify-between gap-3">
                <h3 class="text-[13px] font-semibold text-txt">Dívida sobre o domínio</h3>
                <span class="shrink-0 text-[10.5px] text-muted">2 h</span>
              </div>
              <p class="mt-1.5 text-[11.5px] text-muted">Tiago Mendes · Loja Café Girassol</p>
              <span
                class="mt-2.5 inline-flex items-center rounded-full border border-[#332d45] bg-[#221e2e] px-2.5 py-[3px] text-[10.5px] font-medium text-[#b6aecb]"
              >
                Dívida
              </span>
            </a>

            <!-- row -->
            <a
              href="#"
              class="block border-t border-white/[0.05] px-3 py-3.5 transition hover:bg-white/[0.03]"
            >
              <div class="flex items-baseline justify-between gap-3">
                <h3 class="text-[13px] font-semibold text-txt">Incluir página de preços</h3>
                <span class="shrink-0 text-[10.5px] text-muted">Ontem</span>
              </div>
              <p class="mt-1.5 text-[11.5px] text-muted">Camila Duarte · Landing Aurora</p>
              <span
                class="mt-2.5 inline-flex items-center rounded-full border border-[#6b5320] bg-[#2e2410] px-2.5 py-[3px] text-[10.5px] font-medium text-amber"
              >
                Escopo extra
              </span>
            </a>

            <!-- row -->
            <a
              href="#"
              class="block border-t border-white/[0.05] px-3 py-3.5 transition hover:bg-white/[0.03]"
            >
              <div class="flex items-baseline justify-between gap-3">
                <h3 class="text-[13px] font-semibold text-txt">Segunda via do boleto</h3>
                <span class="shrink-0 text-[10.5px] text-muted">Ontem</span>
              </div>
              <p class="mt-1.5 text-[11.5px] text-muted">Tiago Mendes · Loja Café Girassol</p>
              <span
                class="mt-2.5 inline-flex items-center rounded-full border border-[#5a2230] bg-[#2e1520] px-2.5 py-[3px] text-[10.5px] font-medium text-[#f79090]"
              >
                Financeiro
              </span>
            </a>

            <!-- row -->
            <a
              href="#"
              class="block border-t border-white/[0.05] px-3 py-3.5 transition hover:bg-white/[0.03]"
            >
              <div class="flex items-baseline justify-between gap-3">
                <h3 class="text-[13px] font-semibold text-txt">Acesso ao portal não funciona</h3>
                <span class="shrink-0 text-[10.5px] text-muted">2 dias</span>
              </div>
              <p class="mt-1.5 text-[11.5px] text-muted">Sérgio Pereira · Móveis Pereira</p>
              <span
                class="mt-2.5 inline-flex items-center rounded-full border border-[#332d45] bg-[#221e2e] px-2.5 py-[3px] text-[10.5px] font-medium text-[#b6aecb]"
              >
                Suporte
              </span>
            </a>
          </section>

          <!-- ---------- Detail ---------- -->
          <section
            class="flex flex-col rounded-xl border border-[#463579]/60 bg-[linear-gradient(165deg,#2b1c57_0%,#221642_42%,#151021_100%)] p-5 sm:p-6"
            aria-label="Detalhe da solicitação"
          >
            <header class="flex items-start justify-between gap-4">
              <div>
                <h2 class="text-[17px] font-bold text-white">Trocar a cor dos botões</h2>
                <p class="mt-1.5 text-[11.5px] text-[#b0a6c6]">Marina Rocha · Site Doce Trigo</p>
              </div>
              <span
                class="shrink-0 rounded-full border border-[#7a5f22] bg-[#2a2109] px-3 py-1 text-[10.5px] font-semibold text-amber"
              >
                Nova
              </span>
            </header>

            <div class="mt-5 border-t border-white/10"></div>

            <!-- message -->
            <div class="mt-5 rounded-lg bg-[#1e1832]/90 p-4">
              <p class="text-[11.5px] font-semibold text-white">Marina Rocha</p>
              <p class="mt-2 text-[12.5px] leading-[1.65] text-[#d9d3e8]">
                Oi! Vi o layout e gostei muito. Será que dá para trocar a cor dos botões para um tom
                mais próximo do marrom da nossa embalagem?
              </p>
              <p class="mt-2.5 text-[10.5px] text-[#9a90b0]">Hoje, 11:08</p>
            </div>

            <!-- attachment -->
            <div class="mt-3 inline-flex items-center gap-3 self-start rounded-lg bg-[#1e1832]/90 p-2 pe-4">
              <span class="grid size-9 shrink-0 place-items-center rounded-md bg-[#2e2456] text-[#b79cfa]">
                <i data-lucide="image" class="size-[15px]"></i>
              </span>
              <span class="leading-none">
                <span class="block text-[11.5px] font-medium text-white">foto_embalagem.jpg</span>
                <span class="mt-[5px] block text-[10px] text-[#9a90b0]">1,1 MB</span>
              </span>
            </div>

            <!-- internal note -->
            <div class="mt-5 flex justify-center">
              <span
                class="rounded-full border border-[#7a5f22] bg-[#2a2109]/60 px-4 py-1.5 text-center text-[10.5px] text-amber"
              >
                Nota interna: mudança simples, não conta como escopo extra
              </span>
            </div>

            <!-- reply -->
            <div class="mt-14 border-t border-white/10 pt-4">
              <label for="resposta" class="text-[11.5px] text-[#b0a6c6]">Responder para Marina</label>
              <textarea
                id="resposta"
                rows="3"
                placeholder="Escreva a resposta"
                class="mt-2 block h-[76px] w-full resize-none rounded-lg border border-[#3a2f5c] bg-field/80 px-3.5 py-3 text-[12.5px] text-white placeholder:text-[#7a7192] focus:border-strong focus:ring-1 focus:ring-strong/60 focus:outline-none"
              ></textarea>

              <div class="mt-3 flex flex-wrap items-center gap-2">
                <button
                  type="button"
                  class="rounded-lg bg-white/10 px-3.5 py-2 text-[11.5px] font-medium text-white transition hover:bg-white/15"
                >
                  Respostas prontas
                </button>
                <button
                  type="button"
                  class="rounded-lg border border-dashed border-white/25 px-3.5 py-2 text-[11.5px] font-medium text-white/90 transition hover:border-white/45 hover:text-white"
                >
                  Anexar
                </button>
                <div class="flex-1"></div>
                <button
                  type="button"
                  class="rounded-lg bg-white/10 px-3.5 py-2 text-[11.5px] font-medium text-white transition hover:bg-white/15"
                >
                  Salvar como nota
                </button>
                <button
                  type="button"
                  class="rounded-lg bg-strong px-5 py-2 text-[11.5px] font-semibold text-white transition hover:bg-strong/90"
                >
                  Enviar
                </button>
              </div>
            </div>
          </section>

          <!-- ---------- Side panels ---------- -->
          <div class="flex flex-col gap-4">
            <!-- Gerenciar -->
            <section class="rounded-xl border border-line bg-panel-2 p-5" aria-label="Gerenciar">
              <h2 class="text-[17px] font-bold text-[#d8d1ec]">Gerenciar</h2>

              <div class="mt-4 flex flex-col gap-3.5">
                <div>
                  <label for="situacao" class="block text-[11px] font-semibold text-muted">Situação</label>
                  <select
                    id="situacao"
                    class="mt-1.5 w-full appearance-none rounded-lg border border-[#2e2740] bg-field px-3 py-2.5 text-[12.5px] text-txt focus:border-strong focus:ring-1 focus:ring-strong/60 focus:outline-none"
                  >
                    <option selected>Nova</option>
                    <option>Em andamento</option>
                    <option>Resolvida</option>
                  </select>
                </div>

                <div>
                  <label for="responsavel" class="block text-[11px] font-semibold text-muted">Atribuir a</label>
                  <select
                    id="responsavel"
                    class="mt-1.5 w-full appearance-none rounded-lg border border-[#2e2740] bg-field px-3 py-2.5 text-[12.5px] text-txt focus:border-strong focus:ring-1 focus:ring-strong/60 focus:outline-none"
                  >
                    <option selected>Ana Costa</option>
                    <option>Rafael Lima</option>
                    <option>Sem responsável</option>
                  </select>
                </div>

                <div>
                  <label for="prioridade" class="block text-[11px] font-semibold text-muted">Prioridade</label>
                  <select
                    id="prioridade"
                    class="mt-1.5 w-full appearance-none rounded-lg border border-[#2e2740] bg-field px-3 py-2.5 text-[12.5px] text-txt focus:border-strong focus:ring-1 focus:ring-strong/60 focus:outline-none"
                  >
                    <option>Baixa</option>
                    <option selected>Normal</option>
                    <option>Alta</option>
                  </select>
                </div>
              </div>

              <div class="mt-5 flex flex-col gap-2.5">
                <button
                  type="button"
                  class="w-full rounded-lg bg-strong py-2.5 text-[12.5px] font-semibold text-white transition hover:bg-strong/90"
                >
                  Salvar alterações
                </button>
                <button
                  type="button"
                  class="w-full rounded-lg border border-[#2e2740] py-2.5 text-[12.5px] font-medium text-txt transition hover:border-strong/60 hover:bg-white/5"
                >
                  Marcar como resolvida
                </button>
              </div>
            </section>

            <!-- Tempo de resposta -->
            <section
              class="rounded-xl bg-[linear-gradient(135deg,#9b7bf8_0%,#6b3fe0_100%)] p-5 text-white"
              aria-label="Tempo de resposta"
            >
              <h2 class="text-[13.5px] font-semibold">Tempo de resposta</h2>
              <p class="mt-1.5 text-[27px] leading-tight font-extrabold tracking-[-0.02em]">
                3 h 20 min
              </p>
              <p class="mt-2 max-w-[215px] text-[11px] leading-[1.6] text-white/85">
                Média desta semana. A meta é responder em até 1 dia útil.
              </p>
            </section>
          </div>
        </div>
      </main>
    </div>

    <script>
      lucide.createIcons({ attrs: { "stroke-width": 1.75 } });
    </script>
  </body>
</html>
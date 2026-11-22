// Chat do suporte (cliente): envia por fetch e busca mensagens novas a cada 4 s.
const modal    = document.getElementById('chat-modal');
const lista    = document.getElementById('mensagens');
const form     = document.getElementById('chat-form');
const campo    = document.getElementById('chat-texto');
const vazio    = document.getElementById('chat-vazio');
const API      = '../../../actions/chat.php';
const chatId   = +modal.dataset.chat;

let ultimoId = Math.max(0, ...[...lista.querySelectorAll('[data-id]')].map((el) => +el.dataset.id));

async function chamar(dados) {
    const resposta = await fetch(API, {
        method: 'POST',
        credentials: 'same-origin',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-Token': modal.dataset.csrf },
        body: JSON.stringify(dados),
    });
    return resposta.json().catch(() => ({ ok: false, erro: 'Resposta inválida do servidor.' }));
}

// textContent (e não innerHTML) evita XSS: o texto da mensagem nunca vira HTML
function desenhar(m) {
    if (lista.querySelector(`[data-id="${m.id}"]`)) return;   // já está na tela
    const caixa = document.createElement('div');
    caixa.className = m.mine ? 'right-message' : 'left-message';
    caixa.dataset.id = m.id;

    const autor = document.createElement('h3');
    autor.textContent = m.mine ? 'Você' : m.author;
    const texto = document.createElement('p');
    texto.textContent = m.text;
    texto.style.whiteSpace = 'pre-wrap';
    const hora = document.createElement('small');
    hora.textContent = m.time;

    caixa.append(autor, texto, hora);
    lista.appendChild(caixa);
    if (vazio) vazio.hidden = true;
    ultimoId = Math.max(ultimoId, m.id);
}

function descerAoFim() { lista.scrollTop = lista.scrollHeight; }

form.addEventListener('submit', async (evento) => {
    evento.preventDefault();
    const texto = campo.value.trim();
    if (!texto) return;

    campo.disabled = true;
    const r = await chamar({ acao: 'enviar', chat_id: chatId, texto });
    campo.disabled = false;

    if (!r.ok) { alert(r.erro || 'Não foi possível enviar.'); return; }
    campo.value = '';
    desenhar(r.mensagem);
    descerAoFim();
    campo.focus();
});

async function buscarNovas() {
    if (document.hidden) return;
    const r = await chamar({ acao: 'mensagens', chat_id: chatId, depois_de: ultimoId });
    if (r.ok && r.mensagens.length) {
        const noFim = lista.scrollHeight - lista.scrollTop - lista.clientHeight < 80;
        r.mensagens.forEach(desenhar);
        if (noFim) descerAoFim();
    }
}

// Bolinhas de "não lidas" das outras conversas
async function atualizarBolinhas() {
    if (document.hidden) return;
    const r = await chamar({ acao: 'resumo' });
    if (!r.ok) return;
    document.querySelectorAll('.chat-card').forEach((card) => {
        const id = card.dataset.chat;
        const dot = card.querySelector('.chat-dot');
        const n = id === String(chatId) ? 0 : (r.naoLidas[id] || 0);
        dot.textContent = n;
        dot.hidden = n === 0;
    });
}

descerAoFim();
setInterval(buscarNovas, 4000);
setInterval(atualizarBolinhas, 8000);

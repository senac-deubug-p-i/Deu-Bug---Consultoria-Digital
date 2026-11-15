// Modal "Solicitar novo projeto" (usa o <dialog> nativo do navegador)
const modal = document.getElementById('modal-solicitacao');
const botaoAbrir = document.getElementById('abrir-solicitacao');

botaoAbrir.addEventListener('click', () => modal.showModal());

modal.querySelectorAll('[data-fechar]').forEach((botao) => {
    botao.addEventListener('click', () => modal.close());
});

// Clicar fora da caixa (no fundo escurecido) também fecha
modal.addEventListener('click', (evento) => {
    if (evento.target === modal) modal.close();
});

// Se o servidor devolveu um erro de validação, reabre o modal já preenchido
if (modal.hasAttribute('data-abrir')) {
    modal.showModal();
}

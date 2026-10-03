// Função para Trocar o {Modal de Login} para o {Modal de Registro}:
const modals = document.querySelector('.modals');
const toggle = modals.querySelector('.switch-login');
const options = toggle.querySelectorAll('.switch-button');

options.forEach((btn) => {
btn.addEventListener('click', () => {
    const value = btn.dataset.value;
    modals.dataset.active = value; // muda no .modals, não no .switch-login

    options.forEach((b) => b.classList.remove('active'));
    btn.classList.add('active');
});
});
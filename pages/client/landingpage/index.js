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

// Função para esconder e mostrar o modal
const loginBtn = document.getElementById('button-login');
const modal = document.querySelector('.modals');

loginBtn.addEventListener('click', () => {
    modal.classList.toggle('active');
});

document.addEventListener('click', (e) => {
    const clickedInside = modals.contains(e.target) || loginBtn.contains(e.target);
    if (!clickedInside && modals.classList.contains('active')) {
        modals.classList.remove('active');
    }
});

// Função de Hover 3D dos cards:
const cards = document.querySelectorAll('.blocks-wrapper > div');
const maxTilt = 10;

cards.forEach((card) => {
    card.addEventListener('mousemove', (e) => {
        const rect = card.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;

        const rotateY = ((x / rect.width) - 0.5) * maxTilt * 2;
        const rotateX = -((y / rect.height) - 0.5) * maxTilt * 2;

        card.classList.remove('reset');
        card.style.transform =
            `perspective(800px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale(1.03)`;
    });

    card.addEventListener('mouseleave', () => {
        card.classList.add('reset');
        card.style.transform =
            'perspective(800px) rotateX(0deg) rotateY(0deg) scale(1)';
    });
});

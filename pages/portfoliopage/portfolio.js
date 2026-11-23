/* ===== Galeria accordion ===== */
function initAccordion(root, opts = {}) {
  const {
    defaultIndex = 0,
    expandRatio = 0.5,
    tilt = 6,
    duration = 0.6,
    ease = 'power3.out',
  } = opts;

  const panels = [...root.querySelectorAll('.ag-panel')];
  const count = panels.length;
  const r = Math.min(Math.max(expandRatio, 0.2), 0.9);
  const grow = count > 1 ? (r * (count - 1)) / (1 - r) : 1;
  const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  let active = defaultIndex;

  // Largura da imagem = largura do painel aberto (sem zoom).
  // O espaçamento é lido do CSS, então nunca fica diferente do .ag { gap }.
  function measure() {
    const gap = parseFloat(getComputedStyle(root).columnGap) || 0;
    const total = root.getBoundingClientRect().width;
    const usable = Math.max(total - gap * (count - 1), 120);
    const mediaSize = Math.max(140, usable * r);
    panels.forEach((p) => {
      p.querySelector('.ag-media').style.width = mediaSize + 'px';
    });
  }

  function layout(animate) {
    const dur = animate && !reduced ? duration : 0;

    panels.forEach((panel, i) => {
      const isActive = i === active;
      const rot = isActive ? 0 : i < active ? tilt : -tilt;

      gsap.to(panel, {
        flexGrow: isActive ? grow : 1,
        rotateY: rot,
        duration: dur,
        ease,
        overwrite: 'auto',
      });

      gsap.to(panel.querySelector('.ag-media'), {
        xPercent: -50,
        yPercent: -50,
        duration: dur,
        ease,
        overwrite: 'auto',
      });
    });
  }

  panels.forEach((panel, i) => {
    const activate = () => {
      active = i;
      layout(true);
    };
    panel.addEventListener('mouseenter', activate);
    panel.addEventListener('focus', activate);
    panel.addEventListener('click', activate);
  });

  new ResizeObserver(() => {
    measure();
    layout(false);
  }).observe(root);

  measure();
  layout(false);
}

document.querySelectorAll('.ag').forEach((root) => initAccordion(root));

/* ===== Modal de login / cadastro (igual à main) ===== */
const modals = document.querySelector('.modals');
const loginBtn = document.getElementById('button-login');

if (modals && loginBtn) {
  // Trocar entre {Login} e {Cadastro}
  const options = modals.querySelectorAll('.switch-button');

  options.forEach((btn) => {
    btn.addEventListener('click', () => {
      modals.dataset.active = btn.dataset.value;

      options.forEach((b) => b.classList.remove('active'));
      btn.classList.add('active');
    });
  });

  // Mostrar e esconder o modal
  loginBtn.addEventListener('click', () => {
    modals.classList.toggle('active');
  });

  // Clicar fora fecha o modal
  document.addEventListener('click', (e) => {
    const clickedInside = modals.contains(e.target) || loginBtn.contains(e.target);
    if (!clickedInside && modals.classList.contains('active')) {
      modals.classList.remove('active');
    }
  });
}
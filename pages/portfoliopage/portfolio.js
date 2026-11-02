function initAccordion(root, opts = {}) {
  const {
    defaultIndex = 0,
    expandRatio = 0.52,
    tilt = 8,
    duration = 0.6,
    ease = 'power3.out',
    parallax = 0.5,
    gap = 10,
  } = opts;

  const panels = [...root.querySelectorAll('.ag-panel')];
  const count = panels.length;
  const r = Math.min(Math.max(expandRatio, 0.2), 0.9);
  const grow = count > 1 ? (r * (count - 1)) / (1 - r) : 1;
  const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  let active = defaultIndex;
  let mediaSize = 320;

  function measure() {
    const total = root.getBoundingClientRect().width;
    const usable = Math.max(total - gap * (count - 1), 120);
    mediaSize = Math.max(140, usable * r * 1.22);
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

      const drift = Math.max(-1.5, Math.min(1.5, active - i));
      const shift = drift * parallax * mediaSize * 0.06;

      gsap.to(panel.querySelector('.ag-media'), {
        xPercent: -50,
        yPercent: -50,
        x: isActive ? 0 : shift,
        duration: dur,
        ease,
        overwrite: 'auto',
      });
    });
  }

  panels.forEach((panel, i) => {
    panel.addEventListener('mouseenter', () => {
      active = i;
      layout(true);
    });

    panel.addEventListener('focus', () => {
      active = i;
      layout(true);
    });

    panel.addEventListener('click', (e) => {
      if (i !== active) {
        e.preventDefault();
        active = i;
        layout(true);
      }
    });
  });

  new ResizeObserver(() => {
    measure();
    layout(false);
  }).observe(root);

  measure();
  layout(false);
}

document.querySelectorAll('.ag').forEach((root) =>
  initAccordion(root, { gap: 16, expandRatio: 0.5, tilt: 6 })
);
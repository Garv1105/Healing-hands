// Healing Hands theme: small progressive enhancements. Everything works without JS.

// Scroll progress bar. (No header shrink: changing its height shifts the page while scrolling.)
const bar = document.getElementById('scroll-progress-bar');
addEventListener('scroll', () => {
  const el = document.documentElement;
  const max = el.scrollHeight - el.clientHeight;
  bar.style.width = (max > 0 ? (el.scrollTop / max) * 100 : 0) + '%';
}, { passive: true });

// Fade-ups (.hh-reveal) and self-drawing dividers (.hh-draw): mark .is-in once visible.
const io = new IntersectionObserver((entries) => entries.forEach((e) => {
  if (e.isIntersecting) { e.target.classList.add('is-in'); io.unobserve(e.target); }
}), { rootMargin: '0px 0px -8% 0px', threshold: 0.12 });
document.querySelectorAll('.hh-reveal, .hh-draw').forEach((el) => io.observe(el));

// YouTube: swap the thumbnail for the player only when clicked.
document.querySelectorAll('[data-youtube]').forEach((btn) => btn.addEventListener('click', () => {
  const f = document.createElement('iframe');
  f.src = `https://www.youtube-nocookie.com/embed/${btn.dataset.youtube}?autoplay=1`;
  f.title = btn.getAttribute('aria-label');
  f.allow = 'autoplay; encrypted-media; picture-in-picture';
  f.allowFullscreen = true;
  f.className = 'w-full aspect-video rounded-2xl';
  btn.replaceWith(f);
}));

// Carousel arrows: [data-scroll="#list"] [data-dir="1|-1"].
document.querySelectorAll('[data-scroll]').forEach((btn) => btn.addEventListener('click', () => {
  const list = document.querySelector(btn.dataset.scroll);
  list.scrollBy({ left: btn.dataset.dir * list.clientWidth * 0.8, behavior: 'smooth' });
}));

// Tabs: [data-tabs] containing [role=tab] buttons and [role=tabpanel] panels.
document.querySelectorAll('[data-tabs]').forEach((root) => {
  const tabs = [...root.querySelectorAll('[role=tab]')];
  const select = (tab) => {
    tabs.forEach((t) => {
      const on = t === tab;
      t.setAttribute('aria-selected', on);
      t.tabIndex = on ? 0 : -1;
      document.getElementById(t.getAttribute('aria-controls')).hidden = !on;
      document.querySelectorAll(`[data-tab="${t.id}"]`).forEach((el) => el.classList.toggle('is-active', on));
    });
  };
  tabs.forEach((tab, i) => {
    tab.addEventListener('click', () => select(tab));
    tab.addEventListener('keydown', (e) => {
      const step = { ArrowDown: 1, ArrowRight: 1, ArrowUp: -1, ArrowLeft: -1 }[e.key];
      if (!step) return;
      e.preventDefault();
      const next = tabs[(i + step + tabs.length) % tabs.length];
      select(next);
      next.focus();
    });
  });
});

// Floating "Book Now / WhatsApp" pill: hide it while the call-back form or footer is visible, so it never covers them.
const cta = document.getElementById('floating-cta');
const seen = new Map();
const ctaIo = new IntersectionObserver((entries) => {
  entries.forEach((e) => seen.set(e.target, e.isIntersecting));
  cta.classList.toggle('is-hidden', [...seen.values()].some(Boolean));
});
document.querySelectorAll('#appointment-booking, footer').forEach((el) => ctaIo.observe(el));

// Body-map hotspots ([data-tab="tab-id"]) act like their pill tab.
document.addEventListener('click', (e) => {
  const spot = e.target.closest('[data-tab]');
  if (spot) document.getElementById(spot.dataset.tab)?.click();
});

// Scroll story ([data-story]): highlights the step being read, crossfades the sticky photo,
// advances the progress ring and fills the vertical line as you scroll.
const reduceMotion = matchMedia('(prefers-reduced-motion: reduce)').matches;
document.querySelectorAll('[data-story]').forEach((root) => {
  const steps = [...root.querySelectorAll('[data-story-step]')];
  const imgs = [...root.querySelectorAll('[data-story-img]')];
  const pills = [...root.querySelectorAll('[data-story-go]')];
  const ring = root.querySelector('[data-story-ring]');
  const num = root.querySelector('[data-story-num]');
  const caption = root.querySelector('[data-story-caption]');
  const line = root.querySelector('[data-story-line]');
  const list = line.parentElement.parentElement;
  const C = 289; // ring circumference (r=46)

  const set = (i) => {
    steps.forEach((s, k) => s.classList.toggle('is-active', k === i));
    imgs.forEach((img, k) => {
      img.classList.toggle('opacity-0', k !== i); img.classList.toggle('scale-[1.04]', k !== i);
      img.classList.toggle('opacity-100', k === i); img.classList.toggle('scale-100', k === i);
    });
    pills.forEach((p, k) => {
      ['bg-forest-rich', 'text-canvas-ivory', 'shadow-sm'].forEach((c) => p.classList.toggle(c, k === i));
      ['text-text-muted', 'hover:text-text-ink'].forEach((c) => p.classList.toggle(c, k !== i));
    });
    ring.style.strokeDashoffset = C * (1 - (i + 1) / steps.length);
    num.textContent = `0${i + 1}`;
    caption.textContent = steps[i].dataset.title;
  };

  const io = new IntersectionObserver((entries) => entries.forEach((e) => {
    if (e.isIntersecting) set(+e.target.dataset.storyStep);
  }), { rootMargin: '-35% 0px -45% 0px' });
  steps.forEach((s) => io.observe(s));
  pills.forEach((p, k) => p.addEventListener('click', () => steps[k].scrollIntoView({ behavior: reduceMotion ? 'auto' : 'smooth', block: 'center' })));

  let ticking = false;
  const fill = () => {
    const r = list.getBoundingClientRect();
    const p = Math.min(1, Math.max(0, (innerHeight * 0.6 - r.top) / r.height));
    line.style.transform = `scaleY(${p})`;
    ticking = false;
  };
  addEventListener('scroll', () => { if (!ticking) { ticking = true; requestAnimationFrame(fill); } }, { passive: true });
  fill();
});

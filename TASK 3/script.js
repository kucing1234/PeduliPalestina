// Menu hamburger (mobile). Di layar md ke atas, menu selalu tampil lewat kelas Tailwind "md:block".
const toggle = document.querySelector('.menu-toggle');
const nav = document.querySelector('#menu');

function setMenu(open) {
  nav.classList.toggle('hidden', !open);
  toggle.setAttribute('aria-expanded', String(open));
  toggle.setAttribute('aria-label', open ? 'Tutup menu' : 'Buka menu');
}

toggle.addEventListener('click', () => setMenu(nav.classList.contains('hidden')));
nav.addEventListener('click', (e) => { if (e.target.closest('a')) setMenu(false); });
document.addEventListener('keydown', (e) => { if (e.key === 'Escape') setMenu(false); });

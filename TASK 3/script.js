const toggle = document.querySelector('.menu-toggle');
const nav = document.querySelector('#menu');

function setMenu(open) {
  nav.classList.toggle('terbuka', open);
  toggle.setAttribute('aria-expanded', String(open));
}

toggle.addEventListener('click', () => setMenu(!nav.classList.contains('terbuka')));
nav.addEventListener('click', (e) => { if (e.target.closest('a')) setMenu(false); });
document.addEventListener('keydown', (e) => { if (e.key === 'Escape') setMenu(false); });

// --- Kode Menu Anda (Sudah Sempurna) ---
const toggle = document.querySelector('button[aria-controls="menu"]');
const nav = document.querySelector('#menu');

function setMenu(open) {
  nav.classList.toggle('hidden', !open);
  nav.classList.toggle('block', open);
  toggle.setAttribute('aria-expanded', String(open));
}

if (toggle && nav) {
  toggle.addEventListener('click', () => setMenu(nav.classList.contains('hidden')));
  nav.addEventListener('click', (e) => { if (e.target.closest('a')) setMenu(false); });
  document.addEventListener('keydown', (e) => { if (e.key === 'Escape') setMenu(false); });
}

// --- Tambahan: Penanganan Submit Form Donasi ---
const form = document.querySelector('form');
if (form) {
  form.addEventListener('submit', (e) => {
    e.preventDefault(); // Mencegah reload halaman

    const nama = document.querySelector('#nama').value.trim() || 'Hamba Allah';
    const nominal = document.querySelector('#nominal').value;
    const nominalRp = Number(nominal).toLocaleString('id-ID');

    alert(`Alhamdulillah, terima kasih ${nama}!\nDonasi sebesar Rp ${nominalRp} telah kami terima.`);
    form.reset();
  });
}
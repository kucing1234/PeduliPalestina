const toggle = document.querySelector('.menu-toggle');
const nav = document.querySelector('#menu');

function setMenu(open) {
  nav.classList.toggle('terbuka', open);
  toggle.setAttribute('aria-expanded', String(open));
}

toggle.addEventListener('click', () => setMenu(!nav.classList.contains('terbuka')));
nav.addEventListener('click', (e) => { if (e.target.closest('a')) setMenu(false); });
document.addEventListener('keydown', (e) => { if (e.key === 'Escape') setMenu(false); });


/* ===== Task 3: Interaksi Lihat Detail Program ===== */
const dataProgram = {
  medis:  { judul: 'Bantuan Medis & Ambulans Darurat', deskripsi: 'Obat-obatan esensial, kasa steril, dan operasional tim medis darurat.', terkumpul: 320000000, target: 500000000 },
  pangan: { judul: 'Dapur Umum & Paket Pangan', deskripsi: 'Makanan hangat dan bahan pokok gandum untuk keluarga di pengungsian.', terkumpul: 280000000, target: 400000000 },
  air:    { judul: 'Truk Air Bersih & Sanitasi', deskripsi: 'Air layak minum dan fasilitas sanitasi darurat untuk mencegah penyakit.', terkumpul: 250000000, target: 300000000 }
};

const panel = document.querySelector('#detail-program');
const rupiah = (n) => 'Rp ' + n.toLocaleString('id-ID');
let programAktif = null;

function tampilkanDetail(kunci) {
  const d = dataProgram[kunci];
  const persen = Math.round((d.terkumpul / d.target) * 100);
  programAktif = kunci;
  document.querySelector('#detail-judul').textContent = d.judul;
  document.querySelector('#detail-deskripsi').textContent = d.deskripsi;
  document.querySelector('#detail-progress').value = persen;
  document.querySelector('#detail-dana').textContent =
    `${rupiah(d.terkumpul)} dari ${rupiah(d.target)} (${persen}%)`;
  panel.hidden = false;
  panel.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
}

document.querySelectorAll('.btn-detail').forEach((btn) => {
  btn.addEventListener('click', () => tampilkanDetail(btn.dataset.program));
});

panel.querySelector('.detail-tutup').addEventListener('click', () => { panel.hidden = true; });
document.addEventListener('keydown', (e) => { if (e.key === 'Escape') panel.hidden = true; });

document.querySelector('#detail-donasi').addEventListener('click', () => {
  document.querySelector('#program').value = programAktif;
  document.querySelector('#donasi').scrollIntoView({ behavior: 'smooth' });
  document.querySelector('#nominal').focus({ preventScroll: true });
});
const toggle = document.querySelector('.menu-toggle');
const nav = document.querySelector('#menu');

if (toggle && nav) {
  function setMenu(open) {
    nav.classList.toggle('terbuka', open);
    toggle.setAttribute('aria-expanded', String(open));
  }

  toggle.addEventListener('click', () => setMenu(!nav.classList.contains('terbuka')));
  nav.addEventListener('click', (e) => { if (e.target.closest('a')) setMenu(false); });
  document.addEventListener('keydown', (e) => { if (e.key === 'Escape') setMenu(false); });
}

/* ===== Task 1: Connect to API ===== */
const fallbackPrograms = [
  { id: 'medis', title: 'Bantuan Medis & Ambulans Darurat', description: 'Obat-obatan esensial, kasa steril, dan operasional tim medis darurat.', target: 500000000, terkumpul: 320000000, kategori: 'Kesehatan' },
  { id: 'pangan', title: 'Dapur Umum & Paket Pangan', description: 'Makanan hangat dan bahan pokok gandum untuk keluarga di pengungsian.', target: 400000000, terkumpul: 280000000, kategori: 'Pangan' },
  { id: 'air', title: 'Truk Air Bersih & Sanitasi', description: 'Air layak minum dan fasilitas sanitasi darurat untuk mencegah penyakit.', target: 300000000, terkumpul: 250000000, kategori: 'Air & Sanitasi' }
];

const apiStatus = document.querySelector('#api-status');
const apiList = document.querySelector('#api-program-list');
const refreshButton = document.querySelector('#refresh-api');
const rupiah = (n) => 'Rp ' + Number(n).toLocaleString('id-ID');

function setApiStatus(type, message) {
  if (!apiStatus) return;
  apiStatus.className = `api-status api-${type}`;
  apiStatus.textContent = message;
}

function renderApiPrograms(programs) {
  if (!apiList) return;

  apiList.innerHTML = programs.map((program) => {
    const percent = Math.min(100, Math.round((program.terkumpul / program.target) * 100));
    return `
      <article class="api-card">
        <span class="api-kategori">${program.kategori || 'Program'}</span>
        <h3>${program.title}</h3>
        <p>${program.description}</p>
        <div class="api-meta">
          <span>${percent}%</span>
          <span>${rupiah(program.terkumpul)}</span>
        </div>
        <div class="api-bar" aria-label="Progress ${percent}%"><span style="width:${percent}%"></span></div>
      </article>
    `;
  }).join('');
}

async function fetchDataFromApi() {
  const urls = [
    './data/programs.json',
    'data/programs.json',
    'https://dummyjson.com/products?limit=3'
  ];

  for (const url of urls) {
    try {
      const response = await fetch(url);
      if (!response.ok) throw new Error('Response tidak valid');

      const data = await response.json();
      const mapped = Array.isArray(data) ? data : (Array.isArray(data.products) ? data.products : null);

      if (!mapped || mapped.length === 0) {
        throw new Error('Data kosong');
      }

      if (url.includes('dummyjson')) {
        return fallbackPrograms.map((program, index) => ({
          ...program,
          terkumpul: Math.min(program.target, Math.round((mapped[index]?.price || 1) * 1500)),
          description: mapped[index]?.description || program.description
        }));
      }

      return mapped.slice(0, 3).map((item, index) => ({
        id: item.id || fallbackPrograms[index].id,
        title: item.title || fallbackPrograms[index].title,
        description: item.description || fallbackPrograms[index].description,
        target: item.target || fallbackPrograms[index].target,
        terkumpul: item.terkumpul || item.price * 10000 || fallbackPrograms[index].terkumpul,
        kategori: item.category || fallbackPrograms[index].kategori
      }));
    } catch (error) {
      // lanjut ke URL berikutnya
    }
  }

  return fallbackPrograms;
}

async function loadApiPrograms() {
  setApiStatus('loading', 'Mengambil data program...');

  try {
    const programs = await fetchDataFromApi();
    renderApiPrograms(programs);
    setApiStatus('success', 'Data API berhasil dimuat.');
  } catch (error) {
    renderApiPrograms(fallbackPrograms);
    setApiStatus('error', 'Gagal memuat data API. Menampilkan data cadangan.');
  }
}

if (refreshButton) {
  refreshButton.addEventListener('click', loadApiPrograms);
}

loadApiPrograms();

/* ===== Task 3: Interaksi Lihat Detail Program ===== */
const dataProgram = {
  medis:  { judul: 'Bantuan Medis & Ambulans Darurat', deskripsi: 'Obat-obatan esensial, kasa steril, dan operasional tim medis darurat.', terkumpul: 320000000, target: 500000000 },
  pangan: { judul: 'Dapur Umum & Paket Pangan', deskripsi: 'Makanan hangat dan bahan pokok gandum untuk keluarga di pengungsian.', terkumpul: 280000000, target: 400000000 },
  air:    { judul: 'Truk Air Bersih & Sanitasi', deskripsi: 'Air layak minum dan fasilitas sanitasi darurat untuk mencegah penyakit.', terkumpul: 250000000, target: 300000000 }
};

const panel = document.querySelector('#detail-program');
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

if (panel) {
  panel.querySelector('.detail-tutup').addEventListener('click', () => { panel.hidden = true; });
}
document.addEventListener('keydown', (e) => { if (e.key === 'Escape' && panel) panel.hidden = true; });

document.querySelector('#detail-donasi').addEventListener('click', () => {
  document.querySelector('#program').value = programAktif;
  document.querySelector('#donasi').scrollIntoView({ behavior: 'smooth' });
  document.querySelector('#nominal').focus({ preventScroll: true });
});
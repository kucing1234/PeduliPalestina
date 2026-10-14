/* ===== Menu hamburger ===== */
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

/* ===== Helper ===== */
const rupiah = (n) => 'Rp ' + Number(n).toLocaleString('id-ID');
const escapeHtml = (teks) => String(teks).replace(/[&<>"']/g, (c) => (
  { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]
));

/* ===== Week 4 Task 01: Connect to API ===== */
// Sumber 1: API PHP (api/programs.php). Sumber 2: file JSON cadangan.
const API_URLS = ['api/programs.php', 'data/programs.json'];

const apiStatus = document.querySelector('#api-status');
const apiList = document.querySelector('#api-program-list');
const refreshButton = document.querySelector('#refresh-api');

async function fetchDataFromApi() {
  // Untuk demo/testing: ?simulasi=lambat (loading 2 detik) atau ?simulasi=error
  const simulasi = new URLSearchParams(window.location.search).get('simulasi');
  if (simulasi === 'lambat') await new Promise((resolve) => setTimeout(resolve, 2000));
  if (simulasi === 'error') throw new Error('Simulasi error');

  let errorTerakhir = null;

  for (const url of API_URLS) {
    try {
      const response = await fetch(url);
      if (!response.ok) throw new Error(`HTTP ${response.status} pada ${url}`);

      const data = await response.json();
      if (!Array.isArray(data) || data.length === 0) {
        throw new Error(`Data kosong pada ${url}`);
      }
      return data;
    } catch (error) {
      errorTerakhir = error;
      console.warn('Gagal mengambil data:', error.message);
    }
  }

  throw errorTerakhir || new Error('Semua sumber data gagal');
}

/* ===== Week 4 Task 02: Display API Data ===== */
function renderApiPrograms(programs) {
  if (!apiList) return;

  apiList.innerHTML = programs.map((program) => {
    const percent = program.target > 0
      ? Math.min(100, Math.round((program.terkumpul / program.target) * 100))
      : 0;
    return `
      <article class="api-card">
        <span class="api-kategori">${escapeHtml(program.category || 'Program')}</span>
        <h3>${escapeHtml(program.title)}</h3>
        <p>${escapeHtml(program.description)}</p>
        <div class="api-meta">
          <span>${percent}%</span>
          <span>${rupiah(program.terkumpul)}</span>
        </div>
        <div class="api-bar" aria-label="Progress ${percent}%"><span style="width:${percent}%"></span></div>
      </article>
    `;
  }).join('');
}

/* ===== Week 4 Task 03: Handle API State (loading, success, error) ===== */
function setApiStatus(type, message) {
  if (!apiStatus) return;
  apiStatus.className = `api-status api-${type}`;
  apiStatus.textContent = message;
}

function showApiError() {
  if (!apiStatus) return;
  apiStatus.className = 'api-status api-error';
  apiStatus.innerHTML =
    '<strong>Gagal mengambil data.</strong> Terjadi kesalahan saat mengambil data. Silakan coba lagi. ' +
    '<button type="button" id="retry-api">Coba Lagi</button>';
  document.querySelector('#retry-api').addEventListener('click', loadApiPrograms);
}

async function loadApiPrograms() {
  setApiStatus('loading', 'Mengambil data program...');
  if (apiList) apiList.innerHTML = '';
  if (refreshButton) refreshButton.disabled = true;

  try {
    const programs = await fetchDataFromApi();
    renderApiPrograms(programs);
    setApiStatus('success', 'Data program berhasil dimuat.');
  } catch (error) {
    showApiError();
  } finally {
    if (refreshButton) refreshButton.disabled = false;
  }
}

if (refreshButton) {
  refreshButton.addEventListener('click', loadApiPrograms);
}

loadApiPrograms();

/* ===== Panel Detail Program (data dari PHP lewat variabel dataProgram) ===== */
const panel = document.querySelector('#detail-program');
const detailDonasi = document.querySelector('#detail-donasi');
let programAktif = null;

function tampilkanDetail(kunci) {
  if (typeof dataProgram === 'undefined' || !dataProgram[kunci] || !panel) return;

  const d = dataProgram[kunci];
  const persen = d.target > 0 ? Math.min(100, Math.round((d.terkumpul / d.target) * 100)) : 0;
  programAktif = kunci;

  document.querySelector('#detail-judul').textContent = d.title;
  document.querySelector('#detail-deskripsi').textContent = d.description;
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
  document.addEventListener('keydown', (e) => { if (e.key === 'Escape') panel.hidden = true; });
}

if (detailDonasi) {
  detailDonasi.addEventListener('click', () => {
    if (programAktif) document.querySelector('#program').value = programAktif;
    document.querySelector('#donasi').scrollIntoView({ behavior: 'smooth' });
    document.querySelector('#nominal').focus({ preventScroll: true });
  });
}

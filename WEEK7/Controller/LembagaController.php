<?php
/* =========================================================
   Controller/LembagaController.php - Controller (Week 7: MVC)
   Alur: Request -> Controller -> Model -> Controller -> View
   Method: index(), show(), process(), api()
   ========================================================= */
require_once __DIR__ . '/../Model/LembagaRepository.php';
require_once __DIR__ . '/../Model/Donasi.php';
require_once __DIR__ . '/../View/helpers.php';

class LembagaController
{
    private LembagaRepository $repository;
    private Lembaga $lembaga;

    public function __construct()
    {
        $this->repository = new LembagaRepository();
        $this->lembaga    = $this->repository->ambilLembaga();   // minta data ke Model
    }

    // Halaman utama: ambil data dari Model, olah, kirim ke View
    public function index(?array $hasilDonasi = null, array $old = []): void
    {
        $profil = $this->lembaga->getProfile();

        $this->render('lembaga-page', [
            'judulHalaman'   => $profil['nama'] . ' - Salurkan Bantuan Kemanusiaan',
            'basePath'       => '',
            'profil'         => $profil,
            'programs'       => $this->lembaga->getPrograms(),
            'programs_by_id' => $this->lembaga->getProgramsById(),
            'agenda'         => $this->repository->ambilAgenda(),
            'statistik'      => $this->buatStatistik(),
            'hasilDonasi'    => $hasilDonasi,
            'old'            => $old,
            'programDipilih' => $old['program'] ?? (string) ($_GET['program'] ?? ''),
        ]);
    }

    // Halaman detail satu program: index.php?aksi=show&id=medis
    public function show(string $id): void
    {
        $program = $this->lembaga->cariProgram($id);

        if ($program === null) {
            http_response_code(404);
            $this->render('not-found', [
                'judulHalaman' => 'Program tidak ditemukan - ' . $this->lembaga->getNama(),
                'basePath'     => 'index.php',
                'namaLembaga'  => $this->lembaga->getNama(),
            ]);
            return;
        }

        $this->render('program-detail', [
            'judulHalaman' => $program->getTitle() . ' - ' . $this->lembaga->getNama(),
            'basePath'     => 'index.php',
            'namaLembaga'  => $this->lembaga->getNama(),
            'program'      => $program,
        ]);
    }

    // Memproses form donasi (POST): validasi lewat Model Donasi, lalu tampilkan hasil
    public function process(): void
    {
        $donasi = new Donasi($_POST);
        $errors = $donasi->validasi($this->lembaga, $_FILES['bukti'] ?? null);

        if ($errors) {
            http_response_code(422);
            $hasil = ['sukses' => false, 'errors' => $errors];
            $old = [
                'nama'    => (string) ($_POST['nama'] ?? ''),
                'program' => $donasi->getProgramId(),
                'nominal' => (string) ($_POST['nominal'] ?? ''),
                'doa'     => (string) ($_POST['doa'] ?? ''),
            ];
            $this->index($hasil, $old);
            return;
        }

        $program = $this->lembaga->cariProgram($donasi->getProgramId());
        $hasil = [
            'sukses' => true,
            'pesan'  => 'Jazakumullah khairan, ' . $donasi->getNama() . '. Donasi ' .
                        rupiah($donasi->getNominal()) . ' untuk program "' . $program->getTitle() .
                        '" sudah kami terima dan menunggu verifikasi admin.',
        ];
        $this->index($hasil);
    }

    // Endpoint JSON (dipakai fetch di script.js): api/programs.php
    public function api(): void
    {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(
            array_map(fn($p) => $p->toArray(), $this->lembaga->getPrograms()),
            JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
        );
    }

    // Statistik ringkas dari Model, sudah diformat untuk ditampilkan
    private function buatStatistik(): array
    {
        return [
            ['angka' => rupiah($this->lembaga->totalTerkumpul()),
             'label' => 'Total Dana Terhimpun'],
            ['angka' => number_format($this->lembaga->getJumlahDonatur(), 0, ',', '.') . ' Orang',
             'label' => 'Jumlah Donatur Tergabung'],
            ['angka' => number_format($this->lembaga->getPenerimaManfaat(), 0, ',', '.') . ' Warga',
             'label' => 'Penerima Manfaat Bantuan'],
        ];
    }

    // Mengirim data ke View: variabel dari $data tersedia di file view
    private function render(string $view, array $data): void
    {
        extract($data, EXTR_SKIP);
        require __DIR__ . '/../View/' . $view . '.php';
    }
}
